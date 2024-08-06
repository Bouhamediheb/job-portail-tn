<template>
  <section class="section-box mt-30">
    <div class="container">
      <div class="row flex-row-reverse">
        <!-- Main Content -->
        <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
          <div class="content-page">
            <!-- Filters and Search -->
            <div class="box-filters-job">
              <div class="row">
                <div class="col-xl-6 col-lg-5">
                  <span class="text-small text-showing">
                    Affichage de <strong>{{ displayedJobs.length }}</strong> de
                    <strong>{{ totalJobs }}</strong> annonces
                  </span>
                </div>
                <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                  <!-- Search box -->
                  <div class="search-box">
                    <input
                      type="text"
                      v-model="localSearchParams.keywords"
                      @input="updateSearchParams"
                      placeholder="Taper des mots clés"
                      style="height: 40px; margin-bottom: 5px;"
                    />
                  </div>
                </div>
              </div>
            </div>

            <!-- Job Listings -->
            <div class="row display-list">
              <div class="col-xl-12 col-12">
                <!-- Skeleton Loader -->
                <div v-if="loading" class="skeleton-loader">
                  <div class="skeleton-job" v-for="n in 4" :key="n">
                    <div class="card-grid-2 hover-up">
                      <!-- Skeleton content here -->
                    </div>
                  </div>
                </div>

                <!-- Job Listings -->
                <div v-else>
                  <!-- No jobs message -->
                  <div v-if="filteredJobs.length === 0">
                    <p class="no-jobs-message">Pas d'offres qui correspondent à vos critères de recherche</p>
                  </div>

                  <div v-else>
                    <div class="card-grid-2 hover-up" v-for="job in displayedJobs" :key="job.id">
                      <router-link :to="{ name: 'JobDetail', params: { id: job.id } }">
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card-grid-2-image-left">
                              <div class="image-box">
                                <img
                                  :src="`http://localhost:8000/api/societe/logo/${job.societe_id}`"
                                  alt="PortailTN"
                                  style="height: 40px"
                                />
                              </div>
                              <div class="right-info">
                                <span class="name-job">{{ getCompanyName(job.societe_id) }}</span>
                                <span class="location-small">{{ job.city }}, {{ job.country }}</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                            <div class="pl-15 mb-15 mt-30">
                              <a
                                v-for="skill in JSON.parse(job.skills)"
                                :key="skill"
                                class="btn btn-grey-small mr-5"
                              >
                                {{ skill }}
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-block-info">
                          <h4>{{ job.title }}</h4>
                          <div class="mt-5">
                            <span class="card-briefcase">{{ getWorkplaceType(job.workplace) }}</span>
                            <span class="card-time">
                              <span>{{ calculateTimeAgo(job.created_at) }}</span>
                            </span>
                          </div>
                          
                          <!-- Show motivation if job type is 'internship' -->
                          <div v-if="job.type === 'internship'">
                            <span class="card-motivation">
                              Motivation: {{ job.motivation || '--' }}
                            </span>
                            <span class="card-duration">
                              Durée: {{ job.internshipDuration || '--' }}
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <div v-if="totalPages > 1" class="paginations">
              <ul class="pager">
                <li>
                  <a class="pager-prev" @click="previousPage" :class="{ disabled: currentPage === 1 }"></a>
                </li>
                <li v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                  <a class="pager-number" @click="fetchJobs(page)">{{ page }}</a>
                </li>
                <li>
                  <a class="pager-next" @click="nextPage" :class="{ disabled: currentPage === totalPages }"></a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3 col-md-12 col-sm-12 col-12">
          <div class="sidebar-shadow none-shadow mb-30">
            <div class="sidebar-filters">
              <div class="filter-block mb-20 mt-20 head-border mb-30">
                <h5>
                  Filtre de recherche <a class="link-reset" href="#" @click="resetFilters">Reset</a>
                </h5>
              </div>
              <div class="filter-block mb-20 mt-20 mb-20">
                <h5 class="medium-heading mb-15">Domaine</h5>
                <div class="form-group">
                  <ul class="list-checkbox">
                    <li v-for="domain in domains" :key="domain.name">
                      <label class="cb-container">
                        <input
                          type="checkbox"
                          v-model="localSearchParams.domains"
                          :value="domain.name"
                        />
                        <span class="text-small">{{ domain.name }}</span>
                        <span class="checkmark"></span>
                      </label>
                      <span class="number-item">{{ domain.count }}</span>
                    </li>
                  </ul>
                </div>
              </div>

              <!-- Job Type Filter -->
              <div class="filter-block mb-20 mt-20 mb-20">
                <h5 class="medium-heading mb-15">Type de travail</h5>
                <div class="form-group">
                  <select v-model="localSearchParams.jobType" @change="updateSearchParams">
                    <option value="">Tous les types</option>
                    <option value="0">Temps partiel</option>
                    <option value="1">Temps plein</option>
                  </select>
                </div>
              </div>

              <!-- Experience Level Filter -->
              <div class="filter-block mb-20 mt-20 mb-20">
                <h5 class="medium-heading mb-15">Niveau d'expérience</h5>
                <div class="form-group">
                  <select v-model="localSearchParams.experienceLevel" @change="updateSearchParams">
                    <option value="">Tous les niveaux</option>
                    <option v-for="n in 10" :key="n" :value="n">{{ n }} année(s)</option>
                  </select>
                </div>
              </div>

              <!-- Salary Range Filter -->
              <div class="filter-block mb-20 mt-20 mb-20">
                <h5 class="medium-heading mb-15">Plage de salaire</h5>
                <div class="form-group">
                  <label for="min-salary">Salaire minimum (TND)</label>
                  <input
                    type="number"
                    id="min-salary"
                    v-model.number="localSearchParams.minSalary"
                    @input="updateSearchParams"
                    placeholder="Minimum"
                  />
                  <label for="max-salary">Salaire maximum (TND)</label>
                  <input
                    type="number"
                    id="max-salary"
                    v-model.number="localSearchParams.maxSalary"
                    @input="updateSearchParams"
                    placeholder="Maximum"
                  />
                </div>
              </div>

              <!-- Location Filter -->
              <div class="filter-block mb-20 mt-20 mb-20">
                <h5 class="medium-heading mb-15">Lieu</h5>
                <div class="form-group">
                  <input
                    type="text"
                    v-model="localSearchParams.location"
                    @input="updateSearchParams"
                    placeholder="Entrez une ville"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    searchParams: {
      type: Object,
      default: () => ({
        keywords: '',
        domains: [],
        jobType: '',
        experienceLevel: '',
        minSalary: null,
        maxSalary: null,
        location: ''
      })
    }
  },
  data() {
    return {
      localSearchParams: { ...this.searchParams }, // Initialize with prop values
      domains: [], // Populate this with available domains if necessary
      displayedJobs: [], // Jobs data
      totalJobs: 0,
      loading: false,
      filteredJobs: [],
      totalPages: 1,
      currentPage: 1
    };
  },
  methods: {
    updateSearchParams() {
      console.log('Updating search params with:', this.localSearchParams);
      this.$emit('update:searchParams', this.localSearchParams);
      this.fetchJobs(); // Fetch jobs based on updated params
    },
    fetchJobs(page = 1) {
      console.log('Fetching jobs with:', this.localSearchParams);
      // Implement job fetching logic based on current searchParams and page
      // Example API call:
      // axios.get('/api/jobs', { params: { ...this.localSearchParams, page } })
      //   .then(response => {
      //     this.displayedJobs = response.data.jobs;
      //     this.totalJobs = response.data.total;
      //     this.totalPages = Math.ceil(this.totalJobs / response.data.per_page);
      //     this.loading = false;
      //   })
      //   .catch(error => {
      //     console.error('Error fetching jobs:', error);
      //     this.loading = false;
      //   });
    },
    resetFilters() {
      this.localSearchParams = {
        keywords: '',
        domains: [],
        jobType: '',
        experienceLevel: '',
        minSalary: null,
        maxSalary: null,
        location: ''
      };
      this.updateSearchParams();
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
        this.fetchJobs(this.currentPage);
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1;
        this.fetchJobs(this.currentPage);
      }
    },
    getCompanyName(societe_id) {
      // Implement method to get company name based on societe_id
    },
    getWorkplaceType(workplace) {
      // Implement method to get workplace type based on workplace value
    },
    calculateTimeAgo(created_at) {
      // Implement method to calculate time ago from created_at
    }
  },
  watch: {
    searchParams: {
      handler(newVal) {
        console.log('Updated searchParams:', newVal);
        this.localSearchParams = { ...newVal };
        this.fetchJobs();
      },
      deep: true
    }
  },
  mounted() {
    this.fetchJobs(); 
    console.log('Initial searchParams:', this.localSearchParams);
  }
};
</script>

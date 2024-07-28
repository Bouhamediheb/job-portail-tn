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
                      v-model="searchParams.keyword"
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
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="card-grid-2-image-left">
                            <div class="image-box skeleton-image"></div>
                            <div class="right-info">
                              <div class="name-job skeleton-text"></div>
                              <div class="location-small skeleton-text"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                          <div class="pl-15 mb-15 mt-30">
                            <div class="btn btn-grey-small skeleton-tag"></div>
                          </div>
                        </div>
                      </div>
                      <div class="card-block-info">
                        <h4><div class="skeleton-title"></div></h4>
                        <div class="mt-5">
                          <div class="card-briefcase skeleton-text"></div>
                          <div class="card-time skeleton-text"></div>
                        </div>
                        <p class="font-sm color-text-paragraph mt-10 skeleton-text"></p>
                        <div class="card-2-bottom mt-20">
                          <div class="row">
                            <div class="col-lg-7 col-7">
                              <div class="card-text-price skeleton-text"></div>
                            </div>
                            <div class="col-lg-5 col-5 text-end">
                              <div class="btn btn-apply-now skeleton-btn"></div>
                            </div>
                          </div>
                        </div>
                      </div>
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
                          v-model="selectedDomains"
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
                  <select v-model="searchParams.jobType" @change="updateSearchParams">
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
                  <select v-model="searchParams.experienceLevel" @change="updateSearchParams">
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
                    v-model.number="searchParams.minSalary"
                    @input="updateSearchParams"
                    placeholder="Minimum"
                  />
                  <label for="max-salary">Salaire maximum (TND)</label>
                  <input
                    type="number"
                    id="max-salary"
                    v-model.number="searchParams.maxSalary"
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
                    v-model="searchParams.location"
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

<style scoped>
.search-box {
  display: flex;
  gap: 10px;
}

.search-box input,
.search-box select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.card-grid-2.small-card {
  font-size: 0.85rem; /* Smaller font size */
}

.card-grid-2.small-card .card-grid-2-image-left .image-box img {
  width: 80px; /* Smaller image */
  height: auto;
}

.card-grid-2.small-card .right-info .name-job {
  font-size: 1rem; /* Smaller font size for job title */
}

.card-grid-2.small-card .right-info .location-small {
  font-size: 0.8rem; /* Smaller font size for location */
}

.card-grid-2.small-card .card-block-info {
  padding: 10px;
}

.card-grid-2.small-card .card-block-info h4 {
  font-size: 1rem; /* Smaller font size for title */
}

.card-grid-2.small-card .card-block-info .font-sm {
  font-size: 0.8rem; /* Smaller font size for description */
}

.card-grid-2.small-card .card-2-bottom .card-text-price {
  font-size: 0.8rem; /* Smaller font size for price */
}

.card-grid-2.small-card .btn.btn-grey-small {
  font-size: 0.75rem; /* Smaller font size for buttons */
  padding: 5px 10px;
}

.skeleton-image {
  width: 80px; /* Smaller skeleton image */
  height: auto;
}

.skeleton-text,
.skeleton-title {
  font-size: 0.8rem; /* Smaller skeleton text size */
}

.pager-number {
  font-size: 0.85rem; /* Smaller font size for pagination numbers */
}

.pager-prev,
.pager-next {
  font-size: 0.85rem; /* Smaller font size for pagination arrows */
}

.no-jobs-message {
  text-align: center;
  font-size: 1.25rem;
  color: #888;
  margin: 20px 0;
}
</style>

<script>
import axios from 'axios';

export default {
  name: 'JobOffers',
  data() {
    return {
      jobs: [],
      displayedJobs: [],
      filteredJobs: [],
      totalJobs: 0,
      currentPage: 1,
      domains: [],
      selectedDomains: [], // Initialize selectedDomains as an empty array
      searchParams: {
        keyword: '', // Search keyword
        jobType: '',  // Job type
        experienceLevel: '', // Experience level
        minSalary: null, // Minimum salary
        maxSalary: null, // Maximum salary
        location: '', // Location
      },
      companyNames: {},
      loading: true,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredJobs.length / 4);
    },
  },
  methods: {
    async fetchJobs(page = 1) {
      this.loading = true;
      setTimeout(() => {
        const startIndex = (page - 1) * 4;
        this.displayedJobs = this.filteredJobs.slice(startIndex, startIndex + 4);
        this.loading = false;
      }, 1300);
    },

    async getDomains() {
      try {
        const response = await axios.get('http://localhost:8000/api/onlyjobs');
        const allDomains = response.data.map((job) => job.domain);
        this.domains = [...new Set(allDomains)].map((domain) => ({
          name: domain,
          count: allDomains.filter((d) => d === domain).length,
        }));
      } catch (error) {
        console.error('Error fetching domains:', error);
      }
    },

    async fetchAllJobs() {
      try {
        const response = await axios.get('http://localhost:8000/api/onlyjobs');
        this.jobs = response.data;
        this.totalJobs = this.jobs.length;
        this.filteredJobs = this.jobs; 
        this.fetchJobs(this.currentPage);
        this.jobs.forEach((job) => this.fetchCompanyName(job.societe_id));
      } catch (error) {
        console.error('Error fetching jobs:', error);
      }
    },

    async fetchCompanyName(companyId) {
      try {
        const response = await axios.get(`http://localhost:8000/api/societe/profile/${companyId}`);
        this.companyNames = {
          ...this.companyNames,
          [companyId]: response.data.name,
        };
      } catch (error) {
        this.companyNames = {
          ...this.companyNames,
          [companyId]: 'Unknown',
        };
      }
    },

    getCompanyName(companyId) {
      return this.companyNames[companyId] || 'Loading...';
    },

    getWorkplaceType(workplace) {
      switch (workplace) {
        case 0:
          return 'Télétravail';
        case 1:
          return 'Bureau';
        case 2:
          return 'Hybrid';
        default:
          return 'Non spécifié';
      }
    },

    calculateTimeAgo(createdAt) {
      const createdDate = new Date(createdAt);
      const currentDate = new Date();
      const timeDifference = currentDate - createdDate;
      const daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24));
      return daysAgo > 1 ? ` Depuis ${daysAgo} jours` : 'Depuis 1 jour';
    },

    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchJobs(this.currentPage);
      }
    },

    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchJobs(this.currentPage);
      }
    },

    updateSearchParams() {
      this.applySearch();
    },

    applySearch() {
      const { keyword, jobType, experienceLevel, minSalary, maxSalary, location } = this.searchParams;

      this.filteredJobs = this.jobs.filter((job) => {
        const matchesKeyword = keyword ? job.title.toLowerCase().includes(keyword.toLowerCase()) : true;
        const matchesDomain = this.selectedDomains.length ? this.selectedDomains.includes(job.domain) : true;
        const matchesJobType = jobType !== '' ? job.employmentType == jobType : true;
        const matchesExperienceLevel = experienceLevel !== '' ? job.yearsOfExperience == experienceLevel : true;
        const matchesSalary = (minSalary !== null && job.minSalary < minSalary) || (maxSalary !== null && job.maxSalary > maxSalary) ? false : true;
        const matchesLocation = location ? job.city.toLowerCase().includes(location.toLowerCase()) : true;
        return matchesKeyword && matchesDomain && matchesJobType && matchesExperienceLevel && matchesSalary && matchesLocation;
      });
      this.currentPage = 1;
      this.fetchJobs(this.currentPage);
    },

    resetFilters() {
      this.searchParams = {
        keyword: '',
        jobType: '',
        experienceLevel: '',
        minSalary: null,
        maxSalary: null,
        location: '',
      };
      this.selectedDomains = []; // Reset selected domains
      this.applySearch();
    },
  },
  watch: {
    selectedDomains() {
      this.applySearch();
    },
    searchParams: {
      handler() {
        this.applySearch();
      },
      deep: true,
    },
  },
  mounted() {
    this.fetchAllJobs();
    this.getDomains();
  },
};
</script>

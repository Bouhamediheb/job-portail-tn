<template>
  <section class="section-box mt-30">
    <div class="container">
      <div class="row flex-row-reverse">
        <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
          <div class="content-page">
            <div class="box-filters-job">
              <div class="row align-items-center">
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
                      style="height: 40px;margin-bottom: 5px;"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="row display-list">
              <div class="col-xl-12 col-12">
                <!-- Internships list -->
                <div v-if="loading" class="skeleton-loader">
                  <!-- Skeleton loader UI -->
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
                <div v-else>
                  <div v-if="filteredJobs.length === 0" class="no-jobs-message">
                    Pas de stages correspondant à vos critères
                  </div>
                  <div v-else>
                    <div class="card-grid-2 hover-up" v-for="internship in displayedJobs" :key="internship.id">
                      <router-link
                        :to="{ name: 'JobDetail', params: { id: internship.id } }"
                      >                      
                      <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card-grid-2-image-left">
                              <div class="image-box">
                                <img
                                  :src="`http://localhost:8000/api/societe/logo/${internship.societe_id}`"
                                  alt="PortailTN"
                                  style="height: 40px"
                                />
                              </div>
                              <div class="right-info">
                                <span class="name-job">{{ getCompanyName(internship.societe_id) }}</span>
                                <span class="location-small">{{ internship.city }}, {{ internship.country }}</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                            <div class="pl-15 mb-15 mt-30">
                              <a v-for="skill in JSON.parse(internship.skills)" :key="skill" class="btn btn-grey-small mr-5">
                                {{ skill }}
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-block-info">
                          <h4>{{ internship.title }}</h4>
                          <div class="mt-5">
                            <span class="card-briefcase">{{ getWorkplaceType(internship.workplace) }}</span>
                            <span class="card-time">
                              <span>{{ calculateTimeAgo(internship.created_at) }}</span>
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="filteredJobs.length > 0" class="paginations">
              <ul class="pager">
                <li><a class="pager-prev" @click="previousPage"></a></li>
                <li v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                  <a class="pager-number" @click="fetchJobs(page)">{{ page }}</a>
                </li>
                <li><a class="pager-next" @click="nextPage"></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 col-12">
          <!-- Sidebar content -->
          <div class="sidebar-shadow none-shadow mb-30">
            <div class="sidebar-filters">
              <div class="filter-block head-border mb-30">
                <h5>Filtre de recherche</h5>
              </div>
              <div class="filter-block mb-20 mt-20">
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
              <!-- New Filters -->
              <div class="filter-block mb-20 mt-20">
                <h5 class="medium-heading mb-15">Durée du Stage (mois)</h5>
                <div class="form-group">
                  <select v-model="searchParams.internshipDuration" @change="updateSearchParams">
                    <option value="">Tous</option>
                    <option v-for="duration in durationOptions" :key="duration" :value="duration">
                      {{ duration }} mois
                    </option>
                  </select>
                </div>
              </div>

              <div class="filter-block mb-20 mt-20">
                <h5 class="medium-heading mb-15">Motivation financière</h5>
                <div class="form-group">
                  <label for="min-salary">Motivation minimum (TND)</label>
                  <input
                    type="number"
                    v-model.number="searchParams.minMotivation"
                    @input="updateSearchParams"
                    placeholder="Minimum"
                  />
                  <label for="max-salary">Motivation maximum (TND)</label>
                  <input
                    type="number"
                    v-model.number="searchParams.maxMotivation"
                    @input="updateSearchParams"
                    placeholder="Maximum"
                  />
                </div>
              </div>

              <div class="filter-block mb-20 mt-20">
                <h5 class="medium-heading mb-15">Emplacement</h5>
                <div class="form-group">
                  <select v-model="searchParams.workplace" @change="updateSearchParams">
                    <option value="">Tous</option>
                    <option value="0">Télétravail</option>
                    <option value="1">Bureau</option>
                    <option value="2">Hybrid</option>
                  </select>
                </div>
              </div>

              <!-- Location Filter -->
              <div class="filter-block mb-20 mt-20">
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
  padding: 20px;
  font-size: 1.2rem;
  color: #666;
}

.paginations {
  margin-top: 20px;
}

.paginations ul.pager {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
}

.paginations ul.pager li {
  margin: 0 5px;
}

.paginations ul.pager li a {
  text-decoration: none;
  color: #007bff;
}

.paginations ul.pager li.active a {
  font-weight: bold;
  color: #0056b3;
}
</style>



<script>
import axios from 'axios';

export default {
  name: 'Internships',
  data() {
    return {
      jobs: [],
      displayedJobs: [],
      filteredJobs: [],
      totalJobs: 0,
      currentPage: 1,
      domains: [],
      selectedDomains: [],
      durationOptions: [1, 2, 3, 4, 5, 6], // Example durations
      searchParams: {
        keyword: '', // Search keyword
        domain: '', // Selected domain
        internshipDuration: '', // Duration filter
        minMotivation: null, // Minimum motivation
        maxMotivation: null, // Maximum motivation
        workplace: '', // Workplace filter
        location: '' // Location filter
      },
      companyNames: {},
      loading: true,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredJobs.length / 4); // Use filteredJobs for total pages
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

    async fetchAllJobs() {
      try {
        const response = await axios.get('http://localhost:8000/api/onlyinternships');
        this.jobs = response.data;
        this.totalJobs = this.jobs.length;
        this.filteredJobs = this.jobs; // Initialize filteredJobs
        this.fetchJobs(this.currentPage);
        this.jobs.forEach((job) => this.fetchCompanyName(job.societe_id));
      } catch (error) {
        console.error('Error fetching internships:', error);
      }
    },

    async getDomains() {
      try {
        const response = await axios.get('http://localhost:8000/api/onlyinternships');
        const allDomains = response.data.map((internship) => internship.domain);
        this.domains = [...new Set(allDomains)].map((domain) => ({
          name: domain,
          count: allDomains.filter((d) => d === domain).length,
        }));
      } catch (error) {
        console.error('Error fetching domains:', error);
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
      const { keyword, domain, internshipDuration, minMotivation, maxMotivation, workplace, location } = this.searchParams;
      this.filteredJobs = this.jobs.filter((internship) => {
        const matchesKeyword = keyword ? internship.title.toLowerCase().includes(keyword.toLowerCase()) : true;
        const matchesDomain = this.selectedDomains.length > 0 ? this.selectedDomains.includes(internship.domain) : true;
        const matchesDuration = internshipDuration ? internship.internshipDuration === Number(internshipDuration) : true;
        const matchesMotivation = (
          (minMotivation === null || internship.internshipMotivation >= minMotivation) &&
          (maxMotivation === null || internship.internshipMotivation <= maxMotivation)
        );
        const matchesWorkplace = workplace ? internship.workplace === Number(workplace) : true;
        const matchesLocation = location ? internship.city.toLowerCase().includes(location.toLowerCase()) : true;

        return matchesKeyword && matchesDomain && matchesDuration && matchesMotivation && matchesWorkplace && matchesLocation;
      });
      this.currentPage = 1; // Reset to first page
      this.fetchJobs(this.currentPage); // Refresh displayed jobs
    },
  },
  watch: {
    selectedDomains() {
      this.applySearch();
    },
  },
  mounted() {
    this.fetchAllJobs();
    this.getDomains();
  },
};
</script>

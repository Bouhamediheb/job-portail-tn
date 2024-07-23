<template>
  <section class="section-box mt-30">
    <div class="container">
      <div class="row flex-row-reverse">
        <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
          <div class="content-page">
            <div class="box-filters-job">
              <div class="row">
                <div class="col-xl-6 col-lg-5">
                  <span class="text-small text-showing">
                    Affichage de <strong>{{ displayedJobs.length }}</strong> de
                    <strong>{{ totalJobs }}</strong> annonces
                  </span>
                </div>
                <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15"></div>
              </div>
            </div>
            <div class="row display-list">
              <div class="col-xl-12 col-12">
                <!-- Job offers list -->
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
                        <div
                          class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12"
                        >
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
                        <p
                          class="font-sm color-text-paragraph mt-10 skeleton-text"
                        ></p>
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
                  <div
                    class="card-grid-2 hover-up"
                    v-for="job in displayedJobs"
                    :key="job.id"
                  >
                    <router-link
                      :to="{ name: 'JobDetail', params: { id: job.id } }"
                    >
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="card-grid-2-image-left">
                            <div class="image-box">
                              <!-- Fix Image Fitting -->
                              <img
                                :src="
                                  'http://localhost:8000/api/societe/logo/' +
                                  job.societe_id
                                "
                                alt="PortailTN"
                                style="height: 80px"
                              />
                            </div>
                            <div class="right-info">
                              <span class="name-job">{{
                                getCompanyName(job.societe_id)
                              }}</span>
                              <span class="location-small"
                                >{{ job.city }}, {{ job.country }}</span
                              >
                            </div>
                          </div>
                        </div>
                        <div
                          class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12"
                        >
                          <div class="pl-15 mb-15 mt-30">
                            <a
                              v-for="skill in JSON.parse(job.skills)"
                              :key="skill"
                              class="btn btn-grey-small mr-5"
                              >{{ skill }}</a
                            >
                          </div>
                        </div>
                      </div>
                      <div class="card-block-info">
                        <h4>{{ job.title }}</h4>
                        <div class="mt-5">
                          <span class="card-briefcase">{{
                            getWorkplaceType(job.employmentType)
                          }}</span>
                          <span class="card-time">
                            <span>{{ calculateTimeAgo(job.createdAt) }}</span>
                          </span>
                        </div>
                        <p class="font-sm color-text-paragraph mt-10">
                          {{ job.description }}
                        </p>
                      </div>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
            <div class="paginations">
              <ul class="pager">
                <li><a class="pager-prev" @click="previousPage"></a></li>
                <li
                  v-for="page in totalPages"
                  :key="page"
                  :class="{ active: currentPage === page }"
                >
                  <a class="pager-number" @click="fetchJobs(page)">{{
                    page
                  }}</a>
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
              <!-- Add filters and other sidebar components as needed -->
              <div class="filter-block head-border mb-30">
                <h5>
                  Filtre de recherche <a class="link-reset" href="#">Reset</a>
                </h5>
              </div>
              <div class="filter-block mb-20">
                <h5 class="medium-heading mb-15">Domaine</h5>
                <div class="form-group">
                  <ul class="list-checkbox">
                    <li v-for="domain in domains" :key="domain.id">
                      <label class="cb-container">
                        <input
                          type="checkbox"
                          v-model="selectedDomains"
                          :value="domain.id"
                        />
                        <span class="text-small">{{ domain.name }}</span>
                        <span class="checkmark"></span>
                      </label>
                      <span class="number-item">{{ domain.count }}</span>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- Add other filters as needed -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
  
  <style scoped>
/* Add your component-specific styles here */
</style>
  
  
  <script>
import axios from "axios";

export default {
  name: "JobOffers",
  data() {
    return {
      jobs: [],
      displayedJobs: [],
      totalJobs: 0,
      currentPage: 1,
      domains: [
        { id: 1, name: "Informatique", count: 10 },
        { id: 2, name: "Finance", count: 5 },
        { id: 3, name: "Marketing", count: 7 },
        { id: 4, name: "Ressources Humaines", count: 3 },
        { id: 5, name: "Vente", count: 6 },
        { id: 6, name: "Communication", count: 4 },
        { id: 7, name: "Ingénierie", count: 8 },
        { id: 8, name: "Design", count: 2 },
        { id: 9, name: "Juridique", count: 1 },
        { id: 10, name: "Autre", count: 12 },
      ],
      selectedDomains: [],
      blogPosts: [],
      companyNames: {},
      loading: true,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.jobs.length / 4);
    },
  },
  methods: {
    async fetchJobs(page = 1) {
      this.loading = true;
      setTimeout(() => {
        const startIndex = (page - 1) * 4;
        this.displayedJobs = this.jobs.slice(startIndex, startIndex + 4);
        this.loading = false;
      }, 1300);
    },
    async fetchAllJobs() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/offre/jobs"
        );
        this.jobs = response.data;
        this.totalJobs = this.jobs.length;
        this.fetchJobs(this.currentPage);
        this.jobs.forEach((job) => this.fetchCompanyName(job.societe_id));
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    },

    async fetchCompanyName(companyId) {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/societe/profile/${companyId}`
        );
        this.companyNames = {
          ...this.companyNames,
          [companyId]: response.data.name,
        };
      } catch (error) {
        this.companyNames = {
          ...this.companyNames,
          [companyId]: "Unknown",
        };
      }
    },
    getCompanyName(companyId) {
      return this.companyNames[companyId] || "Loading...";
    },
    getWorkplaceType(workplace) {
      switch (workplace) {
        case 0:
          return "Télétravail";
        case 1:
          return "Bureau";
        case 2:
          return "Hybrid";
        default:
          return "Non spécifié";
      }
    },

    calculateTimeAgo(createdAt) {
      const createdDate = new Date(createdAt);
      const currentDate = new Date();
      const timeDifference = currentDate - createdDate;
      const daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24));
      return daysAgo > 1 ? ` Depuis ${daysAgo} jours` : "Depuis 1 jour";
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
  },
  mounted() {
    this.fetchAllJobs();
  },
};
</script>

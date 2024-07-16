<template>
  <section class="section-box mt-110">
    <div class="section-box wow animate__animated animate__fadeIn mt-70">
      <div class="container">
        <div class="text-center">
          <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">
            Nos annonces à la une
          </h2>
          <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
            Trouvez l'offre d'emploi ou de stage proposées par nos partenaires
            <br class="d-none d-lg-block" />qui vous convient.
          </p>
        </div>
        <div class="mt-10">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" v-for="item in jobs" :key="item.id">
              <div class="card-grid-2 grid-bd-16 hover-up">
                <div class="card-grid-2-image">
                  <span class="lbl-hot bg-green"><span>Emploi</span></span>
                  <div class="image-box">
                    <figure>
                      <img :src="item.image || 'assets/home/imgs/page/homepage2/img1.png'" alt="PortailTN" />
                    </figure>
                  </div>
                </div>
                <div class="card-block-info">
                  <h5><a href="job-details.html">{{ item.title }}</a></h5>
                  <div class="mt-5">
                    <span class="card-location mr-15">{{ item.city }}, {{ item.country }}</span>
                    <span class="card-time">Postée il y a {{ calculateDaysAgo(item.created_at) }} jours</span>
                    <span class="card-location">{{ getWorkplaceType(item.workplace) }}</span>
                  </div>

                  <div class="card-2-bottom mt-20">
                    <div class="row">
                      <div class="col-xl-7 col-md-7 mb-2">
                        <a v-for="tag in JSON.parse(item.skills)" :key="tag" class="btn btn-tags-sm mr-5">{{ tag }}</a>
                      </div>
                      <div class="col-xl-5 col-md-5 text-lg-end">
                        <span class="card-text-price">{{ item.minSalary }} - {{ item.maxSalary }} DT</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-10">
            <a class="btn btn-brand-1 btn-icon-more hover-up">Voir plus </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: "LatestJobs",
  data() {
    return {
      jobs: []
    };
  },
  methods: {
    async fetchJobs() {
      try {
        const response = await axios.get('http://localhost:8000/api/offre');
        this.jobs = response.data;
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    },
    calculateDaysAgo(createdAt) {
      const createdDate = new Date(createdAt);
      const currentDate = new Date();
      const timeDifference = currentDate - createdDate;
      return Math.floor(timeDifference / (1000 * 3600 * 24));
    },
    getWorkplaceType(workplace) {
      switch (workplace) {
        case 0: return 'Télétravail';
        case 1: return 'Bureau';
        case 2: return 'Hybrid';
        default: return 'Non spécifié';
      }
    }
  },
  mounted() {
    this.fetchJobs();
  }
};
</script>

<style scoped>
/* Add any custom styles here */
</style>

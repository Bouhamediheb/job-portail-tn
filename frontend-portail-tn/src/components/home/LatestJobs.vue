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
          <div class="list-tabs list-tabs-2 mt-30">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="active" id="nav-tab-job-1" href="#tab-job-1" data-bs-toggle="tab" role="tab" aria-controls="tab-job-1" aria-selected="true"><img src="assets/home/imgs/page/homepage1/management.svg" alt="PortailTN"> Management</a></li>
                                <li><a id="nav-tab-job-2" href="#tab-job-2" data-bs-toggle="tab" role="tab" aria-controls="tab-job-2" aria-selected="false"><img src="assets/home/imgs/page/homepage1/marketing.svg" alt="PortailTN"> Marketing &amp; Sale</a></li>
                                <li><a id="nav-tab-job-3" href="#tab-job-3" data-bs-toggle="tab" role="tab" aria-controls="tab-job-3" aria-selected="false"><img src="assets/home/imgs/page/homepage1/finance.svg" alt="PortailTN"> Finance</a></li>

                            </ul>
                        </div>
        </div>
        <div class="mt-10">
          <div class="row">
            
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" v-for="item in jobs" :key="item.id">
              <div class="card-grid-2 grid-bd-16 hover-up">
                <div class="card-grid-2-inner">
                  <div class="card-grid-2-image">
                    <span class="lbl-hot bg-green"><span>Emploi</span></span>
                    <div class="image-box">
                      <figure>
                        <img :src="item.image || 'assets/home/imgs/page/homepage2/img1.png'" alt="PortailTN" />
                      </figure>
                    </div>
                  </div>
                  <div class="card-block-info">
                    <h5 class="card-title">
                      <router-link :to="{ name: 'JobDetail', params: { id: item.id } }">{{ item.title }}</router-link>
                    </h5>
                    <div class="card-details">
                      <div class="card-location">{{ item.city }}, {{ item.country }}</div>
                      <div class="card-time ml-10">Postée il y a {{ calculateDaysAgo(item.created_at) }} jours</div>
                      <div class="card-location ml-10">{{getWorkplaceType(item.workplace) }}</div>
                      
                    </div>
                    <div class="card-tags">
                      <a v-for="tag in JSON.parse(item.skills)" :key="tag" class="btn btn-tags-sm mr-5">{{ tag }}</a>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-10">
            <a class="btn btn-brand-1 btn-icon-more hover-up mt-20">Voir plus </a>
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
        // Filter jobs to only include those that are featured
        this.jobs = response.data.filter(job => job.featured === 1);
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
.card-grid-2 {
  border: 1px solid #ccc;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  margin-bottom: 20px;
  height: 100%;
}

.card-grid-2 .card-grid-2-inner {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.card-grid-2 .card-block-info {
  flex: 1;
  padding: 20px;
}

.card-grid-2 .card-title {
  font-size: 18px;
  margin-bottom: 10px;
}

.card-grid-2 .card-details {
  margin-bottom: 10px;
}

.card-grid-2 .card-tags {
  margin-bottom: 10px;
}

.card-grid-2 .card-salary {
  margin-top: auto;
  text-align: right;
}
</style>
<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mes annonces</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard">Dashboard</router-link>
            </li>
            <li><span>Mes annonces</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding">
                <div class="row display-list">
                  <template v-if="loading">
                    <div class="skeleton-loader" v-for="n in itemsPerPage" :key="n">
                      <div class="skeleton-card">
                        <div class="skeleton-image"></div>
                        <div class="skeleton-title"></div>
                        <div class="skeleton-info"></div>
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div v-if="paginatedItems.length === 0" class="no-offers-message">
                      <p>Aucune annonce disponible.</p>
                    </div>
                    <div v-else>
                      <div class="col-lg-12" v-for="item in paginatedItems" :key="item.id">
                        <div class="card-style-2 hover-up">
                          <div class="card-head">
                            <div class="card-image">
                              <img :src="item.image" alt="PortailTN" />
                            </div>
                            <div class="card-title">
                              <h6 @click="goToJobDetail(item.id)">{{ item.title }}</h6>
                              <span class="job-type">{{ item.type }}</span>
                              <span class="time-post">Posté il y a {{ calculateDaysAgo(item.created_at) }} jours</span>
                              <span class="location">{{ item.city }}, {{ item.country }}</span>
                            </div>
                          </div>
                          <div class="card-tags">
                            <a v-for="tag in JSON.parse(item.skills)" :key="tag" class="btn btn-tag">{{ tag }}</a>
                          </div>
                          <div class="card-price">
                            <span>Salaire: {{ item.minSalary }} - {{ item.maxSalary }} DT</span>
                          </div>
                          <div class="card-tags">
                            <!-- button goToJobEdit-->
                            <a @click="goToEditJob(item.id)" class="btn btn-tag">Modifier</a>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
                <div class="paginations" v-if="paginatedItems.length > 0">
                  <ul class="pager">
                    <li @click="prevPage" :class="{ disabled: currentPage === 1 }">
                      <a class="pager-prev" href="#"></a>
                    </li>
                    <li v-for="page in totalPages" :key="page" @click="setPage(page)">
                      <a :class="['pager-number', { active: currentPage === page }]" href="#">{{ page }}</a>
                    </li>
                    <li @click="nextPage" :class="{ disabled: currentPage === totalPages }">
                      <a class="pager-next" href="#"></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      currentPage: 1,
      itemsPerPage: 4,
      items: [],
      loading: true, // Add loading state
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.items.slice(start, start + this.itemsPerPage);
    }
  },
  methods: {
    async fetchOffers() {
      const companyId = localStorage.getItem('id');
      try {
        const response = await axios.get(`http://localhost:8000/api/offre/societe/${companyId}`);
        this.items = response.data;
        
        await new Promise(resolve => setTimeout(resolve, 2000)); // Simulate delay for loading
      } catch (error) {
        console.error("Error fetching offers:", error.response ? error.response.data : error.message);
      } finally {
        this.loading = false; 
      }
    },
    calculateDaysAgo(createdAt) {
      const createdDate = new Date(createdAt);
      const currentDate = new Date();
      const timeDifference = currentDate - createdDate; // in milliseconds
      const daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24)); // convert to days
      return daysAgo;
    },
    setPage(page) {
      this.currentPage = page;
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    goToJobDetail(jobId) {
      this.$emit('viewJobDetail', jobId);
    },
    goToEditJob(jobId) {
    this.$emit('editJob', jobId); // Emit jobId to parent component
  }
  },
  mounted() {
    this.fetchOffers();
  }
}
</script>

<style scoped>
.skeleton-loader {
  display: flex;
  flex-direction: column;
}
.skeleton-card {
  background: #ffffff; /* Placeholder color */
  margin: 10px 0;
  padding: 15px;
  border-radius: 5px;
  animation: pulse 1.5s infinite;
}
.skeleton-image {
  height: 150px;
  background: #e5eaf0; /* Placeholder for image */
  border-radius: 5px;
  margin-bottom: 10px;
}
.skeleton-title {
  height: 20px;
  background: #e5eaf0; /* Placeholder for title */
  margin-bottom: 5px;
}
.skeleton-info {
  height: 15px;
  background: #e5eaf0; /* Placeholder for additional info */
  margin-bottom: 5px;
}
@keyframes pulse {
  0% {
    opacity: 0.5;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0.5;
  }
}
</style>

<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Candidats Postulés</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
            <li><span>Mes annonces</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container box-padding panel-white mb-30 row">
            <div class="col-lg-6">
              <h5 class="mb-30">Vos Offres</h5>
              <div v-if="loading">
                <div v-for="n in 3" :key="n" class="skeleton-loader">
                  <div class="skeleton-card">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-title"></div>
                    <div class="skeleton-info"></div>
                  </div>
                </div>
              </div>
              <div v-else>
                <div v-if="offres.length === 0">
                  <p>
                    Aucune offre disponible. Commencez par publier une offre.
                  </p>
                </div>
                <div
                  v-else
                  v-for="offre in offres"
                  :key="offre.id"
                  class="col-lg-12"
                >
                  <div
                    class="card-style-2 hover-up"
                    @click="getCandidatesByOffres(offre.id)"
                  >
                    <div class="card-head">
                      <div class="card-image">
                        <img :src="offre.image" alt="PortailTN" />
                      </div>
                      <div class="card-title">
                        <h6>
                          {{ offre.title }}
                        </h6>
                        <span class="job-type">{{ offre.type }}</span>
                        <span class="time-post"
                          >Posté il y a
                          {{ calculateDaysAgo(offre.created_at) }} jours</span
                        >
                        <span class="location"
                          >{{ offre.city }}, {{ offre.country }}</span
                        >
                      </div>
                     
                      <div class="card-price">
                        <span
                          >Salaire: {{ offre.minSalary }} -
                          {{ offre.maxSalary }} DT</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-6">
              <h5 class="mb-30">Vos candidats</h5>
              <div v-if="selectedOffre === false">
                <p>Selectionner une offre.</p>
              </div>
              <div v-else v-for="candidat in candidates" :key="candidat.id">
                <div
                  class="card-style-2 hover-up col-lg-12"
                  v-if="candidat.user.profil !== null"
                >
                  <div class="card-head">
                    <div class="card-image">
                      <img
                        :src="
                          'http://localhost:8000/api/profil/image/' +
                          candidat.user.profil.id
                        "
                        alt="PortailTN"
                      />
                    </div>
                    <div class="card-title">
                      <h6>
                        {{ candidat.user.firstname }}
                        {{ candidat.user.lastname }}
                      </h6>
                    </div>
                  </div>
                  <!-- show user profil button -->
                  <div class="">
                    <a @click="goToShowProfil(candidat.user.id)
                      
                      " class="btn btn-tag">Consulter</a>

                  </div>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, getCurrentInstance } from "vue";
import axios from "axios";


const ctx = getCurrentInstance(); // Get current instance context
const selectedOffre = ref(false);
const offres = ref({});
const candidates = ref([]);
const loading = ref(true);
onMounted(() => {
  getOffres();
});

const calculateDaysAgo = (createdAt) => {
  const createdDate = new Date(createdAt);
  const currentDate = new Date();
  const timeDifference = currentDate - createdDate; // in milliseconds
  const daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24)); // convert to days
  return daysAgo;
};

const getCandidatesByOffres = async (id) => {
  selectedOffre.value = true;
  const response = await axios.get(
    `http://localhost:8000/api/postulation/offre/${id}`
  );
  candidates.value = response.data;
  console.log("haw candidat",candidates.value)
};

const getOffres = async () => {
  const id = localStorage.getItem("id");
  const response = await axios.get(
    `http://localhost:8000/api/offre/societe/${id}`
  );
  offres.value = response.data;
  loading.value = false;
};

const goToShowProfil = (id) => {
  console.log("haw id", id);
  ctx.emit('showProfil', id); // Emit 'showProfil' event with profile ID
};


</script>

<style scoped>
.skeleton-loader {
  display: flex;
  flex-direction: column;
}
.skeleton-card {
  background: #e0e0e0; /* Placeholder color */
  margin: 10px 0;
  padding: 15px;
  border-radius: 5px;
  animation: pulse 1.5s infinite;
}
.skeleton-image {
  height: 150px;
  background: #c0c0c0; /* Placeholder for image */
  border-radius: 5px;
  margin-bottom: 10px;
}
.skeleton-title {
  height: 20px;
  background: #c0c0c0; /* Placeholder for title */
  margin-bottom: 5px;
}
.skeleton-info {
  height: 15px;
  background: #c0c0c0; /* Placeholder for additional info */
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

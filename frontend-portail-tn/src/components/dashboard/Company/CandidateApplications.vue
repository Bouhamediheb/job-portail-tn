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
                  <p>Aucune offre disponible. Commencez par publier une offre.</p>
                </div>
                <div v-else>
                  <!-- Display only offers for the current page -->
                  <div v-for="offre in paginatedOffres" :key="offre.id" class="col-lg-12">
                    <div class="card-style-2 hover-up" @click="getCandidatesByOffres(offre.id)">
                      <div class="card-head">
                        <div class="card-image">
                          <img
                            :src="'http://localhost:8000/api/societe/logo/' + offre.societe_id"
                            alt="PortailTN" />
                        </div>
                        <div class="card-title">
                          <h6>{{ offre.title }}</h6>
                          <span class="job-type">{{ offre.type }}</span>
                          <span class="time-post">Posté il y a {{ calculateDaysAgo(offre.created_at) }} jours</span>
                          <span class="location">{{ offre.city }}, {{ offre.country }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Pagination Controls -->
                  <div class="paginations" v-if="paginatedOffres.length > 0">
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

            <div class="col-lg-6">
              <h5 class="mb-30">Vos candidats</h5>
              <div v-if="selectedOffre === false">
                <p>Selectionner une offre.</p>
              </div>
              <div v-else>
                <div v-if="candidates.length === 0">
                  <p>Aucun candidat pour ce poste {{ selectedOffre.type === 'internship' ? 'stage' : 'emploi' }} pour le moment.</p>
                </div>
                <div v-else v-for="candidat in candidates" :key="candidat.id">
                  <div class="card-style-2 hover-up col-lg-12" v-if="candidat.user.profil !== null">
                    <div class="card-head">
                      <div class="">
                        <img :src="'http://localhost:8000/api/profil/image/' + candidat.user.profil.id" alt="PortailTN" class="profile-pic" />
                      </div>
                      <div class="card-title ml-20 mt-15">
                        <h6>{{ candidat.user.firstname }} {{ candidat.user.lastname }}</h6>
                      </div>
                    </div>
                    <!-- show user profile button -->
                    <div>
                      <a @click="goToShowProfil(candidat.user.id)" class="btn btn-tag">Consulter</a>
                    </div>
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
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const selectedOffre = ref(false);
const offres = ref([]);
const candidates = ref([]);
const loading = ref(true);

const currentPage = ref(1);
const itemsPerPage = 4;

const totalPages = computed(() => Math.ceil(offres.value.length / itemsPerPage));

const paginatedOffres = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return offres.value.slice(start, end);
});

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
  try {
    if (Array.isArray(offres.value)) {
      selectedOffre.value = offres.value.find(offre => offre.id === id);
      
      if (selectedOffre.value) {
        const response = await axios.get(`http://localhost:8000/api/postulation/offre/${id}`);
        candidates.value = response.data;
        console.log('Candidates:', candidates.value);
      } else {
        console.error('Offer not found');
      }
    } else {
      console.error('Offres is not an array');
    }
  } catch (error) {
    console.error('Error fetching candidates:', error);
  }
};

const getOffres = async () => {
  const id = localStorage.getItem('id');
  try {
    const response = await axios.get(`http://localhost:8000/api/offre/societe/${id}`);
    offres.value = response.data;
    loading.value = false;
  } catch (error) {
    console.error('Error fetching offres:', error);
  }
};
const goToShowProfil = (id) => {
  const url = router.resolve({ name: 'profile', query: { userId: id } }).href;
  window.open(url, '_blank');
};

// Change page
const setPage = (pageNumber) => {
  if (pageNumber >= 1 && pageNumber <= totalPages.value) {
    currentPage.value = pageNumber;
  }
};

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value -= 1;
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value += 1;
  }
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


/* Style for the profile picture */
.profile-pic {
  width: 90px; /* Set width as desired */
  height: 60px; /* Set height as desired */
  border-radius: 50% !important; /* Makes the image rounded */
}

/* Pagination Controls */
.paginations {
  margin-top: 20px;
}

.pager {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
}

.pager li {
  margin: 0 5px;
}

.pager a {
  display: block;
  padding: 10px 20px;
  text-decoration: none;
  cursor: pointer;
}

.pager a.active {
  color: white;
}

.pager a.disabled {
  color: #e0e0e0;
  border-color: #e0e0e0;
  cursor: not-allowed;
}

</style>

<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mes Candidatures</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
            <li><span>Mes Candidatures</span></li>
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
                  <div class="row">
                    <div class="mb-30">
                      <label class="font-sm color-text-muted mb-10 mt-2"
                        >Type d'offre *</label
                      >
                      <select
                        v-model="jobType"
                        class="form-control"
                        @change="handleJobTypeChange"
                      >
                        <option value="job">Offre d'emploi</option>
                        <option value="internship">Stage</option>
                      </select>
                    </div>
                  </div>
                  <template v-if="loading">
                    <div class="skeleton-loader" v-for="n in 3" :key="n">
                      <div class="skeleton-card">
                        <div class="skeleton-image"></div>
                        <div class="skeleton-title"></div>
                        <div class="skeleton-info"></div>
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div
                      v-if="applications.length === 0"
                      class="no-offers-message"
                    >
                      <p>Aucune candidature disponible.</p>
                    </div>
                    <div v-else>
                      <div
                        class="col-lg-12"
                        v-for="application in applications"
                        :key="application.offre.id"
                      >
                        <div
                          class="card-style-2 hover-up"
                          v-if="application.offre.type === jobType"
                          @click="goToJobDetail(application.offre.id)"
                        >
                          <div class="card-head">
                            <div class="card-image">
                              <img
                                :src="
                                  'http://localhost:8000/api/societe/logo/' +
                                  application.offre.societe_id
                                "
                                alt="PortailTN"
                              />
                            </div>
                            <div class="card-title">
                              <h6>
                                {{ application.offre.title }}
                              </h6>
                              <span class="job-type">{{
                                application.offre.type
                              }}</span>
                              <span class="time-post"
                                >Publiée il y a
                                {{
                                  calculateDaysAgo(application.offre.created_at)
                                }}
                                jours</span
                              >
                              <span class="location"
                                >{{ application.offre.city }},
                                {{ application.offre.country }}</span
                              >
                            </div>
                          </div>
                          <div class="card-tags">
                            <a
                              v-for="tag in JSON.parse(
                                application.offre.skills
                              )"
                              :key="tag"
                              class="btn btn-tag"
                              >{{ tag }}</a
                            >
                          </div>
                          <div class="card-price">
                            <span
                              >Salaire: {{ application.offre.minSalary }} -
                              {{ application.offre.maxSalary }} DT</span
                            >
                          </div>
                          <div class="card-body">
                            <p>{{ application.offre.description }}</p>
                          </div>
                        </div>
                        <div class="no-offers-message" v-else>
                          <p>Aucune candidature disponible.</p>
                        </div>
                      </div>
                    </div>
                  </template>
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
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const loading = ref(true);
const applications = ref([]);
const id = localStorage.getItem("id");
const jobType = ref("job");

onMounted(() => {
  getApplications(id);
});

const goToJobDetail = (id) => {
  router.push({ name: "JobDetail", params: { id: id } });
};

const handleJobTypeChange = () => {
  loading.value = true;
  setTimeout(() => {
    loading.value = false;
  }, "1000");
};

const getApplications = async (id) => {
  const response = await axios.get(
    `http://localhost:8000/api/postulation/user/${id}`
  );
  applications.value = response.data;
  loading.value = false;
};

const calculateDaysAgo = (createdAt) => {
  const createdDate = new Date(createdAt);
  const currentDate = new Date();
  const timeDifference = currentDate - createdDate; // in milliseconds
  const daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24)); // convert to days
  return daysAgo;
};
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
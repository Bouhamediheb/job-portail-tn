<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mon Dashboard</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard">Dashboard</router-link>
            </li>
            <li><span>Dashboard</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xxl-8 col-xl-7 col-lg-7">
        <div class="section-box">
          <div class="row">
            <div v-if="isCompany" class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img src="assets/dashboard/imgs/page/dashboard/computer.svg" alt="PortailTN" />
                </div>
                <div class="card-title">
                  <h3>{{ totalOffres }}</h3>
                  <p class="color-text-paragraph-2">Offres postées</p>
                </div>
              </div>
            </div>
            <div v-if="isCompany" class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img src="assets/dashboard/imgs/page/dashboard/computer.svg" alt="PortailTN" />
                </div>
                <div class="card-title">
                  <h3>{{ totalJobs }}</h3>
                  <p class="color-text-paragraph-2">Offres d'emplois</p>
                </div>
              </div>
            </div>
            <div v-if="isCompany" class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img src="assets/dashboard/imgs/page/dashboard/computer.svg" alt="PortailTN" />
                </div>
                <div class="card-title">
                  <h3>{{ totalStages }}</h3>
                  <p class="color-text-paragraph-2">Offres de stages</p>
                </div>
              </div>
            </div>
            <div v-if="isCompany" class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img src="assets/dashboard/imgs/page/dashboard/computer.svg" alt="PortailTN" />
                </div>
                <div class="card-title">
                  <h3>{{ totalApplication }}</h3>
                  <p class="color-text-paragraph-2">Total candidats</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section-box" v-if="isCompany">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Votre activité par mois</h5>
                <a class="menudrop" id="dropdownMenu2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu2">
                  <li><a class="dropdown-item active" href="#">Add new</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Actions</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <canvas ref="chartRef" id="chartdiv"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="section-box" v-if="isCompany">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Mes derniéres annonces</h5>
                <a class="menudrop" id="dropdownMenu3" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu3">
                  <li><a class="dropdown-item active" href="#">Add new</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Actions</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <div v-if="!lastOffers || lastOffers.length === 0" class="no-offers-message center-content">
                  <p>Aucune annonce disponible.</p>
                </div>
                <div v-else>
                  <div v-for="offer in lastOffers" :key="offer.id" class="card-style-2 hover-up">
                    <div class="card-head">
                      <div class="card-image">
                        <img :src="offer.imageUrl" alt="PortailTN" />
                      </div>
                      <div class="card-title">
                        <h6>{{ offer.title }}</h6>
                        <span class="job-type">{{ offer.jobType }}</span>
                        <span class="time-post">{{ offer.timePosted }}</span>
                        <span class="location">{{ offer.location }}</span>
                      </div>
                    </div>
                    <div class="card-tags">
                      <a v-for="tag in offer.tags" :key="tag" class="btn btn-tag">{{ tag }}</a>
                    </div>
                    <div class="card-price">
                      <strong>{{ offer.price }}</strong><span class="hour">/Hour</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="isCompany" class="col-xxl-4 col-xl-5 col-lg-5">
        <div class="section-box">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Derniers Candidats</h5>
                <a class="menudrop" id="dropdownMenu4" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu4">
                  <li><a class="dropdown-item active" href="#">Add new</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Actions</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <div v-if="latestCandidates.length === 0">
                  <p>No candidates available.</p>
                </div>
                <div v-else>
                  <div class="card-style-3 hover-up" v-for="candidat in latestCandidates" :key="candidat.id">
                    <div class="card-image online">
                      <img v-if="candidat.user.profil && candidat.user.profil.id"
                           :src="'http://localhost:8000/api/profil/image/' + candidat.user.profil.id"
                           alt="PortailTN" />
                      <img v-else
                           src="fallback-image.jpg"
                           alt="Fallback Image" />
                    </div>
                    <div class="card-title">
                      <h6>{{ candidat.user.firstname }} {{ candidat.user.lastname }}</h6>
                      <span class="job-position">UI Designer</span>
                    </div>
                    <div class="card-location ml-5">
                      <span v-if="candidat.user.profil && candidat.user.profil.city && candidat.user.profil.country">
                        {{ candidat.user.profil.city }}, {{ candidat.user.profil.country }}
                      </span>
                      <span v-else class="text-muted">Location not available</span>
                    </div>
                    <div class="card-rating">
                      <!-- Placeholder for rating -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="isCompany" class="mt-10">
      <div class="section-box">
        <div class="container">
          <div class="panel-white pt-30 pb-30 pl-15 pr-15">
            <div class="box-swiper">
              <div class="swiper-container swiper-group-10">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/microsoft.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/sony.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/acer.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/nokia.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/asus.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/casio.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/dell.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/panasonic.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/vaio.svg" alt="PortailTN" />
                  </div>
                  <div class="swiper-slide">
                    <img src="assets/dashboard/imgs/page/dashboard/sony.svg" alt="PortailTN" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer mt-20">
      <div class="container">
        <div class="box-footer">
          <div class="row">
            <div class="col-md-6 col-sm-12 mb-25 text-center text-md-start"></div>
            <div class="col-md-6 col-sm-12 text-center text-md-end mb-25">
              <ul class="menu-footer">
                <li><a href="#">A propos de nous</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Termes et conditions</a></li>
                <li><a href="#">Politique de confidentialité</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Chart, registerables } from "chart.js";

Chart.register(...registerables); // Register Chart.js components

export default {
  setup() {
    const userType = localStorage.getItem("type");
    const isCompany = userType === "company";

    const company_id = ref(localStorage.getItem("id"));
    const chartRef = ref(null);
    const totalOffres = ref(0);
    const totalJobs = ref(0);
    const totalStages = ref(0);
    const totalApplication = ref(0);
    const latestCandidates = ref([]);

    onMounted(async () => {
      try {
        if (isCompany) {
          const responseLatestCandidates = await axios.get(`http://localhost:8000/api/postulation/societe/${company_id.value}/latest`);
          latestCandidates.value = responseLatestCandidates.data;

          const responseStages = await axios.get(`http://localhost:8000/api/offre/internship/societe/${company_id.value}`);
          const responseJobs = await axios.get(`http://localhost:8000/api/offre/jobs/societe/${company_id.value}`);

          totalStages.value = responseStages.data.length;
          totalJobs.value = responseJobs.data.length;
          totalOffres.value = totalStages.value + totalJobs.value;

          const monthlyData = aggregateMonthlyData(responseStages.data, responseJobs.data);
          createChart(monthlyData);
        }
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    });

    const aggregateMonthlyData = (internships, jobs) => {
      const months = Array(12).fill(0);

      const countByMonth = (items) => {
        items.forEach((item) => {
          const month = new Date(item.created_at).getMonth(); // Use created_at field
          months[month]++;
        });
      };

      countByMonth(internships);
      countByMonth(jobs);

      return {
        labels: [
          "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ],
        data: months,
      };
    };

    const createChart = (monthlyData) => {
      const ctx = chartRef.value.getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: monthlyData.labels,
          datasets: [{
            label: "Nombre d'annonces",
            data: monthlyData.data,
            backgroundColor: "#42A5F5",
            borderColor: "#1E88E5",
            borderWidth: 1,
          }],
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1,
              },
            },
          },
        },
      });
    };

    return {
      chartRef,
      totalOffres,
      totalJobs,
      totalStages,
      totalApplication,
      latestCandidates,
      isCompany,
    };
  },
};
</script>

<style>
#chartdiv {
  width: 100%;
  height: 400px; /* Set a height for your chart */
}
</style>

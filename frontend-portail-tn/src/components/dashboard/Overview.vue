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
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
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
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img
                    src="assets/dashboard/imgs/page/dashboard/computer.svg"
                    alt="PortailTN"
                  />
                </div>

                <div class="card-title">
                  <h3>{{ totalOffres }}</h3>

                  <p class="color-text-paragraph-2">Offres postées</p>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img
                    src="assets/dashboard/imgs/page/dashboard/computer.svg"
                    alt="PortailTN"
                  />
                </div>

                <div class="card-title">
                  <h3>{{ totalJobs }}</h3>

                  <p class="color-text-paragraph-2">Offres d'emplois</p>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img
                    src="assets/dashboard/imgs/page/dashboard/computer.svg"
                    alt="PortailTN"
                  />
                </div>

                <div class="card-title">
                  <h3>{{ totalStages }}</h3>

                  <p class="color-text-paragraph-2">Offres de stages</p>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
              <div class="card-style-1 hover-up">
                <div class="card-image">
                  <img
                    src="assets/dashboard/imgs/page/dashboard/computer.svg"
                    alt="PortailTN"
                  />
                </div>

                <div class="card-title">
                  <h3>{{ totalApplication }}</h3>

                  <p class="color-text-paragraph-2">Total candidats</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section-box">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Votre activité par mois</h5>
                <a
                  class="menudrop"
                  id="dropdownMenu2"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  data-bs-display="static"
                ></a>
                <ul
                  class="dropdown-menu dropdown-menu-light dropdown-menu-end"
                  aria-labelledby="dropdownMenu2"
                >
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
        <div class="section-box">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Mes derniéres annonces</h5>
                <a
                  class="menudrop"
                  id="dropdownMenu3"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  data-bs-display="static"
                ></a>
                <ul
                  class="dropdown-menu dropdown-menu-light dropdown-menu-end"
                  aria-labelledby="dropdownMenu3"
                >
                  <li><a class="dropdown-item active" href="#">Add new</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Actions</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <div
                  v-if="!lastOffers || lastOffers.length === 0"
                  class="no-offers-message center-content"
                >
                  <p>Aucune annonce disponible.</p>
                </div>
                <div v-else>
                  <div
                    v-for="offer in lastOffers"
                    :key="offer.id"
                    class="card-style-2 hover-up"
                  >
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
                      <a
                        v-for="tag in offer.tags"
                        :key="tag"
                        class="btn btn-tag"
                        >{{ tag }}</a
                      >
                    </div>
                    <div class="card-price">
                      <strong>{{ offer.price }}</strong
                      ><span class="hour">/Hour</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4 col-xl-5 col-lg-5">
        <div class="section-box">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Derniers Candidats</h5>
                <a
                  class="menudrop"
                  id="dropdownMenu4"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  data-bs-display="static"
                ></a>
                <ul
                  class="dropdown-menu dropdown-menu-light dropdown-menu-end"
                  aria-labelledby="dropdownMenu4"
                >
                  <li><a class="dropdown-item active" href="#">Add new</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Actions</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <div
                  class="card-style-3 hover-up"
                  v-for="candidat in latestCandidates"
                  :key="candidat.id"
                >
                  <div class="card-image online">
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
                      {{ candidat.user.firstname }} {{ candidat.user.lastname }}
                    </h6>
                    <span class="job-position">UI Designer</span>
                  </div>
                  <div class="card-location ml-5">
                    <span
                      >{{ candidat.user.profil.city }},
                      {{ candidat.user.profil.country }}</span
                    >
                  </div>
                  <div class="card-rating">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/star.svg"
                      alt="PortailTN"
                    />
                    <img
                      src="assets/dashboard/imgs/page/dashboard/star.svg"
                      alt="PortailTN"
                    />
                    <img
                      src="assets/dashboard/imgs/page/dashboard/star.svg"
                      alt="PortailTN"
                    />
                    <img
                      src="assets/dashboard/imgs/page/dashboard/star.svg"
                      alt="PortailTN"
                    />
                    <img
                      src="assets/dashboard/imgs/page/dashboard/star.svg"
                      alt="PortailTN"
                    />
                    <span class="font-xs color-text-mutted"> </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5>Top Recruiters</h5><a class="menudrop" id="dropdownMenu5" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu5">
                      <li><a class="dropdown-item active" href="#">Add new</a></li>
                      <li><a class="dropdown-item" href="#">Settings</a></li>
                      <li><a class="dropdown-item" href="#">Actions</a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <div class="row"> 
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata1.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Robert Fox</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Red, CA</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata2.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Cody Fisher</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Chicago, US</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata3.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Jane Cooper</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Austin, TX</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata4.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Jerome Bell</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Remote</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata5.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Floyd Miles</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Boston, US</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 pr-5 pl-5">
                        <div class="card-style-4 hover-up">
                          <div class="d-flex">
                            <div class="card-image"><img src="assets/dashboard/imgs/page/dashboard/avata1.png" alt="PortailTN"></div>
                            <div class="card-title"> 
                              <h6>Devon Lane</h6><img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <img src="assets/dashboard/imgs/page/dashboard/star-none.svg" alt="PortailTN"> <span class="font-xs color-text-mutted">
                                 (65)</span>
                            </div>
                          </div>
                          <div class="card-location d-flex"><span class="location">Chicago, US</span><span class="jobs-number">25 Open Jobs</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="section-box">
              <div class="container"> 
                <div class="panel-white">
                  <div class="panel-head"> 
                    <h5>Queries by search</h5><a class="menudrop" id="dropdownMenu6" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownMenu6">
                      <li><a class="dropdown-item active" href="#">Add new</a></li>
                      <li><a class="dropdown-item" href="#">Settings</a></li>
                      <li><a class="dropdown-item" href="#">Actions</a></li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Developer</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">2635</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">UI/Ux Designer</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">1658</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 90%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Marketing</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">1452</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 80%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Content manager</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">1325</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 70%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Ruby on rain</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">985</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 60%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Human hunter</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">920</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-style-5 hover-up">
                      <div class="card-title"> 
                        <h6 class="font-sm">Finance</h6>
                      </div>
                      <div class="card-progress"> 
                        <div class="number font-sm">853</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 40%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
      </div>
    </div>
    <div class="mt-10">
      <div class="section-box">
        <div class="container">
          <div class="panel-white pt-30 pb-30 pl-15 pr-15">
            <div class="box-swiper">
              <div class="swiper-container swiper-group-10">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/microsoft.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/sony.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/acer.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/nokia.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/asus.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/casio.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/dell.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/panasonic.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/vaio.svg"
                      alt="PortailTN"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/sony.svg"
                      alt="PortailTN"
                    />
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
            <div
              class="col-md-6 col-sm-12 mb-25 text-center text-md-start"
            ></div>
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
    const company_id = ref(localStorage.getItem("id"));
    const chartRef = ref(null);
    const totalOffres = ref(0);
    const totalJobs = ref(0);
    const totalStages = ref(0);
    const totalApplication = ref(0);
    const latestCandidates = ref([]);

    onMounted(async () => {
      try {
        const responseLatestCandidates = await axios.get(
          `http://localhost:8000/api/postulation/societe/${company_id.value}/latest`
        );

        latestCandidates.value = responseLatestCandidates.data;
        console.log(latestCandidates.value);

        const responseStages = await axios.get(
          `http://localhost:8000/api/offre/internship/societe/${company_id.value}`
        );
        const responseJobs = await axios.get(
          `http://localhost:8000/api/offre/jobs/societe/${company_id.value}`
        );

        const totalStagesChartData = responseStages.data;
        const totalJobsChartData = responseJobs.data;

        totalStages.value = responseStages.data.length;
        totalJobs.value = responseJobs.data.length;
        totalOffres.value = totalStages.value + totalJobs.value;

        console.log(totalStages, totalJobs);

        const monthlyData = aggregateMonthlyData(
          totalStagesChartData,
          totalJobsChartData
        );
        createChart(monthlyData);
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
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
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
          datasets: [
            {
              label: "Nombre d'annonces",
              data: monthlyData.data,
              backgroundColor: "#42A5F5",
              borderColor: "#1E88E5",
              borderWidth: 1,
            },
          ],
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
<template>
  <div v-if="job">
    <section class="section-box-2">
      <div class="container">
        <div class="banner-hero banner-image-single"><img src="assets/home/imgs/page/job-single/thumb.png" alt="jobBox">
        </div>
        <div class="row mt-10">
          <div class="col-lg-8 col-md-12">
            <h3 class="ml-20">{{ job.title }}</h3>
            <div class="mt-0 mb-15 ml-20"><span class="card-briefcase">
                {{ job.employmentType === 1 ? 'Fulltime' : 'Parttime' }}
              </span class="ml-20"><span class="card-time">3 mins ago</span></div>
          </div>
          <div class="col-lg-4 col-md-12 text-lg-end">
          </div>
        </div>
        <div class="border-bottom pt-10 pb-10"></div>
      </div>
    </section>
    <section class="section-box mt-50">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="job-overview">
              <h5 class="border-bottom pb-15 mb-30">Informations :</h5>
              <div class="row">
                <div class="col-md-6 d-flex">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/industry.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span class="text-description industry-icon mb-10">Domaine
                    </span><strong class="small-heading"> {{ job.domain }}</strong></div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/job-level.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span
                      class="text-description joblevel-icon mb-10">Type</span><strong class="small-heading">
                      {{ job.type === 'job' ? 'Offre emploi' : 'Stage' }}
                    </strong></div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/salary.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span
                      class="text-description salary-icon mb-10">Salary</span><strong class="small-heading">
                      {{ job.minSalary }}DT -- {{ job.maxSalary }}DT

                    </strong></div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/experience.svg"
                      alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10"><span
                      class="text-description experience-icon mb-10">Expérience</span><strong class="small-heading">{{
                        job.yearsOfExperience }} ans</strong></div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/job-type.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span
                      class="text-description jobtype-icon mb-10">Emplacement:</span><strong class="small-heading">
                      {{ job.workplace === 0 ? 'Télétravail' : job.workplace === 1 ? 'Bureau' : 'Hybrid' }}
                    </strong></div>
                </div>

                <div class="col-md-6 d-flex mt-sm-15" v-if="job.type == 'stage'">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/deadline.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span class="text-description mb-10">Durée</span><strong
                      class="small-heading">{{ job.internshipDuration }}</strong></div>
                </div>
              </div>

              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/location.svg" alt="jobBox">
                  </div>
                  <div class="sidebar-text-info ml-10"><span class="text-description mb-10">Location</span><strong
                      class="small-heading">{{ job.city }} , {{ job.country }}</strong></div>
                </div>

              </div>
            </div>
            <div class="content-single">
              <h4>Description du poste :</h4>
              <p class="ml-20"> {{ job.description }}</p>
            </div>
            <div class="content-single">
              <h4>Compétences requises:</h4>
              <!--itérate         "skills": "[\"Python\", \"JavaScript\"]", job.skills (json)-->
              <ul class="ul-disc">
                <li class="ml-20" v-for="skill in JSON.parse(job.skills)" :key="skill">{{ skill }}</li>
              </ul>
            </div>

            <div class="single-apply-jobs">
              <div class="row align-items-center">
                <div class="col-md-6">
  <a class="btn btn-default mr-15" href="#" @click="postuler(job.id, getUserIdFromLocalStorage())">Postuler !</a>
</div>                
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
            <div class="sidebar-border">
              <div class="sidebar-heading">
                <div class="avatar-sidebar">
                  <figure><img alt="jobBox" src="assets/home/imgs/page/job-single/avatar.png"></figure>
                  <div class="sidebar-info"><span class="sidebar-company">{{ company?.name }}</span><span
                      class="card-location">{{ company?.city }},{{ company?.country }}</span></div>
                </div>
              </div>
              <div class="sidebar-list-job">
                <div class="box-map">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.3150609575905!2d-87.6235655!3d41.886080899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2ca8b34afe61%3A0x6caeb5f721ca846!2s205%20N%20Michigan%20Ave%20Suit%20810%2C%20Chicago%2C%20IL%2060601%2C%20Hoa%20K%E1%BB%B3!5e0!3m2!1svi!2s!4v1658551322537!5m2!1svi!2s"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <ul class="ul-disc">
                  <li>{{ company?.address }} </li>
                  <li>{{ company?.phoneNumber }}</li>
                  <li>{{ company?.email }} </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Loading State -->
  <div v-else>
    <p>Loading job details...</p>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, defineProps } from 'vue';

const props = defineProps({
  jobId: {
    type: Number,
    required: true
  }
});

let job = ref();
let company = ref();

const fetchJobDetail = async (jobId) => {
  try {
    const jobResponse = await axios.get(`http://localhost:8000/api/offre/job/${jobId}`);
    job.value = jobResponse.data[0];

    const companyResponse = await axios.get(`http://localhost:8000/api/societe/profile/${job.value.societe_id}`);
    company.value = companyResponse.data;

    console.log("Job:", job.value);
    console.log("Company:", company.value);
  } catch (error) {
    console.error("Error fetching job or company detail:", error.response ? error.response.data : error.message);
  }
};

const postuler = async (offreId, userId) => {
  try {
    // Assuming getUserIdFromLocalStorage() is a function that retrieves the userId from local storage
    const response = await axios.post(`http://localhost:8000/api/postulation/${offreId}/${userId}`);
    console.log("Postulation response:", response.data);

    // Optionally, you can handle success scenarios here (e.g., show a success message)
  } catch (error) {
    console.error("Error posting application:", error.response ? error.response.data : error.message);
    // Handle error scenarios here (e.g., show an error message to the user)
  }
};

const getUserIdFromLocalStorage = () => {
  // Replace with your logic to retrieve userId from localStorage
  return localStorage.getItem('id');
};

// Hook to fetch job details when component is mounted
onMounted(() => {
  fetchJobDetail(props.jobId);
  console.log(props.jobId);
});
</script>

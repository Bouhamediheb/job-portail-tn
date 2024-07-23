<template>
  <div v-if="loading" class="skeleton-loading">
    <div class=" ml-50 mr-50 banner-hero skeleton-banner"></div>
    <div class=" ml-50 mr-50 skeleton-info"></div>
    <div class=" ml-50 mr-50 skeleton-placeholder"></div>
    <div class=" ml-50 mr-50 skeleton-placeholder"></div>

  </div>
  <div v-else>
    <section class="section-box-2">
      <div class="container">
        <div class="banner-hero banner-image-single"><img src="/assets/home/imgs/page/job-single/thumb.png" alt="PortailTN"></div>
        <div class="row mt-10">
          <div class="col-lg-8 col-md-12">
            <h3 class="ml-20">{{ job.title }}</h3>
            <div class="mt-0 mb-15 ml-20">
              <span class="card-briefcase">{{ job.employmentType === 1 ? 'Fulltime' : 'Parttime' }}</span>
              <span class="card-time">3 mins ago</span>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 text-lg-end"></div>
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
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/industry.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description industry-icon mb-10">Domaine</span>
                    <strong class="small-heading">{{ job.domain }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/job-level.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description joblevel-icon mb-10">Type</span>
                    <strong class="small-heading">{{ job.type === 'job' ? 'Offre emploi' : 'Stage' }}</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/salary.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description salary-icon mb-10">Salary</span>
                    <strong class="small-heading">{{ job.minSalary }}DT -- {{ job.maxSalary }}DT</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/experience.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description experience-icon mb-10">Expérience</span>
                    <strong class="small-heading">{{ job.yearsOfExperience }} ans</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/job-type.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description jobtype-icon mb-10">Emplacement</span>
                    <strong class="small-heading">{{ job.workplace === 0 ? 'Télétravail' : job.workplace === 1 ? 'Bureau' : 'Hybrid' }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15" v-if="job.type == 'stage'">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/deadline.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description mb-10">Durée</span>
                    <strong class="small-heading">{{ job.internshipDuration }}</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="/assets/home/imgs/page/job-single/location.svg" alt="PortailTN"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description mb-10">Location</span>
                    <strong class="small-heading">{{ job.city }}, {{ job.country }}</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-single">
              <h4>Description du poste :</h4>
              <p class="ml-20">{{ job.description }}</p>
            </div>
            <div class="content-single">
              <h4>Compétences requises:</h4>
              <ul class="ul-disc">
                <li class="ml-20" v-for="skill in JSON.parse(job.skills || '[]')" :key="skill">{{ skill }}</li>
              </ul>
              <p class="ml-20" v-if="JSON.parse(job.skills || '[]').length === 0">Aucune compétence requise</p>
            </div>
            <div class="single-apply-jobs" v-if="isItaUser()">
        <div class="row align-items-center">
          <div class="col-md-6" v-if="!alreadyApplied()">
            <a class="btn btn-default mr-15" href="#" @click="postuler(job.id)">Postuler !</a>
          </div>
          <div class="col-md-6" v-else-if="isAdmin()">
            <button class="btn btn-default mr-15" style="background-color: grey;" disabled>Cacher cette annonce</button>
          </div>
          <div class="col-md-6" v-else>
            <button class="btn btn-default mr-15" style="background-color: grey;" disabled>Déjà postulé</button>
          </div>
        </div>
      </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
            <div class="sidebar-border">
              <div class="sidebar-heading">
                <div class="avatar-sidebar">
                  <figure><img alt="PortailTN" src="/assets/home/imgs/page/job-single/avatar.png"></figure>
                  <div class="sidebar-info">
                    <span class="sidebar-company">{{ company?.name }}</span>
                    <span class="card-location">{{ company?.city }}, {{ company?.country }}</span>
                  </div>
                </div>
              </div>
              <div class="sidebar-list-job">
                <ul class="ul-disc">
                  <li>{{ company?.address }}</li>
                  <li>{{ company?.phoneNumber }}</li>
                  <li>{{ company?.email }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <sweet-modal icon="success" ref="submitted">
          <div class="spacingtop">
            Votre candidature a été envoyée avec succès !
          </div>
        </sweet-modal>
      </div>
    </section>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { SweetModal, SweetModalTab } from "sweet-modal-vue-3";
import { useRouter } from "vue-router";

const props = defineProps({
  jobId: {
    type: Number,
    required: true
  }
});

const loading = ref(true);
const submitted = ref(null);
const job = ref({});
const company = ref({});
const userId = ref(null);
const applications = ref([]);
const router = useRouter();

const storedJobId = localStorage.getItem('jobId');
const jobId = props.jobId;

console.log("Stored jobId:", storedJobId);
console.log("Props jobId:", props.jobId);
console.log("Final jobId:", jobId);


const fetchJobDetail = async (
  jobId
) => {
  try {
    console.log("Fetching details for jobId:", jobId);
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


const postuler = async (offreId) => {
  console.log("Postuler:", offreId, userId.value);
  try {
    const response = await axios.post(`http://localhost:8000/api/postulation/${offreId}/${userId.value}`);
    console.log("Postulation response:", response.data);
    if (submitted.value) {
      submitted.value.open();
    }
    setTimeout(() => {
      router.push("/");
    }, 2000);
  } catch (error) {
    console.error("Error posting application:", error.response ? error.response.data : error.message);
  }
};

const isAdmin = () => {
  return localStorage.getItem('type') === 'admin';
};

const isItaUser = () => {
  return localStorage.getItem('type') === 'user';
};

const getUserIdFromLocalStorage = () => {
  userId.value = localStorage.getItem('id');
};

const fetchUserApplications = async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/postulation/user/${userId.value}`);
    applications.value = response.data;
    console.log('User applications:', applications.value);
  } catch (error) {
    console.error('Error fetching user applications:', error);
  }
};

const alreadyApplied = () => {
  return applications.value.some(application => application.offre_id === props.jobId);
};

localStorage.setItem('jobId', jobId);

onMounted(() => {
  fetchJobDetail(jobId);
  getUserIdFromLocalStorage();
  fetchUserApplications();
  setTimeout(() => {
    loading.value = false;
  }, 2000);
});
</script>

<style scoped>
.skeleton-loading {
  background-color: #fff;
  border-radius: 8px;
  padding: 20px;
}

.skeleton-banner {
  height: 300px;
  background-color: #f1f0f0;
  border-radius: 8px;
}

.skeleton-info {
  height: 50vh;
  background-color: #f1f0f0;
  margin-top: 20px;
  border-radius: 4px;
}

.skeleton-placeholder {
  height: 20px;
  background-color: #f1f0f0;
  margin-top: 10px;
  border-radius: 4px;
}
</style>

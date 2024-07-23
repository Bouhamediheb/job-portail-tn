<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">{{ jobId ? 'Modifier une offre' : 'Publier une offre' }}</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard">Dashboard</router-link>
            </li>
            <li><span>{{ jobId ? 'Modifier une annonce' : 'Publier une annonce' }}</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding bg-postjob">
                <h5 class="icon-edu">
                  {{ jobId ? 'Modifier les informations de votre offre' : 'Veuillez remplir les informations de votre offre' }}
                </h5>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10 mt-2">Type d'offre *</label>
                  <select
                    v-model="type"
                    class="form-control"
                    @change="resetFields"
                  >
                    <option value="job">Offre d'emploi</option>
                    <option value="internship">Stage</option>
                  </select>
                </div>

                <!-- Job-specific fields -->
                <div v-if="type === 'job'">
                  <h5>Détails de l'offre d'emploi</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2">Titre de l'offre *</label>
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Exemple : Développeur Full Stack"
                      v-model="jobDetails.title"
                    />
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10 mt-2">Description de l'offre *</label>
                      <textarea
                        class="form-control"
                        name="message"
                        rows="8"
                        placeholder="Exemple : Nous recherchons un développeur Full Stack pour rejoindre notre équipe de développement."
                        v-model="jobDetails.description"
                      ></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mb-30">
                        <label class="font-sm color-text-muted mb-10">Domaine *</label>
                        <select class="form-control" v-model="jobDetails.domain">
                          <option value="Informatique">Informatique</option>
                          <option value="Finance">Finance</option>
                          <option value="Mecanique">Mecanique</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-30">
                        <label class="font-sm color-text-muted mb-10">Horaire *</label>
                        <select class="form-control" v-model="jobDetails.employmentType">
                          <option value="0">Demi-Temps</option>
                          <option value="1">Plein-Temps</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Expérience *</label>
                    <input
                      class="form-control"
                      type="number"
                      placeholder="Exemple : 2"
                      v-model="jobDetails.yearsOfExperience"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Type de lieu de travail *</label>
                    <select class="form-control" v-model="jobDetails.workplace">
                      <option value="0">Télétravail</option>
                      <option value="1">Bureau</option>
                      <option value="2">Hybride</option>
                    </select>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10">Lieu (siège) *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Route de la Marsa"
                        v-model="jobDetails.address"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10">Ville *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunis"
                        v-model="jobDetails.city"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10">Pays *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunisie"
                        v-model="jobDetails.country"
                      />
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10">Salaire Min *</label>
                      <input
                        class="form-control"
                        type="number"
                        placeholder="Exemple : 1200DT"
                        v-model="jobDetails.minSalary"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10">Salaire Max *</label>
                      <input
                        class="form-control"
                        type="number"
                        placeholder="Exemple : 1500DT"
                        v-model="jobDetails.maxSalary"
                      />
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Skills *</label>
                    <div class="input-group position-relative">
                      <input
                        type="text"
                        v-model="skillInput"
                        @input="filterSkills"
                        class="form-control"
                        placeholder="Type to search skills..."
                      />
                      <div v-if="filteredSkills.length" class="dropdown-menu show">
                        <ul class="list-group">
                          <li
                            v-for="skill in filteredSkills"
                            :key="skill"
                            class="list-group-item"
                            @click="addSkill(skill)"
                          >
                            {{ skill }}
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="mt-2">
                      <span
                        v-for="skill in selectedSkills"
                        :key="skill"
                        class="badge bg-secondary me-1"
                      >
                        {{ skill }}
                        <span @click="removeSkill(skill)" class="close" aria-label="Close">&times;</span>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="font-sm color-text-muted mb-10">Fichier *</label>
                    <div class="form-group mb-30">
                      <div class="box-upload">
                        <div class="add-file-upload row">
                          <input
                            class="fileupload"
                            type="file"
                            name="file"
                            @change="handleFileUpload"
                          />
                          <p class="ml-100" v-if="jobDetails.file">{{ jobDetails.file.name }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10">Offre mise en avant</label>
                      <div class="d-flex align-items-center">
                        <input
                          type="checkbox"
                          v-model="jobDetails.featured"
                          class="me-2 custom-checkbox"
                        />
                        <span class="font-sm color-text-muted">Cochez si vous souhaitez mettre en avant cette offre</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Internship-specific fields -->
                <div v-else-if="type === 'internship'">
                  <h5>Détails du stage</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2">Titre du stage *</label>
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Exemple : Stage en développement web"
                      v-model="internshipDetails.title"
                    />
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10 mt-2">Description du stage *</label>
                      <textarea
                        class="form-control"
                        name="message"
                        rows="8"
                        placeholder="Exemple : Nous recherchons un stagiaire en développement web pour travailler sur divers projets."
                        v-model="internshipDetails.description"
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Domaine *</label>
                    <select class="form-control" v-model="internshipDetails.domain">
                      <option value="Informatique">Informatique</option>
                      <option value="Finance">Finance</option>
                      <option value="Mecanique">Mecanique</option>
                    </select>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Durée du stage *</label>
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Exemple : 6 mois"
                      v-model="internshipDetails.internshipDuration"
                    />
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10">Lieu (siège) *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Route de la Marsa"
                        v-model="internshipDetails.address"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10">Ville *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunis"
                        v-model="internshipDetails.city"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10">Pays *</label>
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunisie"
                        v-model="internshipDetails.country"
                      />
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Motivation du stage *</label>
                    <textarea
                      class="form-control"
                      name="motivation"
                      rows="4"
                      placeholder="Exemple : Nous recherchons un stagiaire motivé pour participer à des projets stimulants."
                      v-model="internshipDetails.internshipMotivation"
                    ></textarea>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Skills *</label>
                    <div class="input-group position-relative">
                      <input
                        type="text"
                        v-model="skillInput"
                        @input="filterSkills"
                        class="form-control"
                        placeholder="Type to search skills..."
                      />
                      <div v-if="filteredSkills.length" class="dropdown-menu show">
                        <ul class="list-group">
                          <li
                            v-for="skill in filteredSkills"
                            :key="skill"
                            class="list-group-item"
                            @click="addSkill(skill)"
                          >
                            {{ skill }}
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="mt-2">
                      <span
                        v-for="skill in selectedSkills"
                        :key="skill"
                        class="badge bg-secondary me-1"
                      >
                        {{ skill }}
                        <span @click="removeSkill(skill)" class="close" aria-label="Close">&times;</span>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="font-sm color-text-muted mb-10">Fichier *</label>
                    <div class="form-group mb-30">
                      <div class="box-upload">
                        <div class="add-file-upload row">
                          <input
                            class="fileupload"
                            type="file"
                            name="file"
                            @change="handleFileUpload"
                          />
                          <p class="ml-100" v-if="internshipDetails.file">{{ internshipDetails.file.name }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10">Stage mis en avant</label>
                      <div class="d-flex align-items-center">
                        <input
                          type="checkbox"
                          v-model="internshipDetails.featured"
                          class="me-2 custom-checkbox"
                        />
                        <span class="font-sm color-text-muted">Cochez si vous souhaitez mettre en avant ce stage</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group mt-10 text-lg-end">
                  <button
                    @click="submitForm"
                    class="btn btn-default btn-brand icon-tick"
                  >
                    {{ jobId ? 'Mettre à jour l\'annonce' : 'Publier l\'annonce' }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <sweet-modal icon="success" ref="postedJob">
            <div class="spacingtop">
              Votre annonce a été {{ jobId ? 'mise à jour' : 'publiée' }} avec succès !
            </div>
          </sweet-modal>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { SweetModal } from 'sweet-modal-vue-3';

const props = defineProps({
  jobId: {
    type: Number,
    default: null
  }
});

const type = ref('job');

const jobDetails = ref({
  title: '',
  description: '',
  domain: '',
  employmentType: '',
  yearsOfExperience: '',
  workplace: '',
  address: '',
  city: '',
  country: '',
  minSalary: '',
  maxSalary: '',
  skills: [],
  file: null,
  featured: false
});

const internshipDetails = ref({
  title: '',
  description: '',
  domain: '',
  internshipDuration: '',
  workplace: '',
  address: '',
  city: '',
  country: '',
  internshipMotivation: '',
  skills: [],
  file: null,
  featured: false
});

const skillInput = ref('');
const filteredSkills = ref([]);
const selectedSkills = ref([]);
const postedJob = ref(null);

const fetchJobDetails = async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/offre/job/${props.jobId}`);
    const data = response.data[0];
    console.log("FETCHED DATA", data);

    if (data.type === 'job') {
      type.value = 'job';
      jobDetails.value = { ...data };

      // Parse skills if stored as a string in the database
      if (typeof jobDetails.value.skills === 'string') {
        jobDetails.value.skills = JSON.parse(jobDetails.value.skills);
      }
      selectedSkills.value = jobDetails.value.skills || [];

    } else if (data.type === 'internship') {
      type.value = 'internship';
      internshipDetails.value = { ...data };

      // Parse skills if stored as a string in the database
      if (typeof internshipDetails.value.skills === 'string') {
        internshipDetails.value.skills = JSON.parse(internshipDetails.value.skills);
      }
      selectedSkills.value = internshipDetails.value.skills || [];
    }
    jobDetails.value.file = null;

  } catch (error) {
    console.error('Error fetching job details:', error);
  }
};

const resetFields = () => {
  if (type.value === 'job') {
    jobDetails.value = {
      title: '',
      description: '',
      domain: '',
      employmentType: '',
      yearsOfExperience: '',
      workplace: '',
      address: '',
      city: '',
      country: '',
      minSalary: '',
      maxSalary: '',
      skills: [],
      file: null,
      featured: false
    };
  } else if (type.value === 'internship') {
    internshipDetails.value = {
      title: '',
      description: '',
      domain: '',
      internshipDuration: '',
      workplace: '',
      address: '',
      city: '',
      country: '',
      internshipMotivation: '',
      skills: [],
      file: null,
      featured: false
    };
  }
  skillInput.value = '';
  filteredSkills.value = [];
  selectedSkills.value = [];
};

const submitForm = () => {
  const data = prepareData();

  if (props.jobId) {
    axios.put(`http://localhost:8000/api/offre/${props.jobId}`, data)
      .then(() => {
        if (postedJob.value) {
          postedJob.value.open();
        }
      })
      .catch(error => {
        console.error('Error updating job:', error);
      });
  } else {
    console.log("Data to be sent:", data); // Log data just before sending
    axios.post('http://localhost:8000/api/offre/', data)
      .then(() => {
        if (postedJob.value) {
          postedJob.value.open();
        }
      })
      .catch(error => {
        console.error('Error creating job:', error);
      });
  }
};

const prepareData = () => {
  let details = type.value === 'job' ? jobDetails.value : internshipDetails.value;
  const commonData = {
    type: type.value,
    skills: JSON.stringify(selectedSkills.value),
    file: details.file,
    featured: details.featured
  };

  console.log("Skills in prepareData:", selectedSkills.value); // Check selectedSkills here
  return { ...commonData, ...details };
};

const filterSkills = () => {
  if (skillInput.value) {
    const allSkills = ['JavaScript', 'Vue.js', 'Laravel', 'React', 'CSS', 'HTML']; // Example skills
    filteredSkills.value = allSkills.filter(skill =>
      skill.toLowerCase().includes(skillInput.value.toLowerCase())
    );
  } else {
    filteredSkills.value = [];
  }
};

const addSkill = (skill) => {
  if (!selectedSkills.value.includes(skill)) {
    selectedSkills.value.push(skill);
  }
  skillInput.value = '';
  filteredSkills.value = [];
};

const removeSkill = (skill) => {
  selectedSkills.value = selectedSkills.value.filter(s => s !== skill);
};

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (type.value === 'job') {
      jobDetails.value.file = file;
    } else if (type.value === 'internship') {
      internshipDetails.value.file = file;
    }
  }
};

onMounted(() => {
  if (props.jobId) {
    fetchJobDetails();
  }
});

</script>

<style scoped>
.dropdown-menu {
  position: absolute;
  z-index: 1000;
  width: 100%;
  background-color: white;
  max-height: 200px;
  overflow-y: auto;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  padding: 0;
}

.list-group-item {
  padding: 8px 12px;
  font-size: 14px;
  cursor: pointer;
}

.list-group-item:hover {
  background-color: #f0f0f0;
}

.custom-checkbox {
  width: 16px;
  height: 16px;
  margin-top: 3px;
  margin-left: 10px;
}
</style>
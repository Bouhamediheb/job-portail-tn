<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Modifier une offre</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
            <li><span>Modifier une annonce</span></li>
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
                <h5 class="icon-edu">Modifier les informations de l'offre</h5>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10 mt-2"
                    >Type d'offre *</label
                  >
                  <select
                    v-model="type"
                    class="form-control"
                    @change="resetFields" disabled
                  >
                    <option value="job">Offre d'emploi</option>
                    <option value="internship">Stage</option>
                  </select>
                </div>

                <!-- Job Details Form -->
                <div v-if="type === 'job'">
                  <h5>Détails de l'offre d'emploi</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2"
                      >Titre de l'offre *</label
                    >
                    <input
                      class="form-control"
                      type="text"
                      v-model="jobDetails.title"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Description de l'offre *</label
                    >
                    <textarea
                      class="form-control"
                      rows="8"
                      v-model="jobDetails.description"
                    ></textarea>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mb-30">
                        <label class="font-sm color-text-muted mb-10"
                          >Domaine *</label
                        >
                        <select
                          class="form-control"
                          v-model="jobDetails.domain"
                        >
                          <option value="Informatique">Informatique</option>
                          <option value="Finance">Finance</option>
                          <option value="Mecanique">Mecanique</option>
                          <option value="Marketing">Marketing</option>
                          <option value="Ressources Humaines">Ressources Humaines</option>
                          <option value="Architecture">Architecture</option>
                          <option value="Design">Design</option>
                          <option value="Autre">Autre</option>
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-30">
                        <label class="font-sm color-text-muted mb-10"
                          >Horaire *</label
                        >
                        <select
                          class="form-control"
                          v-model="jobDetails.employmentType"
                        >
                          <option value="0">Demi-Temps</option>
                          <option value="1">Plein-Temps</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Expérience *</label
                    >
                    <input
                      class="form-control"
                      type="number"
                      v-model="jobDetails.yearsOfExperience"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Type de lieu de travail *</label
                    >
                    <select class="form-control" v-model="jobDetails.workplace">
                      <option value="0">Teletravail</option>
                      <option value="1">Bureau</option>
                      <option value="2">Hybride</option>
                    </select>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Lieu (siège) *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="jobDetails.address"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Ville *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="jobDetails.city"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Pays *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="jobDetails.country"
                      />
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Salaire Min *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        v-model="jobDetails.minSalary"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Salaire Max *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        v-model="jobDetails.maxSalary"
                      />
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Skills *</label
                    >
                    <div class="input-group position-relative">
                      <input
                        type="text"
                        v-model="skillInput"
                        @input="filterSkills"
                        class="form-control"
                        placeholder="Type to search skills..."
                      />
                      <div
                        v-if="filteredSkills.length"
                        class="dropdown-menu show"
                      >
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
                        <span
                          @click="removeSkill(skill)"
                          class="close"
                          aria-label="Close"
                          >&times;</span
                        >
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label class="font-sm color-text-muted mb-10"
                      >Fichier *</label
                    >
                    <div class="form-group mb-30">
                      <div class="box-upload">
                        <div class="add-file-upload row">
                          <input
                            class="fileupload"
                            type="file"
                            name="file"
                            @change="handleFileUpload"
                          />
                          <p class="ml-100" v-if="jobDetails.file">
                            {{ jobDetails.file.name }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10"
                        >Offre mise en avant</label
                      >
                      <div class="d-flex align-items-center">
                        <input
                          type="checkbox"
                          v-model="jobDetails.featured"
                          class="me-2 custom-checkbox"
                        />
                        <span class="font-sm color-text-muted"
                          >Cochez si vous souhaitez mettre en avant cette
                          offre</span
                        >
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Internship Details Form -->
                <div v-else-if="type === 'internship'">
                  <h5>Détails du stage</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2"
                      >Titre du stage *</label
                    >
                    <input
                      class="form-control"
                      type="text"
                      v-model="internshipDetails.title"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Description du stage *</label
                    >
                    <textarea
                      class="form-control"
                      rows="8"
                      v-model="internshipDetails.description"
                    ></textarea>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Domaine *</label
                    >
                    <select
                      class="form-control"
                      v-model="internshipDetails.domain"
                    >
                      <option value="Informatique">Informatique</option>
                      <option value="Finance">Finance</option>
                      <option value="Mecanique">Mecanique</option>
                    </select>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Durée du stage *</label
                    >
                    <input
                      class="form-control"
                      type="number"
                      v-model="internshipDetails.internshipDuration"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Type de lieu de travail *</label
                    >
                    <select
                      class="form-control"
                      v-model="internshipDetails.workplace"
                    >
                      <option value="0">Teletravail</option>
                      <option value="1">Bureau</option>
                      <option value="2">Hybride</option>
                    </select>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Lieu (siège) *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="internshipDetails.address"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Ville *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="internshipDetails.city"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Pays *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        v-model="internshipDetails.country"
                      />
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Salaire Min *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        v-model="internshipDetails.minSalary"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Salaire Max *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        v-model="internshipDetails.maxSalary"
                      />
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Compétences *</label
                    >
                    <div class="input-group position-relative">
                      <input
                        type="text"
                        v-model="skillInput"
                        @input="filterSkills"
                        class="form-control"
                        placeholder="Type to search skills..."
                      />
                      <div
                        v-if="filteredSkills.length"
                        class="dropdown-menu show"
                      >
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
                        <span
                          @click="removeSkill(skill)"
                          class="close"
                          aria-label="Close"
                          >&times;</span
                        >
                      </span>
                    </div>
                  </div>
                </div>

                <div
                  class="btn-toolbar justify-content-between"
                  role="toolbar"
                  aria-label="Toolbar with button groups"
                >
                  <div class="btn-group" role="group" aria-label="First group">
                    <button class="btn btn-default btn-brand icon-tick" @click="submitJobPost">
                      Mettre à jour
                    </button>
                  </div>
                  <div class="btn-group" role="group" aria-label="Second group">
                    <button class="btn btn-danger btn-brand" @click="cancelEdit">
                      Annuler
                    </button>
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
import axios from 'axios';
import { ref,onMounted } from 'vue';
import { useRouter } from 'vue-router';

const props = defineProps({
  jobId: {
    type: Number,
    default: null
  }
});

const jobId = ref(null);
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
  featured: false,
  file: null,
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
  minSalary: '',
  maxSalary: '',
});
const skillInput = ref('');
const selectedSkills = ref([]);
const skills = [
  'JavaScript',
  'Vue.js',
  'React.js',
  'Node.js',
  'Python',
  'Java',
  'C#',
  'Ruby',
  'SQL',
  'MongoDB',
  'MySQL',
  'PostgreSQL',
  'Git',
  'Docker',
  'Kubernetes',
  'AWS',
  'Azure',
  'Google Cloud',
  'UI/UX Design',
  'Agile Development',
  'Scrum',
  'Kanban',
  'Software Testing',
  'CI/CD',
  'RESTful APIs',
  'GraphQL',
  'Jira',
  'Confluence',
  'Trello',
];
const filteredSkills = ref([]);

// Access router for navigation
const router = useRouter();

// Fetch job details for editing
async function fetchJobDetails() {
  try {
    const response = await axios.get(`http://localhost:8000/api/offre/job/${props.jobId}`);
    const job = response.data[0];
    console.log('Job details:', job);
    console.log('Job type:', job.type);
    type.value = job.type;
    if (type.value === 'job') {
      jobDetails.value = { ...job };
    } else if (type.value === 'internship') {
      internshipDetails.value = { ...job };
    }
    selectedSkills.value = JSON.parse(job.skills); // Parse skills from JSON string
  } catch (error) {
    console.error('Error fetching job details:', error);
    // Handle error, show message, redirect, etc.
  }
}

// Reset form fields when changing job type
function resetFields() {
  if (type.value === 'job') {
    internshipDetails.value = {
      title: '',
      description: '',
      domain: '',
      internshipDuration: '',
      workplace: '',
      address: '',
      city: '',
      country: '',
      minSalary: '',
      maxSalary: '',
    };
  } else if (type.value === 'internship') {
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
      featured: false,
      file: null,
    };
  }
}

// Handle file upload
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file) {
    jobDetails.value.file = file;
  }
}

// Filter skills based on user input
function filterSkills() {
  filteredSkills.value = skills.filter(skill =>
    skill.toLowerCase().includes(skillInput.value.toLowerCase())
  );
}

// Add skill to selectedSkills array
function addSkill(skill) {
  if (!selectedSkills.value.includes(skill)) {
    selectedSkills.value.push(skill);
  }
  skillInput.value = ''; // Clear input after selection
  filteredSkills.value = []; // Clear filtered skills dropdown
}

// Remove skill from selectedSkills array
function removeSkill(skill) {
  selectedSkills.value = selectedSkills.value.filter(selectedSkill => selectedSkill !== skill);
}

// Submit job post
async function submitJobPost() {
  const jobData = {
    type: type.value,
    ...(type.value === 'job' ? jobDetails.value : internshipDetails.value),
    skills: selectedSkills.value,
  };

  try {
    const response = await axios.put(`/api/jobs/${jobId.value}`, jobData);
    console.log('Job updated successfully:', response.data);
    // Handle success, show message, redirect, etc.
  } catch (error) {
    console.error('Error updating job:', error);
    // Handle error, show message, etc.
  }
}

// Cancel edit and navigate back
function cancelEdit() {
  router.push('/dashboard'); // Redirect to dashboard or previous page
}

// Mounted hook equivalent in <script setup>
onMounted(() => {
  jobId.value = props.jobId; // Get job ID from props
  console.log('jobId from props', jobId.value);
  fetchJobDetails(); // Fetch job details when component is mounted
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

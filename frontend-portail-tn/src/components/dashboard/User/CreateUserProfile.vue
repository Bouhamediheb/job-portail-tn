<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mon profil</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li><a class="icon-home" href="">Dashboard</a></li>
            <li><span>Mon profil utilisateur</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xxl-9 col-xl-8 col-lg-8">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding">
                <h6 class="color-text-paragraph-2">
                  Mettez à jour votre profil
                </h6>
                <div class="box-profile-image">
                  <div class="img-profile">
                    <label class="font-sm color-text-mutted mb-10"
                      >Photo de Profil *</label
                    >
                    <img
                      :src="selectedProfilePicture || logo"
                      alt="Company Logo"
                    />
                  </div>
                  <div class="info-profile">
                    <label for="logo-upload" class="btn btn-default"
                      >Upload Logo</label
                    >
                    <input
                      type="file"
                      style="display: none"
                      id="logo-upload"
                      @change="handlePPUpload"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Numéro de contact</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="01 - 234 567 89"
                        v-model="formData.phoneNumber"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Site personnel</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="https://alithemes.com/"
                        v-model="formData.personalWebsite"
                      />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10">Bio</label>
                      <textarea
                        class="form-control"
                        v-model="formData.bio"
                        rows="5"
                      >
  Nous sommes AliThemes, un groupe créatif et dévoué d'individus qui aiment le développement web presque autant que nous aimons nos clients. Nous sommes une équipe passionnée avec la mission d'atteindre la perfection en design web.
                        </textarea
                      >
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Langues</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Anglais, Français"
                        v-model="formData.languages"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Genre</label
                      >
                      <select class="form-control" v-model="formData.gender">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Parcours Académique</label
                      >
                      <div id="academic-entries">
                        <div
                          class="academic-entry"
                          v-for="(entry, index) in formData.academicEntries"
                          :key="index"
                        >
                          <input
                            v-model="entry.institute"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Institut"
                          />
                          <input
                            v-model="entry.degree"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Diplôme"
                          />
                          <input
                            v-model="entry.graduationYear"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Année de graduation"
                          />
                          <button
                            class="btn btn-link"
                            @click="removeAcademicEntry(index)"
                          >
                            Supprimer
                          </button>
                        </div>
                      </div>
                      <button
                        class="btn btn-default btn-brand mt-10"
                        @click="addAcademicEntry()"
                      >
                        Ajouter une entrée
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Expérience Professionnelle</label
                      >
                      <div id="professional-entries">
                        <div
                          class="professional-entry"
                          v-for="(entry, index) in formData.professionalEntries"
                          :key="index"
                        >
                          <input
                            v-model="entry.company"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Entreprise"
                          />
                          <input
                            v-model="entry.title"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Titre du poste"
                          />
                          <input
                            v-model="entry.startYear"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Année de début"
                          />
                          <input
                            v-model="entry.endYear"
                            class="form-control mb-10"
                            type="text"
                            placeholder="Année de fin"
                          />
                          <button
                            class="btn btn-link"
                            @click="removeProfessionalEntry(index)"
                          >
                            Supprimer
                          </button>
                        </div>
                      </div>
                      <button
                        class="btn btn-default btn-brand mt-10"
                        @click="addProfessionalEntry()"
                      >
                        Ajouter une entrée
                      </button>
                    </div>
                  </div>
                  <!-- skills -->
                  <div class="col-lg-12">
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
                  </div>
                  <div class="info-profile row">
                    <label class="font-sm color-text-muted mb-10"
                      >Télécharger votre CV *</label
                    >

                    <input
                      type="file"
                      @change="handleCVUpload"
                      class="btn btn-default col-lg-4 ml-10"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-white mb-30">
              <div class="box-padding">
                <h6 class="color-text-paragraph-2">Informations de Contact</h6>
                <div class="row mt-30">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Pays</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Tunisie"
                        v-model="formData.country"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Ville</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Tunis"
                        v-model="formData.city"
                      />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >Adresse Complète</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Route de la Marsa"
                        v-model="formData.address"
                      />
                    </div>
                  </div>
                  <div class="col-lg-12 text-lg-end">
                    <div class="form-group mt-0">
                      <button
                        class="btn btn-default btn-brand icon-tick"
                        @click="postFormData()"
                      >
                        Enregistrer les modifications
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-xl-4 col-lg-4">
        <div class="section-box">
          <div class="container">
            <div class="panel-white">
              <div class="panel-head">
                <h5>Réseaux sociaux</h5>
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
              <div class="panel-body pt-20">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-mutted mb-10"
                        >LinkedIn</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Lien LinkedIn"
                        v-model="formData.website"
                      />
                    </div>
                  </div>
                  <div class="col-lg-12 text-lg-end">
                    <div class="form-group mt-0">
                      <button
                        class="btn btn-default btn-brand icon-tick"
                        @click="postFormData()"
                      >
                        Enregistrer les modifications
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
               
              </div>
            </div>
          </div>
        </div>
        <sweet-modal icon="success" ref="profileCreated">
            <div class="spacingtop">
              Votre profil a été mis à jour avec succés !
            </div>
          </sweet-modal>
      </div>
    </div>
  </div>
</template>
  
  
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { SweetModal, SweetModalTab } from "sweet-modal-vue-3";
import allskills from '../../../allskills.js'

const selectedProfilePicture = ref(null);
const profilePicture = ref(null);

const skillInput = ref("");
const selectedSkills = ref([]);
const skills = allskills.skills;
const filteredSkills = ref([]);

const profileCreated = ref(null);

const logo = ref("assets/dashboard/imgs/page/profile/img-profile.png"); // Default logo

const formData = ref({
  gender: "",
  birthDate: "",
  phoneNumber: "",
  personalWebsite: "",
  bio: "",
  languages: "",
  academicEntries: [{ institute: "", degree: "", graduationYear: "" }],
  professionalEntries: [{ company: "", startYear: "", endYear: "" }],
  country: "",
  city: "",
  address: "",
  website: "",
  cv: null,
  selectedProfilePicture : null,
});

const handlePPUpload = (event) => {
  selectedProfilePicture.value = event.target.files[0];
  profilePicture.value = event.target.files[0];
  if (selectedProfilePicture.value) {
    const reader = new FileReader();

    reader.onload = (event) => {
      selectedProfilePicture.value = event.target.result;
    };
    reader.readAsDataURL(selectedProfilePicture.value);
  }
};

const handleCVUpload = (event) => {
  formData.value.cv = event.target.files[0];
};

const addAcademicEntry = () => {
  formData.value.academicEntries.push({
    institute: "",
    degree: "",
    graduationYear: "",
  });
};

const removeAcademicEntry = (index) => {
  formData.value.academicEntries.splice(index, 1);
};

const addProfessionalEntry = () => {
  formData.value.professionalEntries.push({
    company: "",
    title: "",
    startYear: "",
    endYear: "",
  });
};

const removeProfessionalEntry = (index) => {
  formData.value.professionalEntries.splice(index, 1);
};

function filterSkills() {
  filteredSkills.value = skills.filter(
    (skill) =>
      skill.toLowerCase().includes(skillInput.value.toLowerCase()) &&
      !selectedSkills.value.includes(skill)
  );
}

function addSkill(skill) {
  if (!selectedSkills.value.includes(skill)) {
    selectedSkills.value.push(skill);
    skillInput.value = "";
    filteredSkills.value = [];
  }
}

function removeSkill(skill) {
  selectedSkills.value = selectedSkills.value.filter((s) => s !== skill);
}

const postFormData = () => {
  const data = {
    ...formData.value,
    profilePicture: profilePicture.value,
    languages: JSON.stringify(formData.value.languages.split(",")),
    user_id: localStorage.getItem("id"),
    skills: JSON.stringify(selectedSkills.value),
    
  };

  console.log(data);

  axios
    .post("http://localhost:8000/api/profil", data,
    {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
    .then((response) => {
      console.log(response.data);
      if (profileCreated.value) {
        profileCreated.value.open();
    }

    })
    .catch((error) => {
      console.error(error);
    });
};
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
</style>
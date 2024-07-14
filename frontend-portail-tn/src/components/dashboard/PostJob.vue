<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Publier une offre</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
            <li><span>Publier une annonce</span></li>
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
                  Veuillez remplir les informations de votre offre
                </h5>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10 mt-2"
                    >Type d'offre *</label
                  >

                  <select
                    v-model="offerType"
                    class="form-control"
                    @change="resetFields"
                  >
                    <option value="job">Offre d'emploi</option>
                    <option value="internship">Stage</option>
                  </select>
                </div>

                <div v-if="offerType === 'job'">
                  <h5>Détails de l'offre d'emploi</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2"
                      >Titre de l'offre *</label
                    >
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Exemple : Développeur Full Stack"
                    />
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10 mt-2"
                        >Description de l'offre *</label
                      >
                      <textarea
                        class="form-control"
                        name="message"
                        rows="8"
                        placeholder="Exemple : Nous recherchons un développeur Full Stack pour rejoindre notre équipe de développement."
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Expérience *</label
                    >
                    <input
                      class="form-control"
                      type="number"
                      placeholder="Exemple : 2"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Type de lieu de travail *</label
                    >
                    <select class="form-control">
                      <option value="remote">Teletravail</option>
                      <option value="office">Bureau</option>
                      <option value="hybrid">Hybride</option>
                    </select>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Lieu (siége) *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Route de la Marsa"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Ville *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunis"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Pays *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunisie"
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
                        placeholder="Exemple : 1200DT "
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Salaire Max *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        placeholder="Exemple : 1500DT"
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
                        
                        <div class="add-file-upload">
                            
                          <input class="fileupload" type="file" name="file" />
                        </div>

                        <a class="btn btn-default">Upload File</a>
                      </div>
                    </div>
                  </div>
                  
                </div>

                <div v-else-if="offerType === 'internship'">
                  <h5>Détails du stage</h5>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10 mt-2"
                      >Titre du stage *</label
                    >
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Exemple : Stage en développement web"
                    />
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-30">
                      <label class="font-sm color-text-muted mb-10 mt-2"
                        >Description du stage *</label
                      >
                      <textarea
                        class="form-control"
                        name="message"
                        rows="8"
                        placeholder="Exemple : Nous recherchons un stagiaire en développement web pour rejoindre notre équipe de développement."
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Durée du stage *</label
                    >
                    <input
                      class="form-control"
                      type="number"
                      placeholder="Exemple : 3"
                    />
                  </div>
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10"
                      >Type de lieu de travail *</label
                    >
                    <select class="form-control">
                      <option value="remote">Teletravail</option>
                      <option value="office">Bureau</option>
                      <option value="hybrid">Hybride</option>
                    </select>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Lieu (siége) *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Route de la Marsa"
                      />
                    </div>
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Ville *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunis"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <label class="font-sm color-text-muted mb-10"
                        >Pays *</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        placeholder="Exemple : Tunisie"
                      />
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mb-30">
                    <div class="flex-grow-1 me-2">
                      <label class="font-sm color-text-muted mb-10"
                        >Motivation *</label
                      >
                      <input
                        class="form-control"
                        type="number"
                        placeholder="Exemple : 300DT "
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
                        
                        <div class="add-file-upload">
                            
                          <input class="fileupload" type="file" name="file" />
                        </div>

                        <a class="btn btn-default">Upload File</a>
                      </div>
                    </div>
                </div></div>
                <div class="form-group mt-10">
                  <button class="btn btn-default btn-brand icon-tick">
                    Post New Offer
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Additional footer content can go here -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      offerType: "job", // Default to Job Offer
      skillInput: "",
      selectedSkills: [],
      skills: ["Java", "Python", "JavaScript", "C++", "Ruby", "Go", "PHP"], // Add more skills as needed
      filteredSkills: [],
    };
  },
  methods: {
    resetFields() {
      this.selectedSkills = [];
      this.skillInput = "";
      this.filteredSkills = [];
    },
    filterSkills() {
      // Check if filter function is triggered
      console.log("Filtering skills:", this.skillInput);

      this.filteredSkills = this.skills.filter(
        (skill) =>
          skill.toLowerCase().includes(this.skillInput.toLowerCase()) &&
          !this.selectedSkills.includes(skill)
      );

      // Log filtered skills for debugging
      console.log("Filtered skills:", this.filteredSkills);
    },
    addSkill(skill) {
      if (!this.selectedSkills.includes(skill)) {
        this.selectedSkills.push(skill);
        this.skillInput = ""; // Clear input after selection
        this.filteredSkills = []; // Clear the dropdown
      }
    },
    removeSkill(skill) {
      this.selectedSkills = this.selectedSkills.filter((s) => s !== skill);
    },
  },
};
</script>

<style scoped>
.dropdown-menu {
  position: absolute;
  z-index: 1000;
  width: 100%; /* Match the width of the input */
  background-color: white; /* Background color */
  max-height: 200px; /* Limit the height */
  overflow-y: auto; /* Enable scrolling if needed */
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
  border-radius: 4px; /* Slightly rounded corners */
  padding: 0; /* No padding around the menu */
}

.list-group-item {
  padding: 8px 12px; /* Padding: top/bottom, left/right */
  font-size: 14px; /* Smaller text size */
  cursor: pointer; /* Pointer on hover */
}

.list-group-item:hover {
  background-color: #f0f0f0; /* Highlight on hover */
}
</style>

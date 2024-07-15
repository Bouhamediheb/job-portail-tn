<template>
    <div class="box-content">
        <div class="box-heading">
            <div class="box-title">
                <h3 class="mb-35">Mon profil</h3>
            </div>
            <div class="box-breadcrumb">
                <div class="breadcrumbs">
                    <ul>
                        <li> <a class='icon-home' href=''>Dashboard</a></li>
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
                                <h6 class="color-text-paragraph-2">Mettez à jour votre profil</h6>
                                <div class="box-profile-image">
                                    <div class="img-profile"><img
                                            src="assets/dashboard/imgs/page/profile/img-profile.png" alt="jobBox"></div>
                                    <div class="info-profile"><a class="btn btn-default">Télécharger Avatar</a><a
                                            class="btn btn-link">Supprimer</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Nom Complet *</label>
                                            <input class="form-control" type="text" placeholder="Steven Job"
                                                v-model="fullName">

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                                            <input class="form-control" type="text" placeholder="stevenjob@gmail.com"
                                                v-model="email">

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Numéro de contact</label>
                                            <input class="form-control" type="text" placeholder="01 - 234 567 89"
                                                v-model="phoneNumber">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Site personnel</label>
                                            <input class="form-control" type="text" placeholder="https://alithemes.com/"
                                                v-model="personalWebsite">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Bio</label>
                                            <textarea class="form-control" name="message" v-model="bio"
                                                rows="5">Nous sommes AliThemes, un groupe créatif et dévoué d'individus qui aiment le développement web presque autant que nous aimons nos clients. Nous sommes une équipe passionnée avec la mission d'atteindre la perfection en design web.</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Langues</label>
                                            <input class="form-control" type="text" placeholder="Anglais, Français"
                                                v-model="languages">
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Catégories</label>
                                            <input class="form-control" type="text" placeholder="Designer UI/UX"
                                                v-model="categories">
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Cursus Académique</label>
                                            <div id="academic-entries">
                                                <div class="academic-entry" v-for="(entry, index) in academicEntries"
                                                    :key="index">
                                                    <input v-model="entry.institute" class="form-control mb-10"
                                                        type="text" placeholder="Institut">
                                                    <input v-model="entry.degree" class="form-control mb-10" type="text"
                                                        placeholder="Diplôme">
                                                    <input v-model="entry.graduationYear" class="form-control mb-10"
                                                        type="text" placeholder="Année de graduation">
                                                    <button class="btn btn-link"
                                                        @click="removeAcademicEntry(index)">Supprimer</button>
                                                </div>
                                            </div>
                                            <button class="btn btn-default btn-brand mt-10"
                                                @click="addAcademicEntry()">Ajouter une entrée</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Expérience Professionnelle</label>
                                            <div id="professional-entries">
                                                <div class="professional-entry" v-for="(entry, index) in professionalEntries"
                                                    :key="index">
                                                    <input v-model="entry.company" class="form-control mb-10"
                                                        type="text" placeholder="Entreprise">
                                                    <input v-model="entry.startYear" class="form-control mb-10"
                                                        type="text" placeholder="Année de début">
                                                    <input v-model="entry.endYear" class="form-control mb-10"
                                                        type="text" placeholder="Année de fin">
                                                    <button class="btn btn-link"
                                                        @click="removeProfessionalEntry(index)">Supprimer</button>
                                                </div>
                                            </div>
                                            <button class="btn btn-default btn-brand mt-10"
                                                @click="addProfessionalEntry()">Ajouter une entrée</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 text-lg-end">
                                        <div class="form-group mt-10">
                                            <button class="btn btn-default btn-brand icon-tick">Enregistrer les
                                                modifications</button>
                                        </div>
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
                                            <label class="font-sm color-text-mutted mb-10">Pays</label>
                                            <input class="form-control" type="text" placeholder="Tunisie"
                                                v-model="country"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Ville</label>
                                            <input class="form-control" type="text" placeholder="Tunis"
                                                v-model="city"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Adresse Complète</label>
                                            <input class="form-control" type="text"
                                                placeholder="Route de la Marsa"
                                                v-model="fullAddress"
                                                >
                                        </div>
                                    
                                    </div>
                                    <div class="col-lg-12 text-lg-end">
                                        <div class="form-group mt-0">
                                            <button class="btn btn-default btn-brand icon-tick"
                                                @click="postFormData()">Enregistrer les
                                                modifications</button>
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
                                <h5>Réseaux sociaux</h5><a class="menudrop" id="dropdownMenu3" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end"
                                    aria-labelledby="dropdownMenu3">
                                    <li><a class="dropdown-item active" href="#">Add new</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Actions</a></li>
                                </ul>
                            </div>
                            <div class="panel-body pt-20">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Facebook</label>
                                            <input class="form-control" type="text"
                                                placeholder="https://www.facebook.com/">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Twitter</label>
                                            <input class="form-control" type="text" placeholder="https://twitter.com/">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Instagram</label>
                                            <input class="form-control" type="text"
                                                placeholder="https://www.instagram.com/">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-lg-end">
                                        <div class="form-group mt-0">
                                            <button class="btn btn-default btn-brand icon-tick">Enregistrer</button>
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
                                <h5>Compétences</h5>
                                <a class="menudrop" id="dropdownMenu3" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end"
                                    aria-labelledby="dropdownMenu3">
                                    <li><a class="dropdown-item active" href="#">Add new</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Actions</a></li>
                                </ul>
                            </div>
                            <div class="panel-body pt-20">
                                <div class="row">
                                    <div class="col-lg-12">


                                        <!-- Dropdown/select for selecting skills -->
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-muted mb-10">Skills *</label>
                                            <div class="input-group position-relative">
                                                <input type="text" v-model="skillInput" @input="filterSkills"
                                                    class="form-control" placeholder="Type to search skills..." />
                                                <div v-if="filteredSkills.length" class="dropdown-menu show">
                                                    <ul class="list-group">
                                                        <li v-for="skill in filteredSkills" :key="skill"
                                                            class="list-group-item" @click="addSkill(skill)">
                                                            {{ skill }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <span v-for="skill in selectedSkills" :key="skill"
                                                    class="badge bg-secondary me-1">
                                                    {{ skill }}
                                                    <span @click="removeSkill(skill)" class="close"
                                                        aria-label="Close">&times;</span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-30 mb-40">
                                            <span class="info-icon font-sm color-text-paragraph-2">Vous pouvez ajouter
                                                au maximum 15 skills</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 text-lg-end">
                                        <div class="form-group mt-0">

                                            <button class="btn btn-default btn-brand icon-tick"
                                                @click="saveSkills">Enregistrer
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
        <div class="mt-10">
            <div class="section-box">
                <div class="container">
                    <div class="panel-white pt-30 pb-30 pl-15 pr-15">
                        <div class="box-swiper">
                            <div class="swiper-container swiper-group-10">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/microsoft.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/sony.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/acer.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/nokia.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/asus.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/casio.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/dell.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/panasonic.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/vaio.svg"
                                            alt="jobBox"></div>
                                    <div class="swiper-slide"> <img src="assets/dashboard/imgs/page/dashboard/sony.svg"
                                            alt="jobBox"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            fullName: '',
            email: '',
            phoneNumber: '',
            personalWebsite: '',
            bio: '',
            languages: '',
            categories: '',
            academicEntries: [],
            professionalEntries: [],
            country: '',
            city: '',
            fullAddress: '',
            mapLocation: '',
            latitude: '',
            longitude: '',
            facebook: '',
            twitter: '',
            instagram: '',
            skills: ['Java', 'Python', 'JavaScript', 'C++', 'Ruby', 'Go', 'PHP'],
            skillInput: '',
            selectedSkills: [],
            filteredSkills: [],
            academicEntries: [
        { institute: '', degree: '', graduationYear: '' }
      ],
        professionalEntries: [
            { company: '', startYear: '', endYear: '' }
        ]
        };
    },
    methods: {
        filterSkills() {
            this.filteredSkills = this.skills.filter(
                (skill) =>
                    skill.toLowerCase().includes(this.skillInput.toLowerCase()) &&
                    !this.selectedSkills.includes(skill)
            );
        },
        addSkill(skill) {
            if (!this.selectedSkills.includes(skill)) {
                this.selectedSkills.push(skill);
                this.skillInput = '';
                this.filteredSkills = [];
            }
        },
        removeSkill(skill) {
            this.selectedSkills = this.selectedSkills.filter((s) => s !== skill);
        },
        addAcademicEntry() {
      this.academicEntries.push({ institute: '', degree: '', graduationYear: '' });
    },
    removeAcademicEntry(index) {
        this.academicEntries.splice(index, 1);
    },
    addProfessionalEntry() {
        this.professionalEntries.push({ company: '', startYear: '', endYear: '' });
    },
    removeProfessionalEntry(index) {
        this.professionalEntries.splice(index, 1);
    },
        postFormData() {
            const formData = {
                fullName: this.fullName,
                email: this.email,
                phoneNumber: this.phoneNumber,
                personalWebsite: this.personalWebsite,
                bio: this.bio,
                languages: this.languages,
                categories: this.categories,
                academicEntries: this.academicEntries,
                professionalEntries: this.professionalEntries,
                country: this.country,
                city: this.city,
                fullAddress: this.fullAddress,
                mapLocation: this.mapLocation,
                latitude: this.latitude,
                longitude: this.longitude,
                facebook: this.facebook,
                twitter: this.twitter,
                instagram: this.instagram,
            };

            // Log the formData object to console for debugging
            console.log('Form Data:', formData);

            // Example: Post data to API endpoint using Axios
            axios
                .post('your_api_endpoint', formData)
                .then((response) => {
                    console.log('API Response:', response.data);
                    // Handle success
                })
                .catch((error) => {
                    console.error('API Error:', error);
                    // Handle error
                });
        },
        saveSkills() {
            // Logic to save skills if needed
        },
    },
};
</script>
<template>
    <div class="box-content">
        <div class="box-heading">
            <div class="box-title">
                <h3 class="mb-35">Votre profil pro</h3>
            </div>
            <div class="box-breadcrumb">
                <div class="breadcrumbs">
                    <ul>
                        <li><a class='icon-home' href=''>Dashboard</a></li>
                        <li><span>Profile</span></li>
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
                                <h6 class="color-text-paragraph-2">Mettre à jour votre profil</h6>
                                <div class="box-profile-image">
                                    <div class="img-profile">
                                        <label class="font-sm color-text-mutted mb-10">Logo *</label>
                                        <img :src="logo" alt="Company Logo">
                                    </div>
                                    <div class="info-profile">
                                        <a class="btn btn-default">Upload Logo</a>
                                        <a class="btn btn-link">Supprimer</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6" v-for="(field, index) in profileFields" :key="index">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">{{ field.label }} *</label>
                                            <input class="form-control" 
                                                   type="text" 
                                                   :placeholder="field.placeholder" 
                                                   v-model="field.value">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-lg-end">
                                        <div class="form-group mt-10">
                                            <button class="btn btn-default btn-brand icon-tick" @click="saveProfile">Enregistrer les modifications</button>
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
            </div>
            <sweet-modal icon="success" ref="updatedProfile">
                <div class="spacingtop">
                  Votre profil a été mis à jour avec succès !
                </div>
              </sweet-modal>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { SweetModal, SweetModalTab } from 'sweet-modal-vue-3'


const updatedProfile = ref(null);
const id = ref(localStorage.getItem('id'));
const profileFields = ref([
    { label: 'Siège social', placeholder: 'Ex : Route la Marse', value: '' },
    { label: 'Numéro de téléphone', placeholder: '216 - 234 567 89', value: '' },
    { label: 'Fax', placeholder: '216 - 234 678 89', value: '' },
    { label: 'Ville', placeholder: 'Ville', value: '' },
    { label: 'Pays', placeholder: 'Pays', value: '' },
    { label: 'Site web', placeholder: 'https://growupagency.tn/', value: '' },
]);
const logo = ref('assets/dashboard/imgs/page/profile/img-profile.png'); // Default logo

const fetchProfile = async () => {
    try {
        const response = await axios.get(`http://localhost:8000/api/societe/profile/${id.value}`);
        const data = response.data;

        console.log('Profile data:', data);
        profileFields.value[0].value = data.address || '';
        profileFields.value[1].value = data.phoneNumber || '';
        profileFields.value[2].value = data.fax || '';
        profileFields.value[3].value = data.city || '';
        profileFields.value[4].value = data.country || '';
        profileFields.value[5].value = data.website || '';
        logo.value = data.logo || logo.value; // Update logo if available
    } catch (error) {
        console.error('Error fetching profile:', error);
    }
};

const saveProfile = async () => {
    const data = {
        address: profileFields.value[0].value,
        phoneNumber: profileFields.value[1].value,
        fax: profileFields.value[2].value,
        city: profileFields.value[3].value,
        country: profileFields.value[4].value,
        website: profileFields.value[5].value
    };
    try {
        const response = await axios.put(`http://localhost:8000/api/societe/profile/${id.value}`, data, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        console.log('Profile updated:', response.data);
        if (updatedProfile.value) {
            updatedProfile.value.open();
    }
        setTimeout(() => {
            router.push("/dashboard");
        }, 2000);
    } catch (error) {
        console.error('Error updating profile:', error);
    }
};

onMounted(() => {
    fetchProfile();
    console.log('Company Profile mounted');
});
</script>

<style>
.spacingbottom
{
    padding-bottom: 100px;
}
.spacingtop
{
    padding-top: 30px;
}
</style>

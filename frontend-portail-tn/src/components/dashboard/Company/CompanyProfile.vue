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

                                        <img src="assets/dashboard/imgs/page/profile/img-profile.png" alt="Company Logo"></div>
                                    <div class="info-profile"><a class="btn btn-default">Upload Logo</a><a class="btn btn-link">Supprimer</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Siége social *</label>
                                            <input class="form-control" type="text" placeholder="Ex : Route la Marse , Immeuble xx , étage xx , appartement xx" v-model="address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Numéro de téléphone</label>
                                            <input class="form-control" type="text" placeholder="216 - 234 567 89" v-model="phoneNumber">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Fax</label>
                                            <input class="form-control" type="text" placeholder="216 - 234 678 89" v-model="fax">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Ville</label>
                                            <input class="form-control" type="text" placeholder="Ville" v-model="city">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Pays</label>
                                            <input class="form-control" type="text" placeholder="Pays" v-model="country">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-30">
                                            <label class="font-sm color-text-mutted mb-10">Site web</label>
                                            <input class="form-control" type="text" placeholder="https://growupagency.tn/" v-model="website">
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
        </div>
    </div>
</template>
<style>
</style>
<script setup>
import axios from 'axios'
import { ref } from 'vue'

const id = ref()
const address = ref()
const phoneNumber = ref()
const fax = ref()
const city = ref()
const country = ref()
const website = ref()



const saveProfile = async () => {
    const data = {
        address: address.value,
        phoneNumber: phoneNumber.value,
        fax: fax.value,
        city: city.value,
        country: country.value,
        website: website.value
    }
    try {
        console.log(data);
        id.value = localStorage.getItem('id');
        console.log("id", id.value);
        const response = await axios.put(`http://localhost:8000/api/societe/profile/${id.value}`, data, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        console.log(response);
    } catch (error) {
        console.error(error);
    }
};
    
</script>
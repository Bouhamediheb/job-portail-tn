<template>
  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-jobhub-logo">
            <a class="d-flex" href="/"
              ><img
                alt="PortailTN"
                src="/assets/home/imgs/template/jobhub-logo.png"
                title="PortailTN"
              />
            </a>
          </div>
        </div>
        <div class="header-search">
          <div class="box-search">
            <form action="#">
              <input
                class="form-control input-search"
                type="text"
                name="keyword"
                placeholder="Search"
              />
            </form>
          </div>
        </div>
        <div class="header-menu d-none d-md-block">
          <ul>
            <li>
              <router-link to="/">Accueil</router-link>
            </li>
            <li><a href="">Nous contacter</a></li>
          </ul>
        </div>
        <div class="header-right">
          <div class="block-signin">
            <a
              class="btn btn-default icon-edit hover-up"
              @click="postJob(99)"
              v-if="isCompany"
              >Poster une annonce</a
            >

            <span class="ml-30"> </span>
            <div class="member-login">
              <img
                v-if="isCompany"
                :src="
                  'http://localhost:8000/api/societe/logo/' + userProfile.id
                "
                alt="Company logo"
              />
              <img
                v-else
                :src="
                  'http://localhost:8000/api/profil/image/' + userProfile.id
                "
                alt="User avatar"
              />
              <div class="info-member mt-5">
                <strong class="color-brand-1"
                  >Bienvenue,
                  {{ displayUserName }}
                </strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="burger-icon burger-icon-white">
    <span class="burger-icon-top"></span><span class="burger-icon-mid"></span
    ><span class="burger-icon-bottom"></span>
  </div>
  <div
    class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar"
  >
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">
          <div class="mobile-search mobile-header-border mb-30">
            <form action="#">
              <input type="text" placeholder="Search…" /><i
                class="fi-rr-search"
              ></i>
            </form>
          </div>
          <div class="mobile-menu-wrap mobile-header-border">
            <nav>
              <ul class="main-menu">
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(1)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/dashboard.svg"
                      alt="PortailTN"
                      title="dashboard"
                    />
                    <span class="name">Dashboard</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(2)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/jobs.svg"
                      title="jobs"
                      alt="PortailTN"
                    />
                    <span class="name">Mes annonces</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(3)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/candidates.svg"
                      title="candidates"
                      alt="PortailTN"
                    />
                    <span class="name">Mes candidats</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(4)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/profiles.svg"
                      title="profiles"
                      alt="PortailTN"
                    />
                    <span class="name">Mon profil</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(5)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/settings.svg"
                      title="settings"
                      alt="PortailTN"
                    />
                    <span class="name">Paramètres</span>
                  </a>
                </li>
                <li>
                  <a class="dashboard2" href="#" @click.prevent="postJob(6)">
                    <img
                      src="assets/dashboard/imgs/page/dashboard/jobhub-logout.svg"
                      title="jobhub-logout"
                      alt="PortailTN"
                    />
                    <span class="name">Déconnexion</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>

          <div class="mobile-account">
            <h6 class="mb-10">Mon Compte</h6>
            <ul class="mobile-menu font-heading">
              <li><a href="#">Profile</a></li>
              <li><a href="">Deconnexion</a></li>
            </ul>
            <div class="mb-15 mt-15" v-if="isCompany">
              <a class="btn btn-default icon-edit hover-up" @click="postJob"
                >Poster une annonce</a
              >
            </div>
          </div>
          <div class="site-copyright">Copyright 2024 &copy;</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

const emit = defineEmits(["inFocus", "submit"]);
const id = ref(localStorage.getItem("id"));
const userProfile = ref([]);

const displayUserName = computed(() => {
  if (typeof localStorage !== "undefined") {
    const userType = localStorage.getItem("type");
    console.log(userType);
    if (userType === "user") {
      const userFirstName = localStorage.getItem("firstName");
      const userLastName = localStorage.getItem("lastName");
      return `${userFirstName} ${userLastName}`;
    } else if (userType === "company") {
      return localStorage.getItem("companyName");
    } else {
      return ""; // Handle other cases or return default value
    }
  } else {
    return ""; // Handle case where localStorage is not supported
  }
});

const isCompany = computed(() => localStorage.getItem("type") === "company");

onMounted(() => {
  getProfile();
});

const postJob = (x) => {
  console.log("xxx", x);
  emit("navigateToPostJob", x);
};

const getProfile = async () => {
  if (localStorage.getItem("type") === "user") {
    const response = await axios.get(
      `http://localhost:8000/api/profil/user/${id.value}`
    );
    userProfile.value = response.data;
  } else {
    const response = await axios.get(
      `http://localhost:8000/api/societe/profile/${id.value}`
    );
    userProfile.value = response.data;
  }
};
</script>


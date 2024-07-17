<template>
  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo">
            <router-link to="/"
              ><img
                alt="PortailTN"
                src="assets/home/imgs/template/jobhub-logo.svg"
            /></router-link>
          </div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">
              <li>
                <router-link to="/">Accueil</router-link>
              </li>
              <li class="has-children">
                <a href="">Liste des Offres</a>
                <ul class="sub-menu">
                  <li><a href="">Stages</a></li>
                  <li><a href="">Travail</a></li>
                </ul>
              </li>
              <li>
                <a href="">Annonces Featured</a>
                <ul class="sub-menu">
                  <li><a href="">Nos stages</a></li>
                  <li>
                    <a href="">Nos offres de travail</a>
                  </li>
                </ul>
              </li>
              <li class=""><a href="">Notre Blog</a></li>
              <!-- if logged add dashboard routerlink-->
              <li v-if="loggedIn">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>
            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span
            ><span class="burger-icon-mid"></span
            ><span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <template v-if="loggedIn">
            <nav class="nav-main-menu">
              <ul class="main-menu">
                <li>
                  <a href="" v-if="whoLoggedIn === 'user'"
                    >Bienvenue, {{ firstName }} {{ lastName }}</a
                  >
                  <a href="" v-else-if="whoLoggedIn === 'company'"
                    >Bienvenue, {{ companyName }}</a
                  >

                  <ul class="sub-menu">
                    <li><router-link to="/">Votre Profil</router-link></li>
                    <li><a href="#" @click.prevent="logout">Déconnexion</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </template>
          <template v-else>
            <div class="block-signin">
              <router-link class="text-link-bd-btom hover-up" to="/signup"
                >Inscription</router-link
              >
              <router-link
                class="btn btn-default btn-shadow ml-40 hover-up"
                to="/signin"
              >
                Connexion
              </router-link>
            </div>
          </template>
        </div>
      </div>
    </div>
  </header>
</template>


<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const loggedIn = ref();
const firstName = ref("");
const lastName = ref("");

const companyName = ref("");

const whoLoggedIn = localStorage.getItem("type");
const router = useRouter();

loggedIn.value = localStorage.getItem("islogged");

if (loggedIn.value && whoLoggedIn === "user") {
  firstName.value = localStorage.getItem("firstName");
  lastName.value = localStorage.getItem("lastName");
} else if (loggedIn.value && whoLoggedIn === "company") {
  companyName.value = localStorage.getItem("companyName");
}

const axiosConfig = {
  headers: {
    Authorization: `Bearer ${localStorage.getItem("token")}`,
  },
};

const logout = async () => {
  try {
    const response = await axios.post(
      "http://localhost:8000/api/logout",
      {},
      axiosConfig
    );

    console.log(response.data);
    if (response.data.message === "Successfully logged out") {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      localStorage.removeItem("islogged");
      localStorage.removeItem("firstName");
      localStorage.removeItem("lastName");
      loggedIn.value = false;
      router.push("/");
    } else {
      console.error("Logout failed");
    }
  } catch (error) {
    console.error("Logout error:", error);
  }
};
</script>

<style lang="css">
.main-menu {
  overflow: hidden;
}
.block-signin {
  width: max-content;
}

.sub-menu {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}
</style>
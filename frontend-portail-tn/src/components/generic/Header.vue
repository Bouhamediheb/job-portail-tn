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
              <li>
                <a href="jobs-grid.html">Liste des Offres</a>
                <ul class="sub-menu">
                  <li><a href="jobs-grid.html">Stages</a></li>
                  <li><a href="jobs-list.html">Travail</a></li>
                </ul>
              </li>
              <li><a href="companies-grid.html">Sociétés</a></li>
              <li>
                <a href="candidates-grid.html">Annonces Featured</a>
                <ul class="sub-menu">
                  <li><a href="candidates-grid.html">Nos stages</a></li>
                  <li>
                    <a href="candidate-details.html">Nos offres de travail</a>
                  </li>
                </ul>
              </li>
              <li class=""><a href="blog-grid.html">Notre Blog</a></li>
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
                  <a href="">Bonjour , {{ firstName }} {{ lastName }}</a>
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
                >Register</router-link
              >
              <router-link
                class="btn btn-default btn-shadow ml-40 hover-up"
                to="/signin"
                >Sign in</router-link
              >
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
const router = useRouter();

loggedIn.value = localStorage.getItem("islogged");

if (loggedIn.value) {
  firstName.value = localStorage.getItem("firstName");
  lastName.value = localStorage.getItem("lastName");
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

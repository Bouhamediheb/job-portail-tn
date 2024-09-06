<template>
  <header class="header sticky-bar mb-50">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo">
            <a class="d-flex" href="/">
              <img
                class="logo-img"
                alt="PortailTN"
                src="/assets/home/imgs/template/jobhub-logo.png"
              />
            </a>
          </div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">
              <li><router-link to="/">Home</router-link></li>
              <li><router-link to="/jobs">Emploi</router-link></li>
              <li><router-link to="/internships">Stages</router-link></li>
              <li><router-link to="/blogs">Notre Blog</router-link></li>
              <li><router-link to="/dashboard">Dashboard</router-link></li>
            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span>
            <span class="burger-icon-mid"></span>
            <span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <div class="block-signin">
            <router-link
              to="/signup"
              class="btn btn-default icon-edit hover-up"
              v-if="!loggedIn"
              >Inscription</router-link
            >
            <router-link
              to="/signin"
              class="btn btn-default icon-edit hover-up ml-20"
              v-if="!loggedIn"
              >Connexion</router-link
            >
            <div class="user-info" v-if="loggedIn">
              <span class="ml-30">{{
                whoLoggedIn === "user"
                  ? `Bienvenue ,${firstName}`
                  : `Bienvenue, ${companyName}`
              }}</span>
              <a
                @click="logout"
                href="#"
                class="btn btn-default icon-edit hover-up ml-20"
                >Déconnexion</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Mobile Header -->
  <div
    class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar"
  >
    <div class="mobile-header-wrapper-inner">
      <div class="mobile-header-content-area">
        <div class="perfect-scroll">
          <a class="d-flex" href="/">
            <img
              class="logo-img"
              alt="PortailTN"
              src="/assets/home/imgs/template/jobhub-logo.png"
            />
          </a>
          <div class="mobile-menu-wrap mobile-header-border">
            <nav>
              <ul class="mobile-menu font-heading">
                <li><router-link to="/">Home</router-link></li>
                <li><router-link to="/jobs">Emploi</router-link></li>
                <li><router-link to="/internships">Stages</router-link></li>
                <li><router-link to="/blog">Notre Blog</router-link></li>
              </ul>
            </nav>
          </div>
          <div class="mobile-account" v-if="loggedIn">
            <h6 class="mb-10">Votre compte</h6>
            <ul class="mobile-menu font-heading">
              <li><a href="#">Profile</a></li>
              <li><a href="#">Paramétres</a></li>
              <li><a href="#">Version payante</a></li>
              <li>
                <a @click="logout" v-if="loggedIn" href="#">Déconnexion</a>
              </li>
            </ul>
          </div>
          <div class="mobile-account" v-if="!loggedIn">
            <h6 class="mb-10">Votre compte</h6>
            <ul class="mobile-menu font-heading">
              <li><router-link to="/signup">Inscription</router-link></li>
              <li><router-link to="/signin">Connexion</router-link></li>
            </ul>
          </div>
          <div class="site-copyright">Copyright 2024.</div>
        </div>
      </div>
    </div>
  </div>
</template>



<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const loggedIn = ref(false); // Initialize loggedIn as false
const firstName = ref("");
const lastName = ref("");
const companyName = ref("");

const whoLoggedIn = localStorage.getItem("type");
const router = useRouter();

// Check if user or company is logged in
if (whoLoggedIn === "user") {
  loggedIn.value = localStorage.getItem("islogged") === "true";
  if (loggedIn.value) {
    firstName.value = localStorage.getItem("firstName") || "";
    lastName.value = localStorage.getItem("lastName") || "";
  }
} else if (whoLoggedIn === "company") {
  loggedIn.value = localStorage.getItem("islogged") === "true";
  if (loggedIn.value) {
    companyName.value = localStorage.getItem("companyName") || "";
  }
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
      axiosConfig
    );

    if (response.status === 200) {
      localStorage.removeItem("token");
      localStorage.clear();
      router.push("/");
    }
  } catch (error) {
    console.log(
      "Logout Error:",
      error.response ? error.response.data : error.message
    );
  }
};
</script>
<style lang="css" scoped>
.header-right {
  display: flex;
  align-items: center;
}

.header-nav {
  /* take space needed no padding left or right */
  flex: 1;

  display: flex;
  align-items: center;
}
.block-signin {
  display: flex;
  align-items: center;
}

.user-info {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-direction: row;
}

.user-info span {
  margin-right: 10px; /* Adjust spacing between name and logout button */
}

.btn {
  margin-left: 10px; /* Adjust spacing between logout button and other elements */
}

/* Default size for larger screens */
.logo-img {
  width: 250px; /* Adjust as needed */
}

/* Mobile styles */
@media (max-width: 768px) {
  .header-left,
  .header-nav {
    display: none; /* Hide the logo and navigation on small screens */
  }

  .logo-img {
    width: 150px; /* Adjust as needed */
  }

  .header-right {
    display: none; /* Hide user info and logout button on small screens */
  }

  .burger-icon {
    display: block; /* Show the hamburger menu */
  }

  .mobile-header-active {
    display: block; /* Ensure mobile menu is visible */
  }
}

/* Mobile styles */
@media (max-width: 576px) {
  .logo-img {
    width: 200px; /* Adjust as needed */
  }
}
</style>
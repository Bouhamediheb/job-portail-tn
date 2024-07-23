<template>
   <header class="header sticky-bar ">
        <div class="container">
            <div class="main-header">
                <div class="header-left">
                    <div class="header-logo">
                      <a class="d-flex" href=""><img alt="PortailTN" src="/assets/home/imgs/template/jobhub-logo.png"></a></div>
                </div>
                <div class="header-nav">
                    <nav class="nav-main-menu">
                        <ul class="main-menu">
                            <li class="">
                              <router-link to="/">Home</router-link>       
                            </li>
                            <li class="">
                            <router-link to="/jobs">Emploi</router-link>                             
                            </li>
                            <li class="">
                              <router-link to="/internships">Stages</router-link>                           
                            </li>
                            <li class="">
                              <router-link to="/blog">Notre Blog</router-link>               
                            </li>
                        </ul>
                    </nav>
                    <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                </div>
                <div class="header-right" style="display: flex;width: 100%;justify-content: flex-end;">
                    <div class="block-signin">
                      <router-link to="/signup" class="btn btn-default icon-edit hover-up " v-if = "!loggedIn">Inscription</router-link>
                      <router-link to="/signin" class="btn btn-default icon-edit hover-up ml-20" v-if = "!loggedIn"
                      >Connexion</router-link>
                      <span class="ml-30 " v-if = "loggedIn && whoLoggedIn === 'user'
                      "> Bienvenue , {{ firstName }} {{ lastName }} </span>
                      <span class="ml-30 " v-if = "loggedIn && whoLoggedIn === 'company'
                      "> Bienvenue , {{ companyName }} </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-content-area">
                <div class="perfect-scroll">
                    <div class="mobile-search mobile-header-border mb-30">
                        <form action="#">
                            <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start-->
                        <nav>
                            <ul class="mobile-menu font-heading">
                              <li class="">
                              <router-link to="/">Home</router-link>       
                            </li>
                            <li class="">
                            <router-link to="/jobs">Emploi</router-link>                             
                            </li>
                            <li class="">
                              <router-link to="/internships">Stages</router-link>                           
                            </li>
                            <li class="">
                              <router-link to="/blog">Notre Blog</router-link>               
                            </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-account">
                        <h6 class="mb-10">Votre compte</h6>
                        <ul class="mobile-menu font-heading">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Paramétres</a></li>
                            <li><a href="#">Version payante</a></li>
                          
                              <li><a @click="logout" v-if = "loggedIn" href="#">Déconnexion</a></li>
                            

                        </ul>
                    </div>
                    <div class="site-copyright">Copyright 2024.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-content-area">
                <div class="perfect-scroll">
                    <div class="mobile-search mobile-header-border mb-30">
                        <form action="#">
                            <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start-->
                        <nav>
                          <ul class="mobile-menu font-heading">
                              <li class="">
                              <router-link to="/">Home</router-link>       
                            </li>
                            <li class="">
                            <router-link to="/jobs">Emploi</router-link>                             
                            </li>
                            <li class="">
                              <router-link to="/internships">Stages</router-link>                           
                            </li>
                            <li class="">
                              <router-link to="/blog">Notre Blog</router-link>               
                            </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-account">
                        <h6 class="mb-10">Votre compte</h6>
                        <ul class="mobile-menu font-heading">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Paramétres</a></li>
                            <li><a href="#">Version payante</a></li>
                          
                              <li><a @click="logout" v-if = "loggedIn" href="#">Déconnexion</a></li>
                            

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
      {},
      axiosConfig
    );

    console.log(response.data);
    if (response.data.message === "Successfully logged out") {
      // Clear local storage based on whoLoggedIn type
      if (whoLoggedIn === "user") {
        localStorage.removeItem("firstName");
        localStorage.removeItem("lastName");
      } else if (whoLoggedIn === "company") {
        localStorage.removeItem("companyName");
      }
      
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      localStorage.removeItem("islogged");

      loggedIn.value = false; // Set loggedIn to false
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

</style>
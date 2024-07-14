<template>
        <header class="header sticky-bar"> 
      <div class="container">
        <div class="main-header">
          <div class="header-left">
            <div class="header-logo"><a class='d-flex' 
              @click="changeViewMode(0, $event)"
              ><img alt="PortailTN" src="assets/dashboard/imgs/page/dashboard/logo.svg"></a></div><span class="btn btn-grey-small ml-10">Admin area</span>
          </div>
          <div class="header-search"> 
            <div class="box-search"> 
              <form action="#">
                <input class="form-control input-search" type="text" name="keyword" placeholder="Search">
              </form>
            </div>
          </div>
          <div class="header-menu d-none d-md-block">
            <ul> 
              <li>        
                <router-link to="/">Accueil</router-link>
              
              </li>
              <li> <a href="">Nous contacter</a></li>
            </ul>
          </div>
          <div class="header-right">
            <div class="block-signin">
              <a class='btn btn-default icon-edit hover-up' @click="postJob(10)">Poster une annonce</a>
              
        <div class="dropdown d-inline-block"><a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"></a>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
                  <li><a class="dropdown-item active" href="#">10 notifications</a></li>
                  <li><a class="dropdown-item" href="#">12 messages</a></li>
                  <li><a class="dropdown-item" href="#">20 replies</a></li>
                </ul>
              </div>
              <div class="member-login"><img alt="" src="assets/dashboard/imgs/page/dashboard/profile.png">
                <div class="info-member"> <strong class="color-brand-1">Admin/RH</strong>
                  <div class="dropdown"><a class="font-xs color-text-paragraph-2 icon-down" id="dropdownProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">Super Admin</a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfile">
                      <li><a class='dropdown-item' href=''>Profile</a></li>
                      <li><a class='dropdown-item' href=''>Logout</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
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
  <nav>
    <ul class="main-menu">
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(1)">
          <img src="assets/dashboard/imgs/page/dashboard/dashboard.svg" alt="PortailTN">
          <span class="name">Dashboard</span>
        </a>
      </li>
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(2)">
          <img src="assets/dashboard/imgs/page/dashboard/jobs.svg" alt="PortailTN">
          <span class="name">Mes annonces</span>
        </a>
      </li>
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(3)">
          <img src="assets/dashboard/imgs/page/dashboard/candidates.svg" alt="PortailTN">
          <span class="name">Mes candidats</span>
        </a>
      </li>
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(4)">
          <img src="assets/dashboard/imgs/page/dashboard/profiles.svg" alt="PortailTN">
          <span class="name">Mon profil</span>
        </a>
      </li>
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(5)">
          <img src="assets/dashboard/imgs/page/dashboard/settings.svg" alt="PortailTN">
          <span class="name">Paramètres</span>
        </a>
      </li>
      <li>
        <a class='dashboard2' href='#' @click.prevent="postJob(6)">
          <img src="assets/dashboard/imgs/page/dashboard/logout.svg" alt="PortailTN">
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
              <div class="mb-15 mt-15">               <a class='btn btn-default icon-edit hover-up' @click="postJob">Poster une annonce</a>
              </div>
            </div>
            <div class="site-copyright">Copyright 2024 &copy;</div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  methods: {
    postJob(x) {
      console.log("xxx",x);
      this.$emit('navigateToPostJob', x);
    }
  }
}
</script>


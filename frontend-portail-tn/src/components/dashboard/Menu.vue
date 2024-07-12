<template>
    <div class="nav">
      <a class="btn btn-expanded"></a>
      <nav class="nav-main-menu">
        <ul class="main-menu">
          <li @click="changeViewMode(0, $event)">
            <a class="dashboard2 active" href="index.html">
              <img src="assets/dashboard/imgs/page/dashboard/dashboard.svg" alt="jobBox" />
              <span class="name">Dashboard</span>
            </a>
          </li>
          <li @click="changeViewMode(1, $event)">
            <a class="dashboard2" href="my-job-grid.html">
              <img src="assets/dashboard/imgs/page/dashboard/jobs.svg" alt="jobBox" />
              <span class="name">Mes annonces</span>
            </a>
          </li>
          <li>
            <a class="dashboard2" href="candidates.html">
              <img src="assets/dashboard/imgs/page/dashboard/candidates.svg" alt="jobBox" />
              <span class="name">Mes Candidats</span>
            </a>
          </li>
          <li>
            <a class="dashboard2" href="profile.html">
              <img src="assets/dashboard/imgs/page/dashboard/profiles.svg" alt="jobBox" />
              <span class="name">Mon Profile</span>
            </a>
          </li>
          <li>
            <a class="dashboard2" href="settings.html">
              <img src="assets/dashboard/imgs/page/dashboard/settings.svg" alt="jobBox" />
              <span class="name">Paramètres</span>
            </a>
          </li>
          <li>
            <a class="dashboard2" href="login.html">
              <img src="assets/dashboard/imgs/page/dashboard/logout.svg" alt="jobBox" />
              <span class="name">Deconnexion</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      changeViewMode(mode, event) {
        console.log("salem")
        this.$emit('updateViewMode', mode);
        event.preventDefault();
      }
    }
  }
  </script>
  
<template>
      <link href="assets/dashboard/css/stylecd4e.css" rel="stylesheet" />

  <div class="dashboard-container">
    <Header @navigateToPostJob="updateViewMode" /> 
    <main class="main">
      <div class="menu-wrapper">
        <Menu class="sticky-menu" @updateViewMode="updateViewMode" />
      </div>
      <div class="content-wrapper">
        <Overview v-if="viewMode === 0" />
        <MyPosts v-if="viewMode === 1" />
        <UserProfile v-if="viewMode === 3" />
        <CompanyProfile v-if="viewMode === 4" />
        <PostJob v-if="viewMode === 10" />
      </div>
    </main>
  </div>
</template>

<script>
import Header from "@/components/dashboard/Header.vue";
import Menu from "@/components/dashboard/Menu.vue";
import Overview from "@/components/dashboard/Overview.vue";
import MyPosts from "@/components/dashboard/MyPosts.vue";
import PostJob from "@/components/dashboard/PostJob.vue";
import UserProfile from "@/components/dashboard/User/UserProfile.vue";
import CompanyProfile from "@/components/dashboard/Company/CompanyProfile.vue";

export default {
  name: "DashboardView",
  components: {
    Header,
    Menu,
    Overview,
    MyPosts,
    PostJob, 
    UserProfile,
    CompanyProfile
  },
  mounted() {
    this.loadScripts();
    console.log(this.viewMode);
  },
  data() {
    return {
      viewMode: 0,
    };
  },
  methods: {
    loadScripts() {
      const scripts = [
        "assets/dashboard/js/vendor/jquery-3.6.0.min.js",
        "assets/dashboard/js/vendor/modernizr-3.6.0.min.js",
        "assets/dashboard/js/vendor/jquery-migrate-3.3.0.min.js",
        "assets/dashboard/js/vendor/bootstrap.bundle.min.js",
        "assets/dashboard/js/plugins/waypoints.js",
        "assets/dashboard/js/plugins/magnific-popup.js",
        "assets/dashboard/js/plugins/perfect-scrollbar.min.js",
        "assets/dashboard/js/plugins/select2.min.js",
        "assets/dashboard/js/plugins/swiper-bundle.min.js",
        "assets/dashboard/js/plugins/jquery.circliful.js",
        "assets/dashboard/js/plugins/charts/index.js",
        "assets/dashboard/js/plugins/charts/xy.js",
        "assets/dashboard/js/plugins/charts/Animated.js",
        "assets/dashboard/js/plugins/armcharts5-script.js",
        "assets/dashboard/js/mainDashboard.js",
      ];

      scripts.forEach((src) => {
        const script = document.createElement("script");
        script.src = src;
        script.async = false;
        document.head.appendChild(script);
      });
    },
    
    updateViewMode(mode) {
      this.viewMode = mode;
      console.log(this.viewMode); 
    }
  
  },
};
</script>

<style scoped>
.dashboard-container {
  display: flex;
  flex-direction: column;
  height: 100vh; /* Ensure full viewport height */
}

.main {
  display: flex;
  flex: 1; /* Take up remaining vertical space */
  overflow: hidden; /* Hide overflow initially */
}

.menu-wrapper {
  flex: 0 0 auto; /* Non-flexible auto size for the menu */
  position: sticky;
  top: 0;
  height: 100%; /* Full height of the viewport */
  overflow-y: auto; /* Allow menu to scroll */
  background-color: #fff; /* Optional: Set background color */
  z-index: 1000; /* Ensure the menu stays above other content */
  overflow: hidden; /* Disable scrolling */

}

.content-wrapper {
  flex: 1; /* Take up remaining space */
  padding: 20px; /* Adjust padding as needed */
  overflow-y: auto; /* Allow content to scroll */
}
</style>
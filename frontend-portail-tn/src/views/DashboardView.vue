<template>
  <link href="/assets/dashboard/css/stylecd4e.css" rel="stylesheet" />
  <div class="dashboard-container">
    <Header @navigateToPostJob="updateViewMode" />
    <main class="main">
      <div class="menu-wrapper">
        <Menu class="sticky-menu" :userType="userType" @updateViewMode="updateViewMode" />
      </div>
      <div class="content-wrapper">
        <div v-if="currentViewComponent">
          <component :is="currentViewComponent" @viewJobDetail="handleViewJobDetail" />
        </div>

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
import JobDetail from "@/components/generic/JobDetail.vue";
import CandidateApplications from "@/components/dashboard/Company/CandidateApplications.vue";
import PendingJobPosts from "@/components/dashboard/Admin/PendingJobPosts.vue";

export default {
  name: "DashboardView",
  components: {
    Header,
    Menu,
    Overview,
    MyPosts,
    PostJob,
    UserProfile,
    CompanyProfile,
    JobDetail,
    CandidateApplications,
    PendingJobPosts,
  },
  data() {
    return {
      userType: localStorage.getItem("type") || "user",
    viewMode: 0, 
    selectedJobId: null,
    };
  },
  computed: {
    currentViewComponent() {
      if(this.userType === 'user')
      {
      switch (this.viewMode) {
        case 0:
          return 'Overview';
        case 1:
          return 'UserProfile';
        case 6:
          return 'Deconnexion';
      }
    }
    else if(this.userType === 'company')
    {
      switch (this.viewMode) {
        case 0:
          return 'Overview';
        case 1:
          return 'CompanyProfile';
        case 2:
          return 'MyPosts';
        case 3:
          return 'CandidateApplications';
        case 4:
          return 'PendingJobPosts';
        case 5:
          return 'PostJob';
        case 6:
          return 'Deconnexion';
      }
    }
    else if(this.userType === 'admin')
    {
      switch (this.viewMode) {
        case 0:
          return 'Overview';
        case 1:
          return 'MyPosts';
        case 2:
          return 'PendingJobPosts';
        case 6:
          return 'Deconnexion';
      }
    }
    },
  },
  methods: {
    updateViewMode(mode) {
      this.viewMode = mode;
    },
    handleViewJobDetail(jobId) {
      this.selectedJobId = jobId;
      this.viewMode = 99; 
    },
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
}

.content-wrapper {
  flex: 1; /* Take up remaining space */
  padding: 20px; /* Adjust padding as needed */
  overflow-y: auto; /* Allow content to scroll */
}
</style>

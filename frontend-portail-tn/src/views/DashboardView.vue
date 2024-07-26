  <template>
  <link href="/assets/dashboard/css/stylecd4e.css" rel="stylesheet" />
  <div class="dashboard-container">
    <Header @navigateToPostJob="updateViewMode" />
    <main class="main">
      <div class="menu-wrapper">
        <Menu
          class="sticky-menu"
          :userType="userType"
          @updateViewMode="updateViewMode"
        />
      </div>
      <div class="content-wrapper">
        <div v-if="currentViewComponent">
          <!-- Pass selectedJobId to EditJob component -->
          <component
            :is="currentViewComponent"
            :jobId="selectedJobId"
            @viewJobDetail="handleViewJobDetail"
            @editJob="handleEditJob"
            @showProfil="handleShowProfil"
          />
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
import EditJob from "@/components/dashboard/EditJob.vue";
import UserProfile from "@/components/dashboard/User/CreateUserProfile.vue";
import CompanyProfile from "@/components/dashboard/Company/CompanyProfile.vue";
import JobDetail from "@/components/generic/JobDetail.vue";
import CandidateApplications from "@/components/dashboard/Company/CandidateApplications.vue";
import PendingJobPosts from "@/components/dashboard/Admin/PendingJobPosts.vue";
import ShowUserProfile from "@/components/dashboard/Company/ShowUserProfile.vue";
import MyApplications from "@/components/dashboard/User/MyApplications.vue";
import { useRouter } from "vue-router";

export default {
  name: "DashboardView",
  components: {
    Header,
    Menu,
    Overview,
    EditJob,
    MyPosts,
    PostJob,
    UserProfile,
    CompanyProfile,
    JobDetail,
    ShowUserProfile,
    CandidateApplications,
    PendingJobPosts,
    MyApplications,
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
      if (this.viewMode === 7) {
        this.logout();
        return null;
      }
      if (this.userType === "user") {
        switch (this.viewMode) {
          case 0:
            return "Overview";
          case 1:
            return "UserProfile";
          case 4:
            return "MyApplications";
          case 6:
            return "Deconnexion";
        }
      } else if (this.userType === "company") {
        switch (this.viewMode) {
          case 0:
            return "Overview";
          case 1:
            return "CompanyProfile";
          case 2:
            return "MyPosts";
          case 3:
            return "CandidateApplications";
          case 4:
            return "PendingJobPosts";
          case 96:
            return "ShowUserProfile";
          case 97:
            return "EditJob";
          case 98:
            return "JobDetail";
          case 99:
            return "PostJob";
          case 6:
            return "Deconnexion";
        }
      } else if (this.userType === "admin") {
        switch (this.viewMode) {
          case 0:
            return "Overview";
          case 1:
            return "MyPosts";
          case 2:
            return "PendingJobPosts";
          case 6:
            return "Deconnexion";
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
      this.viewMode = 98;
    },
    handleEditJob(jobId) {
      this.selectedJobId = jobId;
      console.log("selectedJobId", this.selectedJobId);
      this.viewMode = 97;
    },
    handleShowProfil(userId) {
      this.selectedUserId = userId;
      this.viewMode = 96;
    },
    logout() {
      const router = useRouter();

      if (localStorage.getItem("type") === "user") {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        localStorage.setItem("islogged", false);
        localStorage.removeItem("firstName");
        localStorage.removeItem("lastName");
        localStorage.removeItem("id");
        localStorage.removeItem("type");
        router.push("/");
      } else if (localStorage.getItem("type") === "company") {
        localStorage.removeItem("token");
        localStorage.removeItem("societe");
        localStorage.setItem("islogged", false);
        localStorage.removeItem("id");
        localStorage.removeItem("type");
        router.push("/");
      } else {
        localStorage.removeItem("id");
        localStorage.removeItem("token");
        localStorage.removeItem("type");
        localStorage.removeItem("adminName");

        router.push("/");
      }
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

<template>
  <link href="assets/dashboard/css/stylecd4e.css" rel="stylesheet" />
  <Header />
  <main class="main">
    <Menu @updateViewMode="updateViewMode" />
    <Overview v-if="viewMode === 0" />
    <MyPosts v-else-if="viewMode === 1" />
  </main>
</template>

<script>
import Header from "@/components/dashboard/Header.vue";
import Menu from "@/components/dashboard/Menu.vue";
import Overview from "@/components/dashboard/Overview.vue";
import MyPosts from "@/components/dashboard/MyPosts.vue";

export default {
  name: "DashboardView",
  components: {
    Header,
    Menu,
    Overview,
    MyPosts,
  },
  mounted() {
    this.loadScripts();
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
    }
  },
};
</script>

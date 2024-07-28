<template>
  <div>
    <Header />
    <main class="main">
      <Heading class="heading-spacing"/>
      <InternshipListing />
      <BlogList />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/generic/Header.vue";
import Footer from "@/components/generic/Footer.vue";
import Heading from "@/components/internshiplist/Heading.vue";
import InternshipListing from "@/components/internshiplist/InternshipListing.vue";
import BlogList from "@/components/internshiplist/BlogList.vue";

export default {
  name: "InternshipView",
  components: {
    Header,
    Footer,
    Heading,
    InternshipListing,
    BlogList,
  },
  mounted() {
    this.loadScripts();
  },
  methods: {
    loadScripts() {
      const scripts = [
        "/assets/home/js/vendor/modernizr-3.6.0.min.js",
        "/assets/home/js/vendor/jquery-3.6.0.min.js",
        "/assets/home/js/vendor/jquery-migrate-3.3.0.min.js",
        "/assets/home/js/vendor/bootstrap.bundle.min.js",
        "/assets/home/js/plugins/waypoints.js",
        "/assets/home/js/plugins/wow.js",
        "/assets/home/js/plugins/magnific-popup.js",
        "/assets/home/js/plugins/perfect-scrollbar.min.js",
        "/assets/home/js/plugins/select2.min.js",
        "/assets/home/js/plugins/isotope.js",
        "/assets/home/js/plugins/scrollup.js",
        "/assets/home/js/plugins/swiper-bundle.min.js",
        "/assets/home/js/main8c94.js",
      ];

      scripts.forEach((src) => {
        const script = document.createElement("script");
        script.src = src;
        script.async = false;
        script.onload = () => console.log(`Script loaded: ${src}`);
        script.onerror = () => console.error(`Failed to load script: ${src}`);
        document.head.appendChild(script);
      });
    },
  },
};
</script>

<style scoped>
/* Ensure the space between Header and Heading */
.heading-spacing {
  margin-top: 100px; /* Adjust this value as needed */
}

/* Mobile-specific adjustments */
@media (max-width: 767px) {
  .heading-spacing {
    margin-top: 30px; /* Increase space on mobile if necessary */
  }
}
</style>

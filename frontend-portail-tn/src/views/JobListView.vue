<template>
    <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />
    
    <Header />
    <main class="main">
        <Heading />
        <JobListing />
        <BlogList />

    
  </main>
    <Footer />
  
  </template>
  
  <script>
  import Header from "@/components/generic/Header.vue";
  import Footer from "@/components/generic/Footer.vue";
  import Heading from "@/components/joblist/Heading.vue";
  import JobListing from "@/components/joblist/JobListing.vue";
  import BlogList from "@/components/joblist/BlogList.vue";
 
  
  export default {
    name: "JoblistView",
    components: {
      Header,
      Footer,
      Heading,
      JobListing,
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
          document.head.appendChild(script);
        });
      },
    },
  };
  </script>
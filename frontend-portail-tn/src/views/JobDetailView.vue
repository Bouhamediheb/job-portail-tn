<template>
<link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />

    <Header />
    <main class="main">

    <JobDetail :jobId="Number(id)" />
    </main>
    <Footer />

  </template>
  
  <script setup>
  import Header from "@/components/generic/Header.vue";
  import Footer from "@/components/generic/Footer.vue";
  import JobDetail from "@/components/generic/JobDetail.vue";
  import { useRoute } from 'vue-router';
  import { onMounted } from "vue";
  
  const route = useRoute();
  const id = route.params.id;

  const loadScripts = () => {
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
        console.log("script",script)
      });
  }

  onMounted(() => {
    loadScripts();
  });

    
  

  console.log("route",route.params.id)

  defineOptions({ inheritAttrs: false })


  </script>
  
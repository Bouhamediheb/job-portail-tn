<template>
    <div>
      <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />
      <Header />
      <main class="main">
        <ShowUserProfile :userId="selectedUserId" />
      </main>
      <Footer />
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import Header from "@/components/generic/Header.vue";
  import Footer from "@/components/generic/Footer.vue";
  import ShowUserProfile from "@/components/dashboard/Company/ShowUserProfile.vue";
  
  const selectedUserId = ref(null);
  
  // Function to update selectedUserId, e.g., based on user action
  const selectUser = (userId) => {
    selectedUserId.value = userId;
  };
  
  // Load external scripts if necessary
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
    });
  };
  
  onMounted(() => {
    loadScripts();
    // If you need to set the userId based on some logic, do it here
    // Example: selectUser(123); // Replace 123 with dynamic value
  });
  </script>
  
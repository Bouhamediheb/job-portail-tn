<template>
    <link href="assets/home/css/stylecd4e.css" rel="stylesheet" />
  
    <Header />
    <JobDetail :jobId="id" />
    <Footer />
  </template>
  
  <script setup>
  import Header from '@/components/generic/Header.vue'
  import Footer from '@/components/generic/Footer.vue'
  import JobDetail from '@/components/generic/JobDetail.vue'
  import { useRoute } from 'vue-router';
  
  const route = useRoute();
  const id = route.params.id;

  console.log("route",route.params.id)
  </script>
  
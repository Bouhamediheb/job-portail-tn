<template>
    <link href="assets/home/css/stylecd4e.css" rel="stylesheet" />
  
    <Header />
    <JobDetail />
    <Footer />
  </template>
  
  <script>
  import Header from '@/components/generic/Header.vue'
  import Footer from '@/components/generic/Footer.vue'
  import JobDetail from '@/components/generic/JobDetail.vue'

  
  export default {
    name: 'SignInView',
    components: {
      Header,
      Footer,
      JobDetail

    },
    data() {
      
    },

  }
  </script>
  
<template>
  <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://unpkg.com/primeflex@latest/primeflex.css"
  />

  <Header />
  <BlogDetails :blogID="blogID" />
  <Footer />
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import BlogDetails from "@/components/blog/BlogDetails.vue";
import Header from "@/components/generic/Header.vue";
import Footer from "@/components/generic/Footer.vue";

const route = useRoute();

const blogID = route.params.id;
</script>
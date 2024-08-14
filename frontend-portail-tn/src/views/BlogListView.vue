<template>
  <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://unpkg.com/primeflex@latest/primeflex.css"
  />

  <Header />
  <BlogList />
  <Footer />
</template>

<script>
import Header from "@/components/generic/Header.vue";
import Footer from "@/components/generic/Footer.vue";
import BlogList from "@/components/blog/BlogsList.vue";

export default {
  name: "BlogListView",
  components: {
    Header,
    Footer,
    BlogList,
  },
  data() {
    return {
      type: 0,
    };
  },
  methods: {
    changeType(newType) {
      this.type = newType;
    },
  },
};
</script>
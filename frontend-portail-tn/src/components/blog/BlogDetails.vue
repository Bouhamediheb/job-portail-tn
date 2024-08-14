<template>
  <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://unpkg.com/primeflex@latest/primeflex.css"
  />

  <Header />

  <div class="section-box">
    <div class="pt-50 text-center">
      <div class="container">
        <div class="box-white">
          <div class="max-width-single">
            <a class="btn btn-tag" href="#">Job Tips</a>
            <h2 class="mb-30 mt-20 text-center">
              {{ blog.title }}
            </h2>
            <div
              class="post-meta text-muted d-flex align-items-center mx-auto justify-content-center"
            >
              <div class="author d-flex align-items-center mr-30">
                <img
                  alt="jobBox"
                  src="assets/imgs/page/homepage1/user3.png"
                /><span>Sarah Harding</span>
              </div>
              <div class="date">
                <span
                  class="font-xs color-text-paragraph-2 mr-20 d-inline-block"
                  ><img
                    class="img-middle mr-5"
                    src="assets/imgs/page/blog/calendar.svg"
                  />
                  06 Sep 2022</span
                ><span class="font-xs color-text-paragraph-2 d-inline-block"
                  ><img
                    class="img-middle mr-5"
                    src="assets/imgs/template/icons/time.svg"
                  />
                  8 mins to read</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import Header from "@/components/generic/Header.vue";
import Footer from "@/components/generic/Footer.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

const route = useRoute();

const blogID = route.params.id;

const blog = ref({});

onMounted(() => {
  getBlog();
});

const getBlog = async () => {
  console.log(blogID);
  try {
    const response = await axios.get(
      `http://localhost:8000/api/blogs/${blogID}`
    );
    blog.value = response.data;
  } catch (error) {
    console.error(error);
  }
};
</script>
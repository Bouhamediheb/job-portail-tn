<template>
  <div>
    <div class="section-box">
      <div class="breacrumb-cover">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h2 class="mb-10">Articles / News</h2>
              <p class="font-lg color-text-paragraph-2">
                Get the latest news, updates and tips
              </p>
            </div>
            <div class="col-lg-6 text-end">
              <ul class="breadcrumbs mt-40">
                <li><a class="home-icon" href="index.html">Home</a></li>
                <li>Blog</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-for="blog in blogs" :key="blog.id" class="section-box mt-50">
      <div class="container">
        <div class="box-improve">
          <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12">
              <a href="blog-details.html"
                ><img
                  :src="
                    'http://localhost:8000/images/blog/' +
                    blog.images[0].image_path
                  "
                  alt="jobBox"
              /></a>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
              <div class="pt-40 pb-30 pl-30 pr-30">
                <h2 class="mt-20 mb-20">
                  <a @click="goToBlogDetails(blog.id)">{{ blog.title }}</a>
                </h2>
                <div class="h-3rem overflow-hidden text-overflow-ellipsis">
                  <p class="font-md mb-20">
                    {{ blog.content }}
                  </p>
                </div>
                <div>
                  <a class="btn btn-arrow-right" href="blog-details.html"
                    >Read More</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-box mt-50 mb-20">
      <div class="container">
        <div class="box-newsletter">
          <div class="row">
            <div class="col-xl-3 col-12 text-center d-none d-xl-block">
              <img
                src="assets/imgs/template/newsletter-left.png"
                alt="joxBox"
              />
            </div>
            <div class="col-lg-12 col-xl-6 col-12">
              <h2 class="text-md-newsletter text-center">
                New Things Will Always<br />
                Update Regularly
              </h2>
              <div class="box-form-newsletter mt-40">
                <form class="form-newsletter">
                  <input
                    class="input-newsletter"
                    type="text"
                    value=""
                    placeholder="Enter your email here"
                  />
                  <button class="btn btn-default font-heading icon-send-letter">
                    Subscribe
                  </button>
                </form>
              </div>
            </div>
            <div class="col-xl-3 col-12 text-center d-none d-xl-block">
              <img
                src="assets/imgs/template/newsletter-right.png"
                alt="joxBox"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const blogs = ref([]);

const getBlogs = async () => {
  const response = await axios.get("http://localhost:8000/api/blogs");
  blogs.value = response.data;
};

onMounted(() => {
  getBlogs();
});

const goToBlogDetails = (id) => {
  router.push({ name: "BlogDetailsView", params: { id: id } });
};
</script>
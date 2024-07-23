<template>
  <section class="section-box mt-50 mb-50">
      <div class="container">
        <div class="text-start">
          <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">News and Blog</h2>
          <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Get the latest news, updates and tips</p>
        </div>
      </div>
      <div class="container">
        <div class="mt-50">
          <!-- News and Blog section -->
          <div class="box-swiper style-nav-top">
            <div class="swiper-container swiper-group-3 swiper">
              <div class="swiper-wrapper pb-70 pt-5">
                <div class="swiper-slide" v-for="post in blogPosts" :key="post.id">
                  <div class="card-grid-3 hover-up wow animate__animated animate__fadeIn">
                    <div class="text-center card-grid-3-image">
                      <a :href="'blog-details.html?id=' + post.id">
                        <figure><img alt="PortailTN" :src="post.image" /></figure>
                      </a>
                    </div>
                    <div class="card-block-info">
                      <div class="tags mb-15"><a class="btn btn-tag" href="blog-grid.html">{{ post.category }}</a></div>
                      <h5><a :href="'blog-details.html?id=' + post.id">{{ post.title }}</a></h5>
                      <p class="mt-10 color-text-paragraph font-sm">{{ post.summary }}</p>
                      <div class="card-2-bottom mt-20">
                        <div class="row">
                          <div class="col-lg-6 col-6">
                            <div class="d-flex">
                              <img class="img-rounded" :src="post.authorImage" alt="PortailTN" />
                              <div class="info-right-img">
                                <span class="font-sm font-bold color-brand-1 op-70">{{ post.author }}</span><br />
                                <span class="font-xs color-text-paragraph-2">{{ post.published }}</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 text-end col-6 pt-15">
                            <span class="color-text-paragraph-2 font-xs">{{ post.readTime }} mins to read</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <div class="text-center"><a class="btn btn-brand-1 btn-icon-load mt--30 hover-up" href="blog-grid.html">Afficher plus Posts</a></div>
        </div>
      </div>
    </section>
        
    
</template>

<script setup >
import axios from 'axios';
/*
const  fetchBlogPosts() {
      try {
        const response = await axios.get('http://localhost:8000/api/blog-posts');
        this.blogPosts = response.data;
      } catch (error) {
        console.error("Error fetching blog posts:", error);
      }
    }
*/
const blogPosts = 
[
  {
    id: 1,
    title: "How to get a job in 30 days",
    summary: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui.",
    category: "Career",
    image: "/assets/home/images/blog/blog-1.jpg",
  }
]

</script>
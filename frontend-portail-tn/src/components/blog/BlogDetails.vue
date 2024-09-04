<template>
  <div>
    <section class="section-box">
      <div>
        <img
          v-if="blog.images && blog.images.length > 0"
          :src="
            'http://localhost:8000/images/blog/' + blog.images[0].image_path
          "
        />
      </div>
    </section>
    <section>
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
    </section>
    <section>
      <div class="post-loop-grid">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="single-body">
                <div class="max-width-single">
                  <div class="font-lg mb-30">
                    <p>
                      {{ blog.content }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div v-if="blog.images && blog.images.length > 1">
      <figure v-for="image in blog.images.slice(0)" :key="image.id">
        <img
          :src="'http://localhost:8000/images/blog/' + image.image_path"
          alt="jobBox"
        />
      </figure>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import defineProps from "vue";

const props = defineProps({
  blogID: {
    type: Number,
    required: true,
  },
});

const blog = ref([]);

onMounted(() => {
  getBlog();
});

const getBlog = async () => {
  try {
    const response = await axios.get(
      `http://localhost:8000/api/blogs/${props.blogID}`
    );
    blog.value = response.data;
  } catch (error) {
    console.error(error);
  }
};
</script>
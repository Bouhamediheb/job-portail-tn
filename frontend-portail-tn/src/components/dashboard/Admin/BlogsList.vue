<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mes Blogs</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
            <li><span>Mes Blogs</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding">
                <div class="box-action mb-30">
                  <button class="btn btn-primary" @click="openBlogModal">
                    Ajouter un Blog
                  </button>
                </div>
                <div class="row display-list">
                  <template v-if="loading">
                    <div
                      class="skeleton-loader"
                      v-for="n in itemsPerPage"
                      :key="n"
                    >
                      <div class="skeleton-card">
                        <div class="skeleton-image"></div>
                        <div class="skeleton-title"></div>
                        <div class="skeleton-info"></div>
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div v-if="blogs.length === 0" class="no-blogs-message">
                      <p>Aucun blog disponible.</p>
                    </div>
                    <div v-else>
                      <div
                        class="col-lg-12"
                        v-for="blog in blogs"
                        :key="blog.id"
                      >
                        <div class="card-style-2 hover-up">
                          <div class="card-head">
                            <div class="card-image">
                              <img
                                :src="
                                  'http://localhost:8000/images/blog/' +
                                  blog.images[0].image_path
                                "
                                alt="Blog Image"
                              />
                            </div>
                            <div class="card-title">
                              <h6>
                                {{ blog.title }}
                              </h6>
                              <span class="time-post"
                                >Posté il y a
                                {{ calculateDaysAgo(blog.created_at) }}
                                jours</span
                              >
                            </div>
                          </div>
                          <div class="card-tags">
                            <a
                              v-for="tag in blog.tags"
                              :key="tag"
                              class="btn btn-tag"
                              >{{ tag }}</a
                            >
                          </div>
                          <div class="card-actions">
                            <a
                              @click="goToEditBlog(blog.id)"
                              class="btn btn-tag"
                              >Modifier</a
                            >
                            <a
                              @click="deleteBlog(blog.id)"
                              class="btn btn-tag-delete"
                              >Supprimer</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
                <div class="paginations" v-if="paginatedBlogs.length > 0">
                  <ul class="pager">
                    <li
                      @click="prevPage"
                      :class="{ disabled: currentPage === 1 }"
                    >
                      <a class="pager-prev" href="#"></a>
                    </li>
                    <li
                      v-for="page in totalPages"
                      :key="page"
                      @click="setPage(page)"
                    >
                      <a
                        :class="[
                          'pager-number',
                          { active: currentPage === page },
                        ]"
                        href="#"
                        >{{ page }}</a
                      >
                    </li>
                    <li
                      @click="nextPage"
                      :class="{ disabled: currentPage === totalPages }"
                    >
                      <a class="pager-next" href="#"></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <sweet-modal ref="addBlog" width="60%">
      <AddBlog @closeBlogModal="closeBlogModal" />
    </sweet-modal>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import AddBlog from "./AddBlog.vue";
import { SweetModal } from "sweet-modal-vue-3";

const router = useRouter();

onMounted(() => {
  getBlogs();
});

const addBlog = ref(null);
const blogs = ref([]);
const currentPage = ref(1);
const itemsPerPage = ref(10);

const loading = ref(true);

const paginatedBlogs = ref([]);
const totalPages = ref(0);

const calculateDaysAgo = (date) => {
  const now = new Date();
  const blogDate = new Date(date);
  const diffTime = Math.abs(now - blogDate);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  return diffDays;
};

const getBlogs = async () => {
  const response = await axios.get("http://localhost:8000/api/blogs");
  blogs.value = response.data;
  loading.value = false;
};

const openBlogModal = () => {
  addBlog.value.open();
};

const closeBlogModal = () => {
  addBlog.value.close();
  getBlogs();
};
</script>
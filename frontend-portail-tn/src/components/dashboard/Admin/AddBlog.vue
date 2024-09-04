<template>
  <div>
    <div class="box-title">
      <h3 class="mb-35">Ajouter un Blog</h3>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding bg-postjob">
                <h5 class="icon-edu">
                  Veuillez remplir les informations de votre blog
                </h5>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10 mt-2"
                    >Titre du Blog *</label
                  >
                  <input
                    class="form-control"
                    type="text"
                    placeholder="Exemple : Mon voyage en France"
                    v-model="blogDetails.title"
                  />
                </div>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10 mt-2"
                    >Contenu du Blog *</label
                  >
                  <textarea
                    name="message"
                    rows="8"
                    placeholder="Exemple : J'ai passé un merveilleux séjour en France..."
                    v-model="blogDetails.content"
                  ></textarea>
                </div>
                <div class="form-group mb-30">
                  <label class="font-sm color-text-muted mb-10">Images *</label>
                  <div class="box-upload">
                    <div class="add-file-upload row">
                      <input
                        class="fileupload"
                        type="file"
                        name="file"
                        multiple
                        @change="handleImageUpload"
                      />
                      <div
                        v-if="selectedFiles.length"
                        class="uploaded-images mt-3"
                      >
                        <div
                          v-for="(image, index) in selectedFiles"
                          :key="index"
                          class="uploaded-image-preview"
                        >
                          <img
                            :src="image.url"
                            alt="Image Preview"
                            class="img-thumbnail"
                          />
                          <button
                            @click="removeImage(index)"
                            class="btn btn-danger btn-sm"
                          >
                            Supprimer
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group mt-10 text-lg-end">
                  <button
                    @click="submitBlog"
                    class="btn btn-default btn-brand icon-tick"
                  >
                    Publier le Blog
                  </button>
                </div>
              </div>
            </div>
          </div>
          <sweet-modal icon="success" ref="postedBlog">
            <div class="spacingtop">Votre blog a été publié avec succès !</div>
          </sweet-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, defineEmits } from "vue";
import axios from "axios";
import { SweetModal } from "sweet-modal-vue-3";

const emit = defineEmits(["closeBlogModal"]);
const admin_id = localStorage.getItem("admin_id");
const selectedFiles = ref([]);

const blogDetails = ref({
  title: "",
  content: "",
  images: [],
  admin_id: admin_id,
});
const postedBlog = ref(null);

const handleImageUpload = (event) => {
  const files = event.target.files;
  for (let i = 0; i < files.length; i++) {
    const reader = new FileReader();
    reader.onload = (e) => {
      blogDetails.value.images.push(event.target.files[i]);
      selectedFiles.value.push({ url: e.target.result });
    };
    reader.readAsDataURL(files[i]);
  }
};

const removeImage = (index) => {
  blogDetails.value.images.splice(index, 1);
};

const closeBlogModal = () => {
  emit("closeBlogModal");
};

const submitBlog = async () => {
  const response = await axios.post(
    "http://localhost:8000/api/blog/post",
    blogDetails.value,
    { headers: { "Content-Type": "multipart/form-data" } }
  );

  if (response.status === 201) {
    closeBlogModal();
  }
};
</script>
<template>
  <section class="section-box-2">
    <div class="container">
      <div class="banner-hero banner-image-single">
        <img src="/assets/home/imgs/page/candidates/img.png" alt="jobbox" />
      </div>
      <div class="box-company-profile">
        <!-- Profile Picture -->
        <div class="image-compay">
          <img
            :src="
              profile
                ? `http://localhost:8000/api/profil/image/${profile.id}`
                : '/assets/home/imgs/page/candidates/candidate-profile.png'
            "
            class="profile-image"
            alt="profile"
          />
        </div>
        <div class="col mt-10">
          <div class="col-lg-8 col-md-12">
            <h5 class="f-18">
              {{
                profile
                  ? profile.user.firstname + " " + profile.user.lastname
                  : "Loading..."
              }}
            </h5>
            <p class="f-18">{{ profile ? profile.bio : "Loading..." }}</p>
          </div>
        </div>
      </div>
      <div class="border-bottom pt-10 pb-10"></div>
    </div>
  </section>

  <section class="section-box mt-50 mb-50">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="content-single">
            <div class="tab-content">
              <div
                class="tab-pane fade show active"
                id="tab-short-bio"
                role="tabpanel"
                aria-labelledby="tab-short-bio"
              >
                <h4>A propos du profil :</h4>
                <p>{{ profile ? profile.bio : "Loading..." }}</p>
                <h4>Les compétences :</h4>
                <div class="row">
                  <ul>
                    <li
                      v-for="skill in profile ? JSON.parse(profile.skills) : []"
                      :key="skill"
                    >
                      {{ skill }}
                    </li>
                  </ul>
                </div>
                <h4>Parcours Professionel</h4>
                <ul>
                  <li
                    v-for="experience in profile
                      ? profile.professional_experiences
                      : []"
                    :key="experience.id"
                  >
                    {{ experience.description || "No description available" }}
                  </li>
                </ul>
                <h4>Parcours Académique</h4>
                <ul>
                  <li
                    v-for="education in profile
                      ? profile.academic_experiences
                      : []"
                    :key="education.id"
                  >
                    {{ education.description || "No description available" }}
                  </li>
                </ul>
              </div>
              <div class="tab-pane">
                <h4>Skills</h4>
                <p>
                  {{
                    profile
                      ? JSON.parse(profile.skills).join(", ")
                      : "Loading..."
                  }}
                </p>
              </div>
              <div class="tab-pane fade">
                <h4>Work Experiences</h4>
                <p>
                  {{
                    profile
                      ? profile.professional_experiences
                          .map((exp) => exp.description)
                          .join(", ")
                      : "Loading..."
                  }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
          <a class="btn btn-default mr-15 mt-30" href="#">Contacter</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const userId = route.query.userId;
const profile = ref(null);
const loading = ref(true);

const fetchProfileData = async () => {
  try {
    const response = await axios.get(
      `http://localhost:8000/api/profil/user/${userId}`
    );
    console.log("User profile:", response.data);
    profile.value = response.data;
    loading.value = false;
  } catch (error) {
    console.error("Error fetching profile data:", error);
  }
};

onMounted(() => {
  fetchProfileData();
});
</script>

<style scoped>
.profile-image {
  width: 100px; /* Adjust the width as needed */
  height: 100px; /* Adjust the height as needed */
  border-radius: 50%; /* Makes the image rounded */
  object-fit: cover; /* Ensures the image covers the container */
}
</style>

<template>
  <section class="section-box mt-110 bg-cat">
    <div class="section-box wow animate__animated animate__fadeIn mt-70">
      <div class="container">
        <div class="text-center">
          <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">
            Parcourir par catégorie
          </h2>
          <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
            Trouvez l'offre qui vous convient par catégorie
          </p>
        </div>
        <div class="box-swiper mt-50">
          <div class="swiper-container swiper-group-5 swiper">
            <div class="swiper-wrapper pb-70 pt-5">
              <div 
                v-for="(count, domain) in domainCounts" 
                :key="domain" 
                class="swiper-slide hover-up"
              >
                <a :href="'/jobs?domain=' + domain">
                  <div class="item-logo">
                    <div class="image-left">
                      <img :alt="domain" src="/assets/home/imgs/page/homepage1/content.svg" />
                    </div>
                    <div class="text-info-right">
                      <h4>{{ domain }}</h4>
                      <p class="font-xs">{{ count }}<span> annonces</span></p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-pagination swiper-pagination-group-5"></div>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

export default {
  name: "JobsByCategory",
  setup() {
    const jobs = ref([]);
    const domainCounts = computed(() => {
      const counts = {};
      jobs.value.forEach(job => {
        const domain = job.domain;
        if (domain in counts) {
          counts[domain]++;
        } else {
          counts[domain] = 1;
        }
      });
      return counts;
    });

    // Fetch jobs data from the API
    const fetchJobs = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/offre');
        jobs.value = response.data;
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    };

    // Fetch jobs data when the component is mounted
    onMounted(fetchJobs);

    return {
      domainCounts
    };
  }
};
</script>

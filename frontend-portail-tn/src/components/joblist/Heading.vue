<template>
  <section class="section-box-2">
    <div class="container">
      <div class="banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
          <h3 class="wow animate__animated animate__fadeInUp noshowmobile">
            <span class="total-jobs">{{ totalJobs }}</span> offres d'emploi disponibles
          </h3>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue'; // Correct import for ref and onMounted

const totalJobs = ref(0);
const domains = ref([]);
const selectedDomain = ref('');
const selectedLocation = ref('');
const keywords = ref('');

const emit = defineEmits(['search']);

const fetchJobs = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/onlyjobs');
    totalJobs.value = response.data.length;
  } catch (error) {
    console.error('Error fetching internships:', error);
  }
};

// get fields from jobs.domain
const jobs = ref([]);

const getDomains =  async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/onlyjobs");
        const allDomains = response.data.map((job) => job.domain);
        domains.value = [...new Set(allDomains)];
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    }

const handleSearch = () => {
  console.log('searching...');
  console.log(selectedDomain.value, selectedLocation.value, keywords.value);
  emit('search', {
    domain: selectedDomain.value,
    location: selectedLocation.value,
    keywords: keywords.value
  });
};


onMounted(() => {
  fetchJobs();
  getDomains();
});



</script>

<style scoped>
@media (max-width: 767px) {
  .total-jobs {
    display: none;
  }
  .noshowmobile {
    display: none;
  }
}


</style>
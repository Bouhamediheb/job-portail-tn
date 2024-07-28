<template>
<section class="section-box-2">
            <div class="container">
                <div class="banner-hero banner-single banner-single-bg">
                    <div class="block-banner text-center">
                        <h3 class="wow animate__animated animate__fadeInUp noshowmobile"><span class="color-brand-2"> {{ 
                            totalInternships }} </span> offres de stages disponibles</h3>
                        
                      
                    </div>
                </div>
            </div>
   
</section>
      
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue'; // Correct import for ref and onMounted

const totalInternships = ref(0);
const domains = ref([]);

const fetchInternships = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/onlyinternships');
    totalInternships.value = response.data.length;
  } catch (error) {
    console.error('Error fetching internships:', error);
  }
};

const internships = ref([]);

const getDomains =  async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/onlyinternships");
        const allDomains = response.data.map((job) => job.domain);
        domains.value = [...new Set(allDomains)];
        console.log(domains.value);
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    }

onMounted(() => {
  fetchInternships();
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
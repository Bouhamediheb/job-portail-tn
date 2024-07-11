<template>

    <Header />
    <Heading />
    <LatestJobs />
    <JobsByCategory />
    <Footer />

</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import Heading from '@/components/home/Heading.vue'
import LatestJobs from '@/components/home/LatestJobs.vue'
import JobsByCategory from '@/components/home/JobsByCategory.vue'

export default {
  name: 'HomeView',
  components: {
    Header,
    Footer,
    Heading,
    LatestJobs,
    JobsByCategory
  }
}
</script>

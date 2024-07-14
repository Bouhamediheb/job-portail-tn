<template>
  <link href="assets/home/css/stylecd4e.css" rel="stylesheet" />

    <Header />
    <SignUpForm />
    <Footer />

</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import SignUpForm from '@/components/signup/SignUpForm.vue'

export default {
  name: 'SignUpView',
  components: {
    Header,
    Footer,
    SignUpForm
  }
}
</script>

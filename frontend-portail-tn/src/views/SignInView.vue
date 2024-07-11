<template>

    <Header />
    <SignInForm />
    <Footer />

</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import SignInForm from '@/components/signIn/SignInForm.vue'

export default {
  name: 'SignInView',
  components: {
    Header,
    Footer,
    SignInForm
  }
}
</script>

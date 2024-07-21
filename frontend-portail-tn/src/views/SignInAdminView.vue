<template>
  <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />

  <Header />
  <SignInFormAdmin  />
  <Footer />
</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import SignInFormAdmin from '@/components/signIn/SignInForm_admin.vue'

export default {
  name: 'SignInView',
  components: {
    Header,
    Footer,
    SignInFormAdmin,
  },
  data() {
    return {
      type: 0
    }
  },
  methods: {
    changeType(newType) {
      this.type = newType;
    }
  }
}
</script>

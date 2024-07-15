<template>
  <link href="assets/home/css/stylecd4e.css" rel="stylesheet" />

  <Header />
  <SignInFormUser v-if="type === 0" @changeType="changeType" />
  <SignInFormCompany v-else @changeType="changeType" />
  <Footer />
</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import SignInFormUser from '@/components/signIn/SignInForm_user.vue'
import SignInFormCompany from '@/components/signIn/SignInForm_company.vue'

export default {
  name: 'SignInView',
  components: {
    Header,
    Footer,
    SignInFormUser,
    SignInFormCompany
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

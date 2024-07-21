<template>
  <link href="/assets/home/css/stylecd4e.css" rel="stylesheet" />

  <Header />
  <SignUpFormUser v-if="type === 0" @changeType="changeType" />
  <SignUpFormCompany v-else @changeType="changeType" />
  <Footer />
</template>

<script>
import Header from '@/components/generic/Header.vue'
import Footer from '@/components/generic/Footer.vue'
import SignUpFormUser from '@/components/signup/SignUpForm_user.vue'
import SignUpFormCompany from '@/components/signup/SignUpForm_company.vue'

export default {
  name: 'SignUpView',
  components: {
    Header,
    Footer,
    SignUpFormUser,
    SignUpFormCompany
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

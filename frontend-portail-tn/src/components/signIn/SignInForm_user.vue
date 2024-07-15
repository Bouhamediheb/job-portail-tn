<template>
    <main class="main">
      <section class="pt-100 login-register">
        <div class="container">
          <div class="row login-register-cover">
            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <p class="font-sm text-brand-2">Bienvenue !</p>
                <h2 class="mt-10 mb-5 text-brand-1">Authentification pour les candidats</h2>
                <p class="font-sm text-muted mb-30">Connectez-vous pour accéder à votre compte.</p>
                <button class="btn social-login hover-up mb-20"><img
                    src="assets/home/imgs/template/icons/icon-google.svg" alt="PortailTN"><strong>Se
                    connecter avec Google</strong></button>
                <div class="divider-text-center"><span> ou </span></div>
              </div>
              <form class="login-register text-start mt-20" @submit.prevent="login">
                <div class="form-group">
                  <label class="form-label" for="input-1">Adresse Email *</label>
                  <input class="form-control" id="input-1" type="email" v-model="email" required
                    placeholder="Foulenbenfoulen@gmail.com">
                </div>
                <div class="form-group">
                  <label class="form-label" for="input-4">Mot de passe *</label>
                  <input class="form-control" id="input-4" type="password" v-model="password" required
                    placeholder="************">
                </div>
                <div class="login_footer form-group d-flex justify-content-between">
                  <label class="cb-container">
                    <input type="checkbox"><span class="text-small">Se souvenir de moi</span>
                  </label><a class='text-muted' href='page-contact.html'>Mot de passe oublié ?</a>
                </div>
                <div class="form-group">
                  <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">Se
                    connecter</button>
                </div>
                
                <div class="text-muted text-center">Vous n'avez pas de compte ?
                  <router-link to="/signup">Créez un compte</router-link>
                </div>
                <div class="spacingbottom-small"></div>

                <div class="divider-text-center"></div>
                <div class="spacingbottom-small"></div>

              <button class="btn btn-brand-1 hover-up w-100"  @click="$emit('changeType', 1)">Vous êtes un recruteur?</button>
                <div class="spacingbottom-large"></div>
              </form>
              
            </div>
          </div>
          <sweet-modal icon="error" ref="errorModal">
            <div class="mt-3">
              <h5>Erreur d'authentification</h5>
              <p>Adresse email ou mot de passe incorrect</p>
            </div>
          </sweet-modal>
        </div>
      </section>
    </main>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  import { useRouter } from "vue-router";
  import { SweetModal, SweetModalTab } from 'sweet-modal-vue-3'
  
  const router = useRouter()
  const loggedIn = ref(false)
  const errorModal = ref(null);
  
  const email = ref('')
  const password = ref('')
  
  const login = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/login', {
        email: email.value,
        password: password.value
      })
  
      console.log(response.data)
      console.log("piw ", response.data.status)
      if (response.data.status) {
        loggedIn.value = true
        localStorage.setItem('token', response.data.token)
        console.log("token", response.data.token)
        console.log("user", response.data.user)
        localStorage.setItem('user', response.data.user)
        localStorage.setItem('firstName', response.data.user.firstname)
        localStorage.setItem('lastName', response.data.user.lastname)
        localStorage.setItem('islogged', true)
        localStorage.setItem('id', response.data.user.id)
        localStorage.setItem('type', 'user')
        router.push('/')
      }
    } catch (error) {
      console.error(error);
      if (errorModal.value) {
        errorModal.value.open();
      }
      email.value = ''
      password.value = ''
      setTimeout(() => {
        loggedIn.value = null;
      }, 3000);
    }
  }
  </script>
  
  <style>
  .spacingbottom-large {
    padding-bottom: 100px;
  }
  .spacingbottom-small {
    padding-bottom: 50px;
  }
  </style>
  
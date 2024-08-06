<template>
  <main class="main">
    <section class="pt-100 login-register">
      <div class="container">
        <div class="row login-register-cover">
          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
            <div class="text-center">
              <p class="font-sm text-brand-2">Créez votre compte !</p>
              <h2 class="mt-10 mb-5 text-brand-1">Inscription pour les entreprises</h2>
              <p class="font-sm text-muted mb-30">Créer un compte pour accéder à toutes les fonctionnalités.</p>
              <button class="btn social-login hover-up mb-20"><img src="assets/home/imgs/template/icons/icon-google.svg" alt="PortailTN"><strong>Continuez avec Google</strong></button>
              <div class="divider-text-center"><span>Ou</span></div>
            </div>
            <form class="login-register text-start mt-20" @submit.prevent="register">
              <div class="form-group">
                <label class="form-label" for="input-1">Nom de la société *</label>
                <input class="form-control" id="input-1" type="text" v-model="name" required name="firstName" placeholder="Société GrowUp">
              </div>
              <div class="form-group">
                <label class="form-label" for="input-2">Adresse Email *</label>
                <input class="form-control" id="input-2" type="email" v-model="emailaddress" required name="emailaddress" placeholder="hr@growup.tn">
              </div>
              <div class="form-group">
                <label class="form-label" for="input-4">Mot de passe *</label>
                <input class="form-control" id="input-4" type="password" v-model="password" required name="password" placeholder="************">
              </div>
              <div class="form-group">
                <label class="form-label" for="input-5">Confirmation mot de passe *</label>
                <input class="form-control" id="input-5" type="password" v-model="rePassword" required name="re-password" placeholder="************">
              </div>
              <div class="login_footer form-group d-flex justify-content-between">
                <label class="cb-container">
                  <input type="checkbox" ref="termsCheckbox" required><span class="text-small">
                      J'accepte les <a class='text-muted' href='page-contact.html'>termes et conditions</a>
                  </span><span class="checkmark"></span>
                </label>
              </div>
              <div class="form-group">
                <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login">
                  Créer le compte
                </button>
              </div>
              <div class="text-muted text-center">
                Vous avez déjà un compte ? 
                <router-link to="/signin">Connectez-vous</router-link>
              </div>
              <div class="spacingbottom-small"></div>
              <div class="divider-text-center"></div>
              <div class="spacingbottom-small"></div>
            </form>
            <button class="btn btn-brand-1 hover-up w-100"  @click="$emit('changeType', 0)">Vous êtes un candidat?</button>
            <div class="spacingbottom-large"></div>
            <sweet-modal icon="success" ref="createdAccount">
              <div class="spacingtop">
                Votre compte a été créé avec succès !
              </div>
            </sweet-modal>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style>
.spacingbottom {
  padding-bottom: 100px;
}
.spacingtop {
  padding-top: 30px;
}
</style>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { SweetModal } from 'sweet-modal-vue-3'

const router = useRouter()
const createdAccount = ref(null)
const name = ref('')
const emailaddress = ref('')
const password = ref('')
const rePassword = ref('')
const errorMessage = ref('')
const termsCheckbox = ref(null)

const register = async () => {
  if (password.value !== rePassword.value) {
    errorMessage.value = 'Les mots de passe ne correspondent pas.'
    return
  }

  if (!termsCheckbox.value.checked) {
    errorMessage.value = 'Vous devez accepter les termes et conditions.'
    return
  }

  try {
    const response = await axios.post('http://localhost:8000/api/societe/register', {
      name: name.value,
      email: emailaddress.value,
      password: password.value,
    })

    console.log(response.data)

    if (createdAccount.value) {
      createdAccount.value.open()
    }

    setTimeout(() => {
      router.push("/signin")
    }, 2000)

  } catch (error) {
    console.error(error)
  }
}
</script>

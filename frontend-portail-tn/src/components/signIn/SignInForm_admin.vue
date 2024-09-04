<template>
  <main class="main">
    <section class="pt-100 login-register">
      <div class="container">
        <div class="row login-register-cover">
          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
            <div class="text-center">
              <p class="font-sm text-brand-2">Bienvenue !</p>
              <h2 class="mt-10 mb-5 text-brand-1">
                Authentification pour administrateurs
              </h2>
              <p class="font-sm text-muted mb-30">
                Connectez-vous pour accéder à votre dashboard.
              </p>
            </div>
            <form
              class="login-register text-start mt-20"
              @submit.prevent="login"
            >
              <div class="form-group">
                <label class="form-label" for="input-1">Adresse Email *</label>
                <input
                  class="form-control"
                  id="input-1"
                  type="email"
                  v-model="crendentials.email"
                  required
                  placeholder="Foulenbenfoulen@gmail.com"
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="input-4">Mot de passe *</label>
                <input
                  class="form-control"
                  id="input-4"
                  type="password"
                  v-model="crendentials.password"
                  required
                  placeholder="************"
                />
              </div>

              <div class="form-group mt-30 mb-50">
                <button
                  class="btn btn-brand-1 hover-up w-100"
                  type="submit"
                  name="login"
                >
                  Se connecter
                </button>
              </div>
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
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { SweetModal, SweetModalTab } from "sweet-modal-vue-3";

const router = useRouter();
const loggedIn = ref(false);
const errorModal = ref(null);

const crendentials = ref({
  email: "",
  password: "",
});

const login = async () => {
  try {
    console.log(crendentials.value);
    const response = await axios.post(
      "http://localhost:8000/api/admin/login",
      crendentials.value
    );

    if (response.data.status) {
      console.log(response.data);
      loggedIn.value = true;
      localStorage.setItem("token", response.data.token);
      console.log("token", response.data.token);
      localStorage.setItem("admin_id", response.data.admin.id);
      localStorage.setItem("adminName", response.data.admin.fname);
      localStorage.setItem("islogged", true);
      localStorage.setItem("type", "admin");
      router.push("/dashboard");
    }
  } catch (error) {}
};
</script>

<style>
.spacingbottom-large {
  padding-bottom: 100px;
}
.spacingbottom-small {
  padding-bottom: 50px;
}
</style>

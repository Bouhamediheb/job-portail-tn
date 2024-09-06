<template>
  <div>
    <h3 class="mb-35">Block User</h3>
    <p class="mb-20">Voulez-vous vraiment désactiver cet utilisateur ?</p>
    <div class="col-lg-12">
      <button class="btn btn-success mr-20" @click="blockUser">Oui</button>
      <button class="btn btn-danger" @click="$emit('closeModal')">Non</button>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";

const props = defineProps({
  userID: Number,
});

const emit = defineEmits(["closeModal"]);

const closeModal = () => {
  emit("closeModal");
};

const blockUser = async () => {
  await axios.post("http://localhost:8000/api/users/block/" + props.userID);
  closeModal();
};
</script>
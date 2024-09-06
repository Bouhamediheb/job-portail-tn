<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Liste des Utilisateurs</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard"
                >Dashboard</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-box">
          <div class="container">
            <div class="panel-white mb-30">
              <div class="box-padding">
                <div class="box-action mb-30">
                  <button
                    class="btn btn-primary"
                    :class="{ 'btn btn-danger': selectedBlockedUsers }"
                    @click="selectBlockedUsers"
                  >
                    Utilisateurs Bloqués
                  </button>
                </div>
                <div class="row display-list">
                  <template v-if="loading">
                    <div class="skeleton-loader" v-for="n in 3" :key="n">
                      <div class="skeleton-card">
                        <div class="skeleton-image"></div>
                        <div class="skeleton-title"></div>
                        <div class="skeleton-info"></div>
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div v-if="users.length === 0">
                      <p>Aucun Utilisateur Inscrit !</p>
                    </div>
                    <div v-else>
                      <div
                        class="col-lg-12"
                        v-for="user in filteredUsers"
                        :key="user.id"
                      >
                        <div class="card-style-2 hover-up">
                          <div class="card-head">
                            <div class="card-image">
                              <img
                                v-if="user.profil"
                                :src="
                                  'http://localhost:8000/images/profil/' +
                                  user.profil.profilePicture
                                "
                                alt="User image"
                              />
                            </div>
                            <div class="card-title">
                              <h5>{{ user.firstname }} {{ user.lastname }}</h5>
                            </div>
                            <div class="card-actions" v-if="user.blocked === 0">
                              <button
                                class="btn btn-danger"
                                @click="blockUserModal(user.id)"
                              >
                                Bloquer
                              </button>
                            </div>
                            <div
                              v-else-if="user.blocked === 1"
                              class="card-actions"
                            >
                              <button
                                class="btn btn-success"
                                @click="unblockUserModal(user.id)"
                              >
                                Débloquer
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <sweet-modal ref="blockUser" hide-close-button="true">
      <BlockUser :userID="selectedUserID" @closeModal="closeUserBlockModal" />
    </sweet-modal>

    <sweet-modal ref="unblockUser" hide-close-button="true">
      <UnblockUser
        :userID="selectedUserID"
        @closeModal="closeUserUnblockModal"
      />
    </sweet-modal>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, computed } from "vue";
import { SweetModal } from "sweet-modal-vue-3";
import BlockUser from "./BlockUser.vue";
import UnblockUser from "./UnblockUser.vue";

const loading = ref(true);
const users = ref([]);
const blockUser = ref(null);
const unblockUser = ref(null);
const selectedUserID = ref(null);
const selectedBlockedUsers = ref(false);

onMounted(() => {
  getUsers();
});

const filteredUsers = computed(() => {
  if (selectedBlockedUsers.value === true) {
    return users.value.filter((user) => user.blocked === 1);
  }
  return users.value.filter((user) => user.blocked === 0);
});

const getUsers = async () => {
  const response = await axios.get("http://localhost:8000/api/users");
  users.value = response.data;
  console.log(users.value);
  setTimeout(() => {
    loading.value = false;
  }, 1000);
};

const blockUserModal = (id) => {
  selectedUserID.value = id;
  blockUser.value.open();
};

const unblockUserModal = (id) => {
  selectedUserID.value = id;
  unblockUser.value.open();
};

const closeUserBlockModal = () => {
  blockUser.value.close();
  getUsers();
};

const closeUserUnblockModal = () => {
  unblockUser.value.close();
  getUsers();
};

const selectBlockedUsers = () => {
  selectedBlockedUsers.value = !selectedBlockedUsers.value;
};
</script>
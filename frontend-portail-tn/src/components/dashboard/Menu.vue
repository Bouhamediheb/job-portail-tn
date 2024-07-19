<template>
  <div class="nav">
    <nav class="nav-main-menu">
      <ul class="main-menu">
        <li
          v-for="(item, index) in menuItems"
          :key="index"
          @click="changeViewMode(index, $event)"
        >
          <a
            :class="['dashboard2', { active: selectedMenuIndex === index }]"
            :href="item.href"
          >
            <img :src="item.img" :alt="item.name" />
            <span class="name">{{ item.name }}</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedMenuIndex: 0,
      menuItems: [
        {
          name: "Dashboard",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/dashboard.svg",
        },
        {
          name: "Mes annonces",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/jobs.svg",
        },
        {
          name: "Mon Profile",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/profiles.svg",
        },
        {
          name: "Paramètres",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/settings.svg",
        },
        {
          name: "Deconnexion",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/logout.svg",
        },
        {
          name: "Mes Candidats",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/candidates.svg",
        },
      ],
    };
  },
  methods: {
    changeViewMode(mode, event) {
      this.selectedMenuIndex = mode;
      this.$emit("updateViewMode", mode);
      event.preventDefault();
    },
  },
};
</script>

<style lang="css">
.nav {
  height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: #f8f9fa;
}
.nav-main-menu {
  flex: 1;
  overflow-y: auto;
}
.main-menu {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
</style>

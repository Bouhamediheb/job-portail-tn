<template>
  <div class="nav">
    <nav class="nav-main-menu">
      <ul class="main-menu">
        <li
          v-for="(item, index) in filteredMenuItems"
          :key="index"
          @click="handleMenuItemClick(item, $event)"
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
  name: "Menu",
  props: ['userType'],
  data() {
    return {
      selectedMenuIndex: 0,
      menuItems: [
        {
          name: "Dashboard",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/dashboard.svg",
          viewMode: {
            admin: 0,
            user: 0,
            company: 0,
          },
        },
        {
          name: "Mon Profile",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/profiles.svg",
          viewMode: {
            admin: 3,
            user: 1,
            company: 3,
          },
        },
        {
          name: "Mes annonces",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/jobs.svg",
          viewMode: {
            admin: 1,
            user: null,
            company: 1,
          },
        },
        {
          name: "Mes Candidats",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/candidates.svg",
          viewMode: {
            admin: 2,
            user: null,
            company: 2,
          },
        },
        
        {
          name: "Paramètres",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/settings.svg",
          viewMode: {
            admin: 4,
            user: 5,
            company: 4,
          },
        },
        {
          name: "Deconnexion",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/logout.svg",
          viewMode: {
            admin: 5,
            user: 6,
            company: 5,
          },
        },
        {
          name: "Liste des offres",
          href: "",
          img: "assets/dashboard/imgs/page/dashboard/jobs.svg",
          viewMode: {
            admin: 6,
            user: null,
            company: null,
          },
        },
      ],
    };
  },
  computed: {
    filteredMenuItems() {
      return this.menuItems.filter(item =>
        item.viewMode[this.userType] !== null
      );
    },
  },
  methods: {
    handleMenuItemClick(item, event) {
      event.preventDefault();
      this.selectedMenuIndex = this.menuItems.indexOf(item);
      this.$emit("updateViewMode", item.viewMode[this.userType]);
    },
  },
};
</script>

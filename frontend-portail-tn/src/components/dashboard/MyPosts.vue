<template>
  <div class="box-content">
    <div class="box-heading">
      <div class="box-title">
        <h3 class="mb-35">Mes annonces</h3>
      </div>
      <div class="box-breadcrumb">
        <div class="breadcrumbs">
          <ul>
            <li>
              <router-link class="icon-home" to="/dashboard">Dashboard</router-link>
            </li>
            <li><span>Mes annonces</span></li>
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
                <div class="row display-list">
                  <div class="col-lg-6" v-for="item in paginatedItems" :key="item.id">
                    <div class="card-style-2 hover-up">
                      <div class="card-head">
                        <div class="card-image">
                          <img :src="item.image" alt="PortailTN" />
                        </div>
                        <div class="card-title">
                          <h6>{{ item.title }}</h6>
                          <span class="job-type">{{ item.type }}</span>
                          <span class="time-post">{{ item.time }}</span>
                          <span class="location">{{ item.location }}</span>
                        </div>
                      </div>
                      <div class="card-tags">
                        <a v-for="tag in item.tags" :key="tag" class="btn btn-tag">{{ tag }}</a>
                      </div>
                      <div class="card-price">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="paginations">
                  <ul class="pager">
                    <li @click="prevPage" :class="{ disabled: currentPage === 1 }">
                      <a class="pager-prev" href="#"></a>
                    </li>
                    <li v-for="page in totalPages" :key="page" @click="setPage(page)">
                      <a :class="['pager-number', { active: currentPage === page }]" href="#">{{ page }}</a>
                    </li>
                    <li @click="nextPage" :class="{ disabled: currentPage === totalPages }">
                      <a class="pager-next" href="#"></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentPage: 1,
      itemsPerPage: 4,
      items: [
        { id: 1, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',  image: 'assets/dashboard/imgs/page/dashboard/img1.png', tags: ['Figma', 'Adobe XD'] },
        { id: 2, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img2.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 3, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img3.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 4, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img4.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 5, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img5.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 6, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img6.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 7, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img7.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 8, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img8.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 9, title: 'Senior Full Stack Engineer', type: 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img9.png', tags: ['Figma', 'Adobe XD', 'PSD'] },
        { id: 10, title: 'Senior Full Stack Engineer', type : 'Full time', time: "Posté il y'a x jours", location: 'Tunis, Tunisie',   image: 'assets/dashboard/imgs/page/dashboard/img10.png', tags: ['Figma', 'Adobe XD', 'PSD'] }
      ]
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.items.slice(start, start + this.itemsPerPage);
    }
  },
  methods: {
    setPage(page) {
      this.currentPage = page;
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  }
}
</script>

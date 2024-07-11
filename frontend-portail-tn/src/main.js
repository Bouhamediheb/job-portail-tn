import { createApp } from 'vue'
import App from './App.vue'
import router from './router'



import '../public/assets/js/vendor/modernizr-3.6.0.min.js';
import '../public/assets/js/vendor/jquery-3.6.0.min.js';
import '../public/assets/js/vendor/jquery-migrate-3.3.0.min.js';
import '../public/assets/js/vendor/bootstrap.bundle.min.js';
import '../public/assets/js/plugins/waypoints.js';
import '../public/assets/js/plugins/wow.js';
import '../public/assets/js/plugins/magnific-popup.js';
//import '../public/assets/js/plugins/perfect-scrollbar.min.js';
import '../public/assets/js/plugins/select2.min.js';
import '../public/assets/js/plugins/isotope.js';
import '../public/assets/js/plugins/scrollup.js';
import '../public/assets/js/plugins/swiper-bundle.min.js';
import '../public/assets/js/plugins/counterup.js';
import '../public/assets/js/main8c94.js';


createApp(App).use(router).mount('#app')

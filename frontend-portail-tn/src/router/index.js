import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '../views/SignInView.vue'
import SignUpView from '../views/SignUpView.vue'
import DashboardView from '../views/DashboardView.vue'
import JobDetailView from '../views/JobDetailView.vue'



const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path : '/signin',
    name : 'signin',
    component : SignInView
  },
  {
    path : '/signup',
    name : 'signup',
    component : SignUpView
  },
    {
    path : '/dashboard',
    name : 'dashboard',
    component : DashboardView
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '../views/SignInView.vue'
import SignUpView from '../views/SignUpView.vue'
import SignInAdminView from '../views/SignInAdminView.vue'

import DashboardView from '../views/DashboardView.vue'
import JobDetailView from '../views/JobDetailView.vue'
import JobListView from '../views/JobListView.vue'
import InternshipListView from '@/views/InternshipListView.vue'



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
    path : '/signin/admin',
    name : 'signinadmin',
    component : SignInAdminView
  },

  {
    path : '/signup',
    name : 'signup',
    component : SignUpView
  },
    {
    path : '/dashboard',
    name : 'dashboard',
    component : DashboardView,
    beforeEnter: (to, from, next) => {
      if (localStorage.getItem('islogged') === 'true') {
        next(); 
      } else {
        next('/signin');
      }
    }
  },
  {
    path: '/job/:id',
    name: 'JobDetail',
    component: JobDetailView,  
    props: true 

  },
  {
    path: '/jobs',
    name: 'JobList',
    component: JobListView
  },
  {
    path: '/internships',
    name: 'InternshipList',
    component: InternshipListView
  },
  
  

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

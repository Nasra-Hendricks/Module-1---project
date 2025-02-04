import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AttendanceView from '@/views/AttendanceView.vue'
import LoginView from '../views/LoginView.vue'
import PayRollView from '@/views/PayRollView.vue'
import EmployeeListView from '@/views/EmployeeListView.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/LoginView',
    name: '/LoginView',
    component: LoginView
  },
  {
    path: '/AttendanceView',
    name: '/AttendanceView',
    component: AttendanceView

  },
  {
    path: '/PayRollView',
    name: '/PayRollView',
    component: PayRollView
  },
  {
    path: '/EmployeeListView',
    name: '/EmployeeListView',
    component: EmployeeListView
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

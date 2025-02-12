import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AttendanceView from '@/views/AttendanceView.vue';
import LoginView from '../views/LoginView.vue';
import PayRollView from '@/views/PayRollView.vue';
import EmployeeListView from '@/views/EmployeeListView.vue';
const routes = [
  {
    path: '/',
    name: 'Loginview',
    component: LoginView,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/LoginView',
    name: 'LoginView',
    component: LoginView
  },
  {
    path: '/AttendanceView',
    name: 'AttendanceView',
    component: AttendanceView,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/PayRollView',
    name: 'PayRollView',
    component: PayRollView,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/EmployeeListView',
    name: 'EmployeeListView',
    component: EmployeeListView,
    meta: { requiresAuth: true } // Protect this route
  }
];
const router = createRouter({
  history: createWebHistory(),
  routes
});
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('userToken'); // Check if token exists
  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next('/LoginView'); // Redirect to login if not authenticated
  } else {
    next(); // Proceed normally
  }
});
export default router;
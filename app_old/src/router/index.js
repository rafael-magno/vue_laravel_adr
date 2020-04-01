import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/shifts',
    name: 'shifts',
    component: () => import('../views/ShiftForm.vue'),
  },
  /*{
    path: '/subjects',
    name: 'subjects',
    component: () => import('../views/Subjects.vue'),
  },
  {
    path: '/students',
    name: 'students',
    component: () => import('../views/Students.vue'),
  },*/
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;

import Vue from 'vue'
import Router from 'vue-router'
import store from '@/store'
import authRepository from '@/repositories/AuthRepository'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/auth/',
      beforeEnter: (to, from, next) => {
        store.dispatch('setToken', false)
        authRepository.logout()
          .then(() => {
            next()
          })
      },
      component: () => import('@/views/Auth/Index'),
      children: [
        {
          path: 'login',
          name: 'login',
          component: () => import('@/views/Auth/Login'),
        },
        {
          path: 'password-recovery',
          name: 'passwordRecovery',
          component: () => import('@/views/Auth/PasswordRecovery'),
        },
        {
          path: 'password-recovery-confirmation/:email',
          name: 'passwordRecoveryConfirmation',
          component: () => import('@/views/Auth/PasswordRecoveryConfirmation'),
        },
        {
          path: 'reset-password/:hash',
          name: 'resetPassword',
          component: () => import('@/views/Auth/ResetPassword'),
        },
      ],
    },
    {
      path: '/',
      component: () => import('@/views/Index'),
      beforeEnter: (to, from, next) => {
        store.getters.token ? next() : next('/auth/login')
      },
      children: [
        {
          name: 'Welcome',
          path: '',
          component: () => import('@/views/dashboard/Welcome'),
        },
        {
          name: 'shifts',
          path: 'shifts',
          component: () => import('@/views/Shifts/ShiftsList'),
        },
        {
          name: 'shiftsNew',
          path: 'shifts/new',
          component: () => import('@/views/Shifts/ShiftsForm'),
        },
        {
          name: 'shiftsEdit',
          path: 'shifts/edit/:id',
          component: () => import('@/views/Shifts/ShiftsForm'),
        },
        {
          name: 'subjects',
          path: 'subjects',
          component: () => import('@/views/Subjects/SubjectsList'),
        },
        {
          name: 'subjectsNew',
          path: 'subjects/new',
          component: () => import('@/views/Subjects/SubjectsForm'),
        },
        {
          name: 'subjectsEdit',
          path: 'subjects/edit/:id',
          component: () => import('@/views/Subjects/SubjectsForm'),
        },
        {
          name: 'students',
          path: 'students',
          component: () => import('@/views/Students/StudentsList'),
        },
        {
          name: 'studentsNew',
          path: 'students/new',
          component: () => import('@/views/Students/StudentsForm'),
        },
        {
          name: 'studentsEdit',
          path: 'students/edit/:id',
          component: () => import('@/views/Students/StudentsForm'),
        },
      ],
    },
  ],
})

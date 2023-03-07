import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Users',
      component: () => import('@/views/users/UsersTable.vue')
    },
    {
      path: '/create',
      name: 'CreateUser',
      component: () => import('@/views/users/CreateUser.vue')
    },
    {
      path: '/edit/:id',
      name: 'EditUser',
      component: () => import('@/views/users/EditUser.vue')
    },
    {
      path: '/show/:id',
      name: 'DetailUser',
      component: () => import('@/views/users/DetailUser.vue')
    },
  ]
})

export default router

import { createRouter, createWebHistory } from 'vue-router'
import Page_01 from '../components/includes/Page_01.vue'
import Page_02 from '../components/includes/Page_02.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
    {
      path: '/page_01',
      component: Page_01
    },
    {
      path: '/page_02',
      component: Page_02
    }
  ]
})

export default router

import Vue from 'vue'
import Router from 'vue-router'
import NotFound from '../views/NotFound.vue'
import Home from '../views/Home.vue'
import UsersIndex from '../views/UsersIndex.vue'
import UsersEdit from '../views/UsersEdit.vue'
import UsersCreate from '../views/UsersCreate.vue'
import Schedule from '../views/Schedule.vue'
import Login from '../views/front/Login.vue'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: [
    { path: '/404', name: '404', component: NotFound },
    { path: '*', redirect: '/404' },
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/users',
      name: 'users.index',
      component: UsersIndex,
    },
    {
      path: '/users/:id/edit',
      name: 'users.edit',
      component: UsersEdit,
    },
    {
      path: '/users/create',
      name: 'users.create',
      component: UsersCreate,
    },
    {
      path: '/schedule',
      name: 'schedule',
      component: Schedule,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        guest: true
      }
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(route => route.meta.requiresAuth)) {
    if (JSON.parse(localStorage.getItem('oauth')) === null) {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router
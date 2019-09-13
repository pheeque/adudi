
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. This also loads the Spark helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Spark. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */
// require('spark-bootstrap');

// require('./components/bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import NotFound from './views/NotFound.vue'
import App from './views/App.vue'
import Hello from './views/Hello.vue'
import Home from './views/Home.vue'
import UsersIndex from './views/UsersIndex.vue'
import UsersEdit from './views/UsersEdit.vue'
import UsersCreate from './views/UsersCreate.vue'
import Schedule from './views/Schedule.vue'

const router = new VueRouter({
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
            path: '/hello',
            name: 'hello',
            component: Hello,
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
        },
    ],
});

import Form from 'ant-design-vue/lib/form'
import 'ant-design-vue/lib/form/style/css'
import Input from 'ant-design-vue/lib/input'
import 'ant-design-vue/lib/input/style/css'
import Button from 'ant-design-vue/lib/button'
import 'ant-design-vue/lib/button/style/css'
import Icon from 'ant-design-vue/lib/icon'
import 'ant-design-vue/lib/icon/style/css'

Vue.use(Form)
Vue.use(Input)
Vue.use(Button)
Vue.use(Icon)

var app = new Vue({
    // mixins: [require('spark')],
    el: '#app',
    components: { App },
    router
});

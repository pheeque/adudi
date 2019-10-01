
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

import axios from 'axios'
window.axios = axios

import Vue from 'vue'
import router from './router/router'
import App from './views/App.vue'

import Form from 'ant-design-vue/lib/form'
import 'ant-design-vue/lib/form/style/css'
import Input from 'ant-design-vue/lib/input'
import 'ant-design-vue/lib/input/style/css'
import Button from 'ant-design-vue/lib/button'
import 'ant-design-vue/lib/button/style/css'
import Icon from 'ant-design-vue/lib/icon'
import 'ant-design-vue/lib/icon/style/css'
import Checkbox from 'ant-design-vue/lib/checkbox'
import 'ant-design-vue/lib/checkbox/style/css'
import Progress from 'ant-design-vue/lib/progress'
import 'ant-design-vue/lib/progress/style/css'

Vue.use(Form)
Vue.use(Input)
Vue.use(Button)
Vue.use(Icon)
Vue.use(Checkbox)
Vue.use(Progress)

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'b3e60ed2861d3aa4d03f',
    cluster: 'ap1',
    encrypted: true
});

var app = new Vue({
    // mixins: [require('spark')],
    el: '#app',
    components: { App },
    router
});

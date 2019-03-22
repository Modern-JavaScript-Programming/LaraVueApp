/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Import Moment.js for Date Time filter
import moment from 'moment'

// Import vform
import { Form, HasError, AlertError } from 'vform'

// Import Vue Router
import VueRouter from 'vue-router'

// Vue Progressbar
import VueProgressBar from 'vue-progressbar'

// Sweet Alert
import swal from 'sweetalert2'
window.swal = swal

// Import vue-select
// eslint-disable-next-line import/first
import VueSelect from 'vue-select'

require('./bootstrap')

window.Vue = require('vue')

window.Form = Form

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('v-select', VueSelect)

// View Pagination
Vue.component('pagination', require('laravel-vue-pagination'))

Vue.use(VueRouter)

let routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  { path: '/engagements', component: require('./components/Engagements.vue').default },
  { path: '/engagement_user', component: require('./components/EngagementUser.vue').default },
  { path: '/users', component: require('./components/Users.vue').default },
  { path: '/profile', component: require('./components/Profile.vue').default },
  { path: '/testing', component: require('./components/Testing.vue').default }
]

const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

// Filter
Vue.filter('upText', function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1)
})

Vue.filter('myDate', function (created) {
  return moment(created).format('MMMM Do YYYY')
})

// Vue Progressbar
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

// SweetAlert Notification
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})

window.toast = toast

// Create a New Vue component
window.Fire = new Vue()
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.,
 */

const app = new Vue({
  el: '#app',
  router,
  data: {
    search: ''
  },
  methods: {
    searchit: _.debounce(() => {
      Fire.$emit('searching')
    }, 1000)
  }
})

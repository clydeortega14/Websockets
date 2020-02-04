
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.BootstrapVue = require('bootstrap-vue');

import store from './store';
import localforage from './libraries/localforage';
import router from './router';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);

window.localforage = localforage


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('navbar-component', require('./components/app/NavbarComponent.vue').default);
Vue.component('login-component', require('./components/app/LoginComponent.vue').default);
Vue.component('show-post', require('./components/posts/ShowPost.vue').default);
Vue.component('user-component', require('./components/users/User.vue').default);
Vue.component('user-table', require('./components/users/UserTable.vue').default);
Vue.component('add-user', require('./components/users/AddUser.vue').default);
Vue.component('edit-user', require('./components/users/EditUser.vue').default);

const app = new Vue({
    el: '#app',
    store,
    router
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './Router/router'
import App from './App.vue'
Vue.component('app' , require('./App.vue').default)

// window.Vue = require('vue').default;

Vue.use(VueRouter);

new Vue({
    el: "#app",
    router,
    commponents: {App}
})




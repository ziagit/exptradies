/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { ENV } from "./environment";

window.Vue = require("vue");

import router from "./routes.js";

import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "vue-phone-number-input/dist/vue-phone-number-input.css";

Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

require("./bootstrap");
require("./store/subscriber");

Vue.component("pagination", require("laravel-vue-pagination"));
// Make BootstrapVue available throughout your project
import store from "./store";

import axios from "axios";

axios.defaults.baseURL = ENV.baseUrl;
//axios.defaults.baseURL = 'http://localhost:8000/api/';
//axios.defaults.baseURL = 'http://31.220.48.103/api/';
//axios.defaults.baseURL = 'https://exptradies.com/api/';

Vue.component("app-component", require("./components/App.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {
    const app = new Vue({
        el: "#app",
        router,
        store
    });
});

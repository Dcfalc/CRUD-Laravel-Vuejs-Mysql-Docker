import Vue from 'vue'
import App from './App.vue'

import VueRouter from 'vue-router';
import { routes } from './routes';

import { BootstrapVue } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';

import "./vee-validate";

Vue.use(VueToast);
Vue.use(VueRouter);
Vue.use(BootstrapVue)

const router = new VueRouter({ 
  routes, 
  mode: 'history'
});

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
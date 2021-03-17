import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import Vuelidate from "vuelidate";
import VueEllipseProgress from 'vue-ellipse-progress';
import moment from 'moment'

Vue.use(VueEllipseProgress);
Vue.prototype.moment = moment


Vue.config.productionTip = true;
Vue.use(Vuelidate);

//eslint disable ok

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");



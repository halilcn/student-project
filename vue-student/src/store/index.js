import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import {Auth} from "./modules/Auth";
import {Target} from "./modules/Target";
import {Setting} from "@/store/modules/Setting";
import {LastTarget} from "@/store/modules/LastTarget";
import {UserRate} from "@/store/modules/UserRate";
import {UserProfileRate} from "@/store/modules/UserProfileRate";


Vue.use(Vuex);

axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/";
axios.defaults.headers.Accept = "application/json";

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
    Auth,
    Target,
    Setting,
    LastTarget,
    UserRate,
    UserProfileRate
  }
});

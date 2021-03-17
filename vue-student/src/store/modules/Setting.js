import axios from "axios";
import {Auth} from "@/store/modules/Auth";

export const Setting = {
  state: {},
  mutations: {
    updateAuthUser(commit, payload) {
      const userData = {
        email: this.state.Auth.user.email,
        image: payload.image,
        name: payload.name
      };
      this.commit('setUser', userData);
    }
  },
  actions: {
    updateUser({commit}, payload) {
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
      return axios.post('user/profile', payload, config)
        .then(res => {
          commit('updateAuthUser', {
            name: res.data.name,
            image: res.data.image
          });
        });
    },
    updatePassword(_, payload) {
      return axios.post('user/password', payload);
    }
  },
  getters: {}
};

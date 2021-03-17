import axios from "axios";

export const UserProfileRate = {
  state: {
    user: null,
    lastTargets: null,
    activeTargets: null
  },
  mutations: {
    setProfile(state, payload) {
      state.user = payload;
    },
    setActiveTargets(state, payload) {
      state.activeTargets = payload;
    },
    setLastTargets(state, payload) {
      state.lastTargets = payload;
    },
    restartState(state) {
      state.user = null;
      state.lastTargets = null;
      state.activeTargets = null;
    }
  },
  actions: {
    getActiveTargets({commit}, payload) {
      return axios.get(`users-rates/${payload}/activeTargets`)
        .then(res => {
          commit('setActiveTargets', res.data.data);
        });
    },
    getLastTargets({commit}, payload) {
      return axios.get(`users-rates/${payload}/lastTargets`)
        .then(res => {
          commit('setLastTargets', res.data.data);
        });
    },
    getProfile({commit}, payload) {
      return axios.get(`users-rates/${payload}/profile`)
        .then(res => {
          commit('setProfile', res.data.data);
        });
    }
  },
  getters: {}
};

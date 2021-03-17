import axios from "axios";

export const LastTarget = {
  state: {
    lastTargets: []
  },
  mutations: {
    setLastTargets(state, payload) {
      state.lastTargets = payload;
    }
  },
  actions: {
    getLastTargets({commit}) {
      axios.get('last-targets')
        .then(res => {
          commit('setLastTargets', res.data.data);
        });
    }
  },
  getters: {}
};

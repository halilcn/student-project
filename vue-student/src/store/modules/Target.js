import axios from "axios";

export const Target = {
  state: {
    targets: [],
    targetsCount: null,
    hasTarget: true
  },
  mutations: {
    setTarget(state, payload) {
      payload.map(function (value, key) {
        state.targets.push(value);
      });
    },
    addTarget(state, payload) {
      state.targets.unshift(payload);
    },
    removeTarget(state, payload) {
      state.targets.splice(state.targets.findIndex((target) => target.id === payload), 1);
    },
    updateTargetsCount(state, payload) {
      state.targetsCount += payload;
      this.commit('changeHasTarget', payload);
    },
    changeHasTarget(state, payload) {
      state.hasTarget = payload === 7 ?? false;
    },
    resetState(state) {
      state.targets = [];
      state.targetsCount = null;
    }
  },
  actions: {
    postTarget({commit}, payload) {
      return axios.post('targets', payload)
        .then(res => {
          commit("addTarget", res.data.data);
        });
    },
    getTargets({commit}) {
      return axios.get('targets')
        .then(res => {
          commit('resetState');
          commit("setTarget", res.data.data);
          commit('updateTargetsCount', res.data.data.length);
        });
    },
    getMoreTargets({state, commit}) {
      return axios.get(`targets?targetsCount=${state.targetsCount}`)
        .then(res => {
          commit("setTarget", res.data.data);
          commit('updateTargetsCount', res.data.data.length);
        });
    },
    deleteTarget({commit, state}, payload) {
      axios.delete(`targets/${payload}`)
        .then(res => {
          commit('removeTarget', payload);
        })
    },
    postTargetRate({commit}, payload) {
      return axios.post('last-targets', payload)
        .then(res => {
          commit('removeTarget', payload.targetId);
        });
    }
  },
  getters: {},
};

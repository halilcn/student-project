import axios from "axios";

export const UserRate = {
  state: {
    users: [],
    usersSkipCount: 0,
    hasUsers: true
  },
  mutations: {
    setUsersRates(state, payload) {
      payload.forEach(function (user) {
        state.users.push(user);
      });
    },
    setUsersCount(state, payload) {
      state.usersSkipCount += payload;
    },
    checkUsers(state, payload) {
      state.hasUsers = payload >= 5 ?? false;
    },
    restartState(state) {
      state.users = [];
      state.usersSkipCount = 0;
      state.hasUsers = true;
    }
  },
  actions: {
    getUsersRates({commit, state}, payload) {
      axios.get(`users-rates?listType=${payload}&usersSkipCount=${state.usersSkipCount}`)
        .then(res => {
          commit('setUsersRates', res.data.data);
          commit('setUsersCount', res.data.data.length);
          commit('checkUsers', res.data.data.length);
        })
    },
  },
  getters: {}
};

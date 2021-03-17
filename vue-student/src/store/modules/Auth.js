import axios from "axios";

export const Auth = {
  state: {
    token: null,
    user: null,
  },
  mutations: {
    setToken(state, payload) {
      payload.expires_in = new Date().getTime() + payload.expires_in;
      state.token = payload;
      localStorage.setItem("token", JSON.stringify(payload));
      this.commit('setAxiosAuthorization');
    },
    setUser(state, payload) {
      state.user = payload;
      localStorage.setItem("user", JSON.stringify(payload));
    },
    setState(state) {
      var token = JSON.parse(localStorage.getItem('token'));
      if (!token) {
        state.token = null;
        state.user = null;
        return 0;
      }

      state.token = token;
      state.user = JSON.parse(localStorage.getItem('user'));
      this.commit('setAxiosAuthorization');

      if (token.expires_in < new Date().getTime()) {
        this.dispatch('tokenRefresh')
          .catch(res => {
            state.token = null;
            state.user = null;
          });
        return 0;
      }

    },
    deleteState(state) {
      localStorage.removeItem("token");
      localStorage.removeItem("user");

      state.token = null;
      state.user = null;
    },
    setAxiosAuthorization(state) {
      axios.defaults.headers.Authorization = `Bearer ${state.token.access_token}`;
    }
  },
  actions: {
    async loginPost({commit, dispatch}, payload) {
      try {
        await dispatch('tokenGet', {
          username: payload.email,
          password: payload.password
        });
        await dispatch('userGet');
        return true;
      } catch ($e) {
        return false;
      }
    },
    async registerPost({dispatch, commit}, payload) {
      try {
        await axios.post('register', payload)
          .then(res => {
            commit('setUser', res.data.data);
          });
        await dispatch('tokenGet', {
          username: payload.email,
          password: payload.password
        });
        return true;
      } catch ($e) {
        return false;
      }
    },
    tokenGet({state, commit}, payload) {
      return axios.post('oauth/token', {
        grant_type: 'password',
        client_id: '4',
        client_secret: 'TP1mwghN6HTxofK4IhBERlPClKFdWKXBrsL0F0Kt',
        username: payload.username,
        password: payload.password,
        scope: '*'
      })
        .then(res => {
          commit('setToken', res.data);
          return res;
        })
        .catch(res => {
          return res;
        });
    },
    tokenRefresh({state, commit}) {
      return axios.post('oauth/token', {
        grant_type: 'refresh_token',
        refresh_token: state.token.refresh_token,
        client_id: '4',
        client_secret: 'TP1mwghN6HTxofK4IhBERlPClKFdWKXBrsL0F0Kt',
        scope: '*'
      })
        .then(res => {
          commit('setToken', res.data);
        });
    },
    userGet({commit, state}) {
      return axios.get('user', {
        headers: {
          Authorization: `Bearer ${state.token.access_token}`
        }
      })
        .then(res => {
          commit('setUser', res.data.data);
        });
    },
    async logout({commit}) {
      return await axios.post('logout')
        .then(res => {
          commit('deleteState');
        });
    }
  },
  getters: {
    checkToken(state) {
      return state.token !== null;
    },
  }
};


import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    user: null,
    token: localStorage.getItem('token') || null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TOKEN(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
    },
    LOGOUT(state) {
      state.user = null;
      state.token = null;
      localStorage.removeItem('token');
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('api/login', credentials);
        commit('SET_USER', response.data.user);
        commit('SET_TOKEN', response.data.token);
        return response;
      } catch (error) {
        throw error;
      }
    },
    async register({ commit }, userData) {
      try {
        await axios.post('api/register', userData);
      } catch (error) {
        throw error;
      }
    },
    async fetchUser({ commit, state }) {
      if (!state.token) return;
      try {
        const response = await axios.get('api/user', {
          headers: { Authorization: `Bearer ${state.token}` },
        });
        commit('SET_USER', response.data);
      } catch (error) {
        commit('LOGOUT');
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('api/logout', null, {
          headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
        });
        commit('LOGOUT');
      } catch (error) {
        throw error;
      }
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
    getUser: (state) => state.user,
  },
});


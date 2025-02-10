import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    isAuthenticated: false,
    user: null
  },
  mutations: {
    login(state, user) {
      state.isAuthenticated = true;
      state.user = user;
    },
    logout(state) {
      state.isAuthenticated = false;
      state.user = null;
    }
  },
  actions: {
    async login({ commit }, { username, password }) {
      try {
        const response = await axios.post('http://localhost:3000/auth', {
          username,
          password
        });
        const token = response.data.token;
        localStorage.setItem('token', token);
        commit('login', { username });
      } catch (error) {
        console.error('Login failed:', error);
        alert('Login failed!');
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('http://localhost:3000/logout');
        localStorage.removeItem('token');
        commit('logout');
        alert('Logout successful!');
      } catch (error) {
        console.error('Logout failed:', error);
        alert('Logout failed!');
      }
    }
  },
  getters: {
    isAuthenticated: state => state.isAuthenticated,
    user: state => state.user
  }
});










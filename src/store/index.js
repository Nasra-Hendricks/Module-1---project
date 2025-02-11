import { createStore } from 'vuex';
export default createStore({
  state: {
    user: null
  },
  getters: {
    isAuthenticated: state => !!state.user
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    logout(state) {
      state.user = null;
    }
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await fetch('http://localhost/griffith/src/php/login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(credentials)
        });
        const data = await response.json();
        if (data.success) {
          commit('setUser', credentials.username);
          localStorage.setItem('user', credentials.username);
        } else {
          throw new Error(data.message);
        }
      } catch (error) {
        console.error("Login failed:", error.message);
        throw error;
      }
    },
    logout({ commit }) {
      commit('logout');
      localStorage.removeItem('user');
    }
  }
});







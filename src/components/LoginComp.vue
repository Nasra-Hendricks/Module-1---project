<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="handleLogin">
      <div class="register">
        <label for="username">Username</label>
        <input type="text" id="username" v-model="username" class="form-control" required>
      </div>
      <br>
      <div class="register">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="password" class="form-control" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <div v-if="showError" class="alert alert-danger">
      Invalid credentials. Please try again.
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      username: '',
      password: '',
      showError: false
    };
  },
  methods: {
    ...mapActions(['login']),
    async handleLogin() {
      try {
        // Call the Vuex login action
        await this.login({ username: this.username, password: this.password });
        // Check if the user is authenticated
        if (this.$store.getters.isAuthenticated) {
          this.$router.push('/');
        } else {
          this.showError = true;
        }
      } catch (error) {
        this.showError = true;
      }
    }
  }
};
</script>










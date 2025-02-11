<template>
  <div class="login-form">
    <h2>Login</h2>
    <form @submit.prevent="handleLogin">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" placeholder="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" placeholder="password" required>
      </div>
      <button type="submit">Login</button>
      <p v-if="showError" class="error-message">{{ errorMessage }}</p>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      showError: false,
      errorMessage: ''
    };
  },
  methods: {
    async handleLogin() {
      try {
        const response = await fetch('http://localhost/your-project-folder/php/login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username: this.username, password: this.password })
        });
        const data = await response.json();
        if (data.success) {
          localStorage.setItem('userToken', 'logged_in');
          this.$router.push('/');
        } else {
          this.showError = true;
          this.errorMessage = data.message;
        }
      } catch (error) {
        this.showError = true;
        this.errorMessage = 'An error occurred';
      }
    }
  }
};
</script>
<style scoped>
.login-form {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 300px;
  text-align: center;
}
.input-group {
  margin: 10px 0;
}
input {
  width: 100%;
  padding: 8px;
}
button {
  background: #007BFF;
  color: white;
  padding: 10px;
  border: none;
  cursor: pointer;
  width: 100%;
}
.error-message {
  color: red;
  margin-top: 10px;
}
</style>
<template>
  <div class="login-container">
    <div class="floating-shape shape1"></div>
    <div class="floating-shape shape2"></div>
    <div class="login-box">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" v-model="username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
        <p v-if="showError" class="error-message">{{ errorMessage }}</p>
      </form>
    </div>
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
        const response = await fetch('http://localhost/griffith/src/php/login.php', {
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

form {
  display:block !important;
}

/* display layout in the middel of page */

body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }
/* :fire: Background and Layout */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(135deg, #1E3C72, #2A5298);
  position: relative;
  overflow: hidden;
}
/* :star2: Glassmorphism Login Box */
.login-box {
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 40px;
  width: 380px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}
.login-box:hover {
  transform: scale(1.05) rotateX(5deg) rotateY(5deg);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
}
/* :lower_left_ballpoint_pen: Input Groups */
.input-group {
  margin-bottom: 20px;
  text-align: left;
}
label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
  color: white;
}
input {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.2);
  color: white;
  font-size: 18px;
  outline: none;
  transition: all 0.3s ease-in-out;
}
input:focus {
  background: rgba(255, 255, 255, 0.3);
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
  transform: scale(1.05);
}
/* :rocket: Button */
.login-btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: linear-gradient(45deg, #FF6B6B, #FFB88C);
  color: white;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
}
.login-btn:hover {
  background: linear-gradient(45deg, #FFB88C, #FF6B6B);
  transform: scale(1.1);
  box-shadow: 0 8px 20px rgba(255, 107, 107, 0.6);
}
/* :x: Error Message */
.error-message {
  color: red;
  font-weight: bold;
  margin-top: 10px;
}
/* :performing_arts: Floating 3D Shapes */
.floating-shape {
  position: absolute;
  width: 200px;
  height: 200px;
  background: linear-gradient(135deg, #FF6B6B, #FFB88C);
  border-radius: 50%;
  opacity: 0.5;
  animation: float 6s infinite ease-in-out;
  display: flex;
  
}
.shape1 {
  top: 10%;
  left: 15%;
  animation-delay: 0s;
}
.shape2 {
  bottom: 10%;
  right: 15%;
  animation-delay: 2s;
}
@keyframes float {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
  }
  50% {
    transform: translateY(-20px) rotate(15deg);
  }
}
</style>







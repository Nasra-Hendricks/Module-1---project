<template>
  <div class="login-container">
    <div class="floating-shape shape1"></div>
    <div class="floating-shape shape2"></div>
    <div class="floating-shape shape3"></div>

    <div class="login-form">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="input-group">
          <label for="username">Username:</label>
          <input 
            type="text" 
            id="username" 
            v-model="username" 
            placeholder="Enter your username" 
            required 
          />
        </div>
        <div class="input-group">
          <label for="password">Password:</label>
          <input 
            type="password" 
            id="password" 
            v-model="password" 
            placeholder="Enter your password" 
            required 
          />
        </div>
        <button type="submit" :disabled="loading">
          {{ loading ? "Logging in..." : "Login" }}
        </button>
        <p v-if="showError" class="error-message">{{ errorMessage }}</p>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      password: "",
      loading: false,
      showError: false,
      errorMessage: "",
    };
  },
  methods: {
    async handleLogin() {
      this.loading = true;
      this.showError = false;

      try {
        const response = await fetch("http://localhost/griffith/src/php/login.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ username: this.username, password: this.password }),
        });

        const data = await response.json();
        if (data.success) {
          localStorage.setItem("userToken", "logged_in");
          this.$router.push("/home");
        } else {
          this.showError = true;
          this.errorMessage = data.message;
        }
      } catch (error) {
        console.error(error);
        this.showError = true;
        this.errorMessage = "An error occurred. Please try again.";
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Background styling */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(135deg, #1E3C72, #2A5298);
  position: relative;
  overflow: hidden;
}

/* Floating shapes */
.floating-shape {
  position: absolute;
  width: 150px;
  height: 150px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  opacity: 0.4;
  animation: float 6s infinite ease-in-out;
}
.shape1 { top: 10%; left: 15%; animation-delay: 0s; }
.shape2 { bottom: 15%; right: 10%; animation-delay: 2s; }
.shape3 { top: 50%; left: 50%; width: 200px; height: 200px; animation-delay: 4s; }

@keyframes float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(15deg); }
}

/* Login form */
.login-form {
  background: rgba(255, 255, 255, 0.9);
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  width: 350px;
  text-align: center;
  backdrop-filter: blur(10px);
}

/* Input fields */
.input-group {
  margin-bottom: 20px;
  text-align: left;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
  color: #333;
}

input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

/* Button */
button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  background: linear-gradient(45deg, #736bef, #08b8b5);
  color: white;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
}

button:hover {
  background: linear-gradient(45deg, #736bef, #08b8b5);
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(1, 76, 17, 0.6);
}

button:disabled {
  background: #bbb;
  cursor: not-allowed;
}

/* Error message */
.error-message {
  color: red;
  font-weight: bold;
  margin-top: 10px;
}
</style>

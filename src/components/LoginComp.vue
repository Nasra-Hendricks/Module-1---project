<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="validateLogin">
      <div class="register">
        <label for="username">Username</label>
        <input type="text" id="username" v-model="username" class="form-control">
      </div>
      <br>
      <div class="register">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="password" class="form-control">
      </div>
      <button @click="signUp = !signUp">{{signUp? 'SignUp': 'Login' }}</button>
      <signup-comp v-if="signUp"/>
      <signup-comp v-else/>
    </form>
    <div v-if="showError" class="alert alert-danger">
      Invalid credentials. Please try again.
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      username: '',
      password: '',
      showError: false
    };
  },
  methods: {
    validateLogin() {
      if (this.username === 'admin' && this.password === 'password123') {
        window.location.href = 'index.html';
      } else {
        this.showError = true;
      }
    }
  }
};
</script>
<style>
.logo{
  width: 250px;
}
.register input{
  width: 200px;
  height: 40px;
  padding-left: 20px;
  display:block;
  margin-bottom: 30px;
  margin-right: auto;
  margin-left: auto;
  border:1px solid rgb(44, 167, 116);
}
.register button{
  width: 200px;
  height: 40px;
  border: 1px soild rgb(37, 151, 157);
  background: rgb(28, 177, 157);
  color: #fff;
  cursor: pointer;
}
img, video {
  max-width: 100%;
  height: auto;
}
.flex-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.flex-item {
  flex: 1 1 100%;
  margin: 10px;
}

@media (min-width: 768px) {
  .flex-item {
    flex: 1 1 48%;
  }
}

@media (min-width: 992px) {
  .flex-item {
    flex: 1 1 31%;
  }
}
/* Base styles for all devices */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  width: 100%;
  padding: 20px;
  box-sizing: border-box;
}

.header, .footer {
  background-color: #343a40;
  color: white;
  text-align: center;
  padding: 10px 0;
}

.content {
  padding: 20px;
}

/* Styles for tablets and larger screens */
@media (min-width: 768px) {
  .container {
    max-width: 750px;
    margin: 0 auto;
  }
}

/* Styles for laptops and larger screens */
@media (min-width: 992px) {
  .container {
    max-width: 970px;
  }
}

/* Styles for desktops and larger screens */
@media (min-width: 1200px) {
  .container {
    max-width: 1170px;
  }
}

</style>
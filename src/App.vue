<template>
  <div id="app">
    <nav class="navbar">
      <div class="navbar-container">
        <div class="navbar-brand">
          <!-- Optional: Add your brand name here -->
          <a href="/">ModernTech Solutions</a>
        </div>
        <button class="navbar-toggle" @click="toggleMenu">
          &#9776;
        </button>
        <div :class="['navbar-links', { 'navbar-open': isMenuOpen }]">
          <router-link to="/" class="nav-link">Home</router-link>
          <router-link to="/EmployeeListView" class="nav-link">Employee List</router-link>
          <router-link to="/AttendanceView" class="nav-link">Attendance</router-link>
          <router-link to="/PayRollView" class="nav-link">Payroll</router-link>
          <router-link to="/LoginView" class="nav-link">Login</router-link>
        </div>
      </div>
    </nav>
    <router-view/>
  </div>
</template>
<script>
export default {
  name: 'App',
  data() {
    return {
      isMenuOpen: false
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    }
  }
}
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2C3E50;
}
.navbar {
  background: linear-gradient(90deg, #1D5ACC, #42B983);
  color: white;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between; /* Changed from center to space-between for better layout */
  align-items: center;
  position: relative;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  margin-bottom: 20px;
  animation: fadeIn 2s ease-in-out;
}
.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}
.navbar-brand {
  font-size: 1.5rem;
  font-weight: bold;
  color: #42B983;
  text-decoration: none;
  margin-right: auto;
}
.navbar-links {
  display: flex;
  gap: 15px;
}
.nav-link {
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s;
}
.nav-link:hover {
  color: #1D5ACC;
}
.navbar-toggle {
  display: none;
  font-size: 2rem;
  background: none;
  border: none;
  color: white;
  cursor: pointer;
}
@media (max-width: 768px) {
  .navbar-links {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 50px;
    left: 0;
    width: 100%;
    background-color: #1A1A1A;
    padding: 10px 0;
  }
  .navbar-links.navbar-open {
    display: flex;
  }
  .navbar-toggle {
    display: block;
  }
  /* Adjust the navbar items when the menu is open */
  .navbar-links .nav-link {
    padding: 10px;
    text-align: center;
  }
}
/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
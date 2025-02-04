<template>
  <div id="app">
    <nav class="navbar">
      <div class="navbar-container">
        <div class="navbar-links">
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
  color: #2c3e50;
}

.navbar {
  background: linear-gradient(90deg, #1d5acc, #42b983);
  color: white;
  padding: 10px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  margin-bottom: 20px;
  animation: fadeIn 2s ease-in-out;
}

.navbar-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: bold;
  color: #42b983;
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
  color: #1d5acc;
}

.navbar-toggle {
  display: none;
  font-size: 1.5rem;
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
    background-color: #1a1a1a;
    padding: 10px 0;
  }

  .navbar-links.navbar-open {
    display: flex;
  }

  .navbar-toggle {
    display: block;
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


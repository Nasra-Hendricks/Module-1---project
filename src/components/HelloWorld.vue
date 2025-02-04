<template>
  <div class="hello">
    <header>
      <h1>ModernTech HR Dashboard</h1>
    </header>
    <div class="message-box">
      <h3>Message Employees</h3>
      <textarea v-model="message" placeholder="Type your message here..."></textarea>
      <button @click="sendMessage">Send</button>
    </div>
    <p>
      Have a pleasant day!!!
    </p>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data() {
    return {
      message: ''
    };
  },
  methods: {
    sendMessage() {
      if (this.message.trim()) {
        alert(`Message sent: ${this.message}`);
        this.message = '';
      } else {
        alert('Please enter a message before sending.');
      }
    }
  }
}
</script>

<style scoped>
/* Header Styling */
header {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
  background: linear-gradient(90deg, #1d5acc, #42b983);
  color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  margin-bottom: 20px;
}

header h1 {
  font-size: 2rem;
  animation: fadeIn 2s ease-in-out;
}

/* Message Box Styling */
.message-box {
  margin: 20px 0;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  animation: slideIn 1s ease-in-out;
}

textarea {
  width: 100%;
  height: 100px;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

button:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

/* Paragraph Styling */
p {
  font-size: 1.2rem;
  color: #343a40;
  animation: fadeIn 2s ease-in-out;
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

@keyframes slideIn {
  from {
    transform: translateY(20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Additional Styling */
h3 {
  margin: 40px 0 0;
  color: #1d5acc;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #1d5acc;
  text-decoration: none;
  transition: color 0.3s;
}

a:hover {
  color: #42b983;
}
</style>

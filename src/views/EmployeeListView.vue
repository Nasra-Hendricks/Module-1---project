<template>
  <div class="container mt-4">
    <h2 class="text-center mb-4">Employee List</h2>
    <!-- Add Employee Button -->
    <div class="text-center mb-3">
      <button class="btn btn-primary" @click="toggleForm">Add Employee</button>
    </div>
    <!-- Add Employee Form (Conditional Rendering) -->
    <div v-if="showForm">
      <form @submit.prevent="submitEmployee">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            id="name"
            v-model="newEmployee.name"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="position" class="form-label">Position</label>
          <input
            type="text"
            id="position"
            v-model="newEmployee.position"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="department" class="form-label">Department</label>
          <input
            type="text"
            id="department"
            v-model="newEmployee.department"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="salary" class="form-label">Salary</label>
          <input
            type="text"
            id="salary"
            v-model="newEmployee.salary"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="employmentHistory" class="form-label">Employment History</label>
          <input
            type="text"
            id="employmentHistory"
            v-model="newEmployee.employmentHistory"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">Contact</label>
          <input
            type="email"
            id="contact"
            v-model="newEmployee.contact"
            class="form-control"
            required
          />
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" @click="toggleForm">
          Cancel
        </button>
      </form>
    </div>
    <!-- Bootstrap Table -->
    <table class="table table-striped mt-4">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Department</th>
          <th>Salary</th>
          <th>Employment History</th>
          <th>Contact</th>
          <th>Performance Score</th>
          <th>Actions</th>
          <!-- Action buttons column -->
        </tr>
      </thead>
      <tbody>
        <!-- Loop through employee data and display each row -->
        <tr v-for="employee in employeeInformation" :key="employee.employeeId">
          <td>{{ employee.name }}</td>
          <td>{{ employee.position }}</td>
          <td>{{ employee.department }}</td>
          <td>{{ employee.salary }}</td>
          <td>{{ employee.employmentHistory }}</td>
          <td>{{ employee.contact }}</td>
          <td>{{ employee.performanceScore }}</td>
          <td>
            <!-- Delete Button -->
            <button
              class="btn btn-danger btn-sm"
              @click="deleteEmployee(employee.employeeId)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
// Import the JSON data (You can also load it via an API or dynamic import)
import employeeData from "../assets/employees.json";

export default {
  data() {
    return {
      employeeInformation: employeeData.employeeInformation.map(employee => ({
        ...employee,
        performanceScore: this.getRandomPerformanceScore()
      })),
      showForm: false,
      newEmployee: {
        name: "",
        position: "",
        department: "",
        salary: "",
        employmentHistory: "",
        contact: "",
        performanceScore: this.getRandomPerformanceScore()
      },
    };
  },
  methods: {
    // Toggle visibility of the form
    toggleForm() {
      this.showForm = !this.showForm;
    },
    // Submit new employee data
    submitEmployee() {
      const newEmployee = {
        employeeId: this.employeeInformation.length + 1,
        name: this.newEmployee.name,
        position: this.newEmployee.position,
        department: this.newEmployee.department,
        salary: this.newEmployee.salary,
        employmentHistory: this.newEmployee.employmentHistory,
        contact: this.newEmployee.contact,
        performanceScore: this.newEmployee.performanceScore
      };
      this.employeeInformation.push(newEmployee);
      this.newEmployee = {
        name: "",
        position: "",
        department: "",
        salary: "",
        employmentHistory: "",
        contact: "",
        performanceScore: this.getRandomPerformanceScore()
      }; // Reset the form
      this.showForm = false; // Hide the form after submission
    },
    // Delete an employee by ID
    deleteEmployee(employeeId) {
      this.employeeInformation = this.employeeInformation.filter(
        (employee) => employee.employeeId !== employeeId
      );
    },
    // Get a random performance score
    getRandomPerformanceScore() {
      const scores = ["Good", "Moderate", "Bad"];
      return scores[Math.floor(Math.random() * scores.length)];
    }
  },
};
</script>

<style scoped>
/* Optional custom styles for the table */
table {
  width: 100%;
  margin-top: 20px;
}
th,
td {
  text-align: center;
}
th {
  background-color: #F8F9FA;
}
button {
  margin-top: 5px;
}
form {
  margin-top: 20px;
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
img, video {
  max-width: 100%;
  height: auto;
}

</style>

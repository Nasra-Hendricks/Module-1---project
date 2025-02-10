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
          <input type="text" id="name" v-model="newEmployee.name" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="position" class="form-label">Position</label>
          <input type="text" id="position" v-model="newEmployee.position" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="department" class="form-label">Department</label>
          <input type="text" id="department" v-model="newEmployee.department" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="salary" class="form-label">Salary</label>
          <input type="text" id="salary" v-model="newEmployee.salary" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="employmentHistory" class="form-label">Employment History</label>
          <input type="text" id="employmentHistory" v-model="newEmployee.employmentHistory" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">Contact</label>
          <input type="email" id="contact" v-model="newEmployee.contact" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" @click="toggleForm">Cancel</button>
      </form>
    </div>

    <!-- Employee Table -->
    <table class="table table-striped mt-4">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Position</th>
          <th>Department</th>
          <th>Salary</th>
          <th>Employment History</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employeeInformation" :key="employee.employee_id">
          <td>{{ employee.name }}</td>
          <td>{{ employee.email }}</td>
          <td>{{ employee.position }}</td>
          <td>{{ employee.department }}</td>
          <td>{{ employee.position_salary }}</td>
          <td>{{ employee.employment_history.details }} ({{ employee.employment_history.start_date }})</td>
          <td>
            <button class="btn btn-danger btn-sm" @click="deleteEmployee(employee.employee_id)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      employeeInformation: [],
      showForm: false,
      newEmployee: {
        name: "",
        position: "",
        department: "",
        salary: "",
        employmentHistory: "",
        email: "",
        performanceScore: this.getRandomPerformanceScore(),
      },
    };
  },
  mounted() {
    this.fetchEmployees();
  },
  methods: {
    // Toggle visibility of the form
    toggleForm() {
      this.showForm = !this.showForm;
    },

    // Fetch employee data from the API
    async fetchEmployees() {
      try {
        const response = await axios.get("http://localhost/griffith/src/php/get_employees.php");
        this.employeeInformation = response.data;
      } catch (error) {
        console.error("Error fetching employee data:", error);
        alert("Failed to load employee data.");
      }
    },

    // Submit a new employee
    async submitEmployee() {
      try {
        const response = await axios.post("http://localhost/api/employees.php", this.newEmployee);
        this.employeeInformation.push(response.data);
        this.newEmployee = {
          name: "",
          position: "",
          department: "",
          salary: "",
          employmentHistory: "",
          contact: "",
          performanceScore: this.getRandomPerformanceScore(),
        }; // Reset the form
        this.showForm = false; // Hide the form after submission
      } catch (error) {
        console.error("Error submitting employee:", error);
        alert("Failed to add employee.");
      }
    },

   
    // Delete an employee
    async deleteEmployee(employeeId) {
      try {
        await axios.delete(`http://localhost/api/employees.php?id=${employeeId}`);
        this.employeeInformation = this.employeeInformation.filter(
          (employee) => employee.employee_id !== employeeId
        );
      } catch (error) {
        console.error("Error deleting employee:", error);
        alert("Failed to delete employee.");
      }
    },

    // Get a random performance score
    getRandomPerformanceScore() {
      const scores = ["Good", "Moderate", "Bad"];
      return scores[Math.floor(Math.random() * scores.length)];
    },
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
</style>

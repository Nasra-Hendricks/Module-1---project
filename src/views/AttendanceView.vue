<template>
  <div class="container mt-4">
    <h2 class="text-center mb-4">Attendance And Leave Records</h2>
    <div v-if="isLoading" class="text-center">Loading...</div>
    <div v-if="errorMessage" class="alert alert-danger text-center">{{ errorMessage }}</div>
    <div class="row">
      <div v-for="event in events" :key="event.id" class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5>{{ event.title }}</h5>
          </div>
          <div class="card-body">
            <p><strong>Date:</strong> {{ event.start }}</p>
            <p><strong>Status:</strong> {{ event.status }}</p>
            <div v-if="event.type === 'leaveRequests'">
              <p><strong>Leave Status:</strong> {{ event.leaveStatus }}</p>
              <p><strong>Leave Reason:</strong> {{ event.leaveReason }}</p>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success btn-sm" @click="approveLeave(event)">
                  Approve
                </button>
                <button type="button" class="btn btn-danger btn-sm" @click="denyLeave(event)">
                  Deny
                </button>
              </div>
            </div>
            <div v-if="event.type === 'attendance'">
              <button type="button" class="btn btn-primary btn-sm mt-2" @click="editEvent(event)">
                Edit Record
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showModal" class="modal fade show" style="display: block;">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Record</h5>
            <button type="button" class="close" @click="closeModal">&times;</button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateRecord">
              <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" v-model="editForm.date" required />
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" v-model="editForm.status" required />
              </div>
              <div v-if="editType === 'leaveRequests'" class="form-group">
                <label for="leaveStatus">Leave Status:</label>
                <input type="text" class="form-control" v-model="editForm.leaveStatus" />
              </div>
              <div v-if="editType === 'leaveRequests'" class="form-group">
                <label for="leaveReason">Leave Reason:</label>
                <input type="text" class="form-control" v-model="editForm.leaveReason" />
              </div>
              <div v-if="editType === 'leaveRequests'" class="form-group">
                <button type="button" class="btn btn-success mr-2" @click="approveLeave">Approve</button>
                <button type="button" class="btn btn-danger" @click="denyLeave">Deny</button>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'vue-cal/dist/vuecal.css'

export default {
  data() {
    return {
      events: [],
      showModal: false,
      isLoading: true,
      errorMessage: '',
      editForm: {
        date: '',
        status: '',
        leaveStatus: '',
        leaveReason: ''
      },
      editEventId: null,
      editType: ''
    };
  },
  methods: {
    editEvent(event) {
      this.editEventId = event.id;
      this.editType = event.type;
      this.editForm = { ...event };
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    updateRecord() {
      // Update record via API
      fetch(`http://localhost/api/attendance.php?id=${this.editEventId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.editForm),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            this.loadData(); // Refresh data after updating
            this.closeModal();
          } else {
            this.errorMessage = 'Failed to update record.';
          }
        })
        .catch((error) => {
          this.errorMessage = 'Error updating record: ' + error;
        });
    },
    approveLeave(event) {
      // Send request to approve leave
      event.leaveStatus = 'Approved';
      fetch(`http://localhost/api/attendance.php?id=${event.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ leaveStatus: 'Approved' }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            this.loadData(); // Refresh data after approval
          } else {
            this.errorMessage = 'Failed to approve leave.';
          }
        })
        .catch((error) => {
          this.errorMessage = 'Error approving leave: ' + error;
        });
    },

    denyLeave(event) {
      // Send request to deny leave
      event.leaveStatus = 'Denied';
      fetch(`http://localhost/api/attendance.php?id=${event.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ leaveStatus: 'Denied' }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            this.loadData(); // Refresh data after denial
          } else {
            this.errorMessage = 'Failed to deny leave.';
          }
        })
        .catch((error) => {
          this.errorMessage = 'Error denying leave: ' + error;
        });
    },
    loadData() {
  this.isLoading = true;
  this.errorMessage = "";
  fetch("http://localhost/griffith/src/php/get_attendance.php")
    .then((response) => response.json())
    .then((data) => {
      if (Array.isArray(data)) {
        this.events = data.flatMap((employee, index) => {
          return [
            // Flatten attendance records
            ...(employee.attendance ? [{
              id: `attendance-${employee.employee_id}-${index}`,
              start: employee.attendance.attendance_date,
              title: `Attendance - ${employee.attendance.attendance_status}`,
              type: "attendance",
              status: employee.attendance.attendance_status,
              employee_id: employee.employee_id,
            }] : []),
            // Flatten leave request records
            ...(employee.leave_requests ? [{
              id: `leave-${employee.employee_id}-${index}`,
              start: employee.leave_requests.leave_date,
              title: `Leave - ${employee.leave_requests.leave_reason} (${employee.leave_requests.leave_status})`,
              type: "leaveRequests",
              leaveStatus: employee.leave_requests.leave_status,
              leaveReason: employee.leave_requests.leave_reason,
              employee_id: employee.employee_id,
            }] : []),
          ];
        });
      } else {
        this.errorMessage = "No attendance or leave data available";
        console.error("Data format issue: Expected an array");
      }
      this.isLoading = false;
    })
    .catch((error) => {
      this.isLoading = false;
      this.errorMessage = "Error loading data: " + error;
    });
},
  },
  mounted() {
    // Load data when the component is mounted
    this.loadData();
  },
};
</script>

<style scoped>
/* Custom styles for card, buttons, and modal */
.card {
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-header {
  background-color: #F5F5F5;
  font-weight: bold;
}

.card-body {
  padding: 15px;
}

.card-footer {
  background-color: #F5F5F5;
  text-align: center;
}

button {
  cursor: pointer;
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-dialog {
  max-width: 100%;
  margin: 10px;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  width: 100%;
  max-width: 500px;
}

.modal-body {
  overflow-y: auto;
  max-height: 70vh;
}

.container {
  width: 100%;
  padding: 20px;
  box-sizing: border-box;
}
</style>

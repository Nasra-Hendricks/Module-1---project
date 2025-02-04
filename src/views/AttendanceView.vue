<template>
  <div class="container mt-4">
    <h2 class="text-center mb-4">Attendance Calendar</h2>
    <vue-cal
      :events="events"
      @event-click="editEvent"
      :time="false"
      :hide-view-selector="true"
      class="mb-4"
    />

    <!-- Edit Modal -->
    <div v-if="showModal" class="modal fade show" style="display: block;">
      <div class="modal-dialog">
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
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'

export default {
  components: {
    VueCal
  },
  data() {
    return {
      events: [],
      showModal: false,
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
      const eventIndex = this.events.findIndex(event => event.id === this.editEventId);
      if (eventIndex !== -1) {
        this.events[eventIndex] = { ...this.editForm };
      }
      this.closeModal();
    },
    approveLeave() {
      this.editForm.leaveStatus = 'Approved';
    },
    denyLeave() {
      this.editForm.leaveStatus = 'Denied';
    },
    loadData() {
      fetch('Attendance.json')
        .then(response => response.json())
        .then(data => {
          this.events = data.attendanceAndLeave.flatMap(employee => [
            ...employee.attendance.map((record, index) => ({
              id: `attendance-${employee.employeeId}-${index}`,
              start: record.date,
              end: record.date,
              title: `${employee.name} - ${record.status}`,
              type: 'attendance',
              ...record
            })),
            ...employee.leaveRequests.map((record, index) => ({
              id: `leave-${employee.employeeId}-${index}`,
              start: record.date,
              end: record.date,
              title: `${employee.name} - ${record.reason} (${record.status})`,
              type: 'leaveRequests',
              ...record
            }))
          ]);
        })
        .catch(error => {
          console.error('Error loading JSON data:', error);
        });
    }
  },
  mounted() {
    this.loadData();
  }
};
</script>

<style>
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
.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  width: 100%;
  max-width: 500px;
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

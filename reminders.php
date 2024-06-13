<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/meta_includes.php'); ?>
  <?php include('includes/css_includes.php'); ?>
  <?php include('includes/connect.php'); ?>
  <title>Reminders</title>
</head>
<body class="bg-light">
  <div class="container my-5">
    <button class="btn btn-primary" data-toggle="modal" data-target="#createReminderModal">Create New Reminder</button>

    <!-- Modal for Creating New Reminder -->
    <div class="modal fade" id="createReminderModal" tabindex="-1" role="dialog" aria-labelledby="createReminderModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createReminderModalLabel">Create New Reminder</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="createReminderForm" action="functions/create_reminder.php" method="post">
              <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
              </div>
              <div class="form-group">
                <label for="reminder_time">Reminder Time</label>
                <input type="time" class="form-control" id="reminder_time" name="reminder_time" required>
              </div>
              <div class="form-group">
                <label for="recurrence_interval">Recurrence Interval</label>
                <input type="number" class="form-control" id="recurrence_interval" name="recurrence_interval" required>
              </div>
              <div class="form-group">
                <label for="recurrence_unit">Recurrence Unit</label>
                <select class="form-control" id="recurrence_unit" name="recurrence_unit" required>
                  <option value="days">Days</option>
                  <option value="weeks">Weeks</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Create Reminder</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <h2 class="mt-5">Existing Reminders</h2>
    <table class="table table-striped" id="remindersTable">
      <thead>
        <tr>
          <th>Task Name</th>
          <th>Reminder Time</th>
          <th>Recurrence</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- PHP code to fetch and display reminders will go here -->
      </tbody>
    </table>
  </div>

  <?php include('includes/footer.php'); ?>

  <!-- Modal for Viewing Reminder Details -->
  <div class="modal fade" id="viewReminderModal" tabindex="-1" role="dialog" aria-labelledby="viewReminderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewReminderModalLabel">Reminder Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="reminderDetails"></p>
          <button class="btn btn-danger" id="deleteReminderButton">Delete Reminder</button>
          <button class="btn btn-success" id="completeReminderButton">Mark as Complete</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- JavaScript for handling modals and actions -->
  <script>
    function loadReminders() {
      $.ajax({
        url: 'functions/fetch_reminders.php',
        method: 'GET',
        success: function(data) {
          $('#remindersTable tbody').html(data);
        }
      });
    }

    function viewReminder(id) {
      $.ajax({
        url: 'functions/view_reminder.php',
        method: 'GET',
        data: { id: id },
        success: function(data) {
          $('#reminderDetails').html(data);
          $('#viewReminderModal').modal('show');
          $('#deleteReminderButton').attr('data-id', id);
          $('#completeReminderButton').attr('data-id', id);
        }
      });
    }

    function deleteReminder() {
      var id = $('#deleteReminderButton').attr('data-id');
      $.ajax({
        url: 'functions/delete_reminder.php',
        method: 'POST',
        data: { id: id },
        success: function() {
          $('#viewReminderModal').modal('hide');
          loadReminders();
        }
      });
    }

    function completeReminder() {
      var id = $('#completeReminderButton').attr('data-id');
      $.ajax({
        url: 'functions/complete_reminder.php',
        method: 'POST',
        data: { id: id },
        success: function() {
          $('#viewReminderModal').modal('hide');
          loadReminders();
        }
      });
    }

    $(document).ready(function() {
      loadReminders();
      $('#deleteReminderButton').click(deleteReminder);
      $('#completeReminderButton').click(completeReminder);
    });
  </script>
</body>
</html>

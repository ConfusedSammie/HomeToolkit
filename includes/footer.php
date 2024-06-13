<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    let lastModificationTime = null;

    function checkForChanges() {
        $.ajax({
            url: '../functions/checkForChanges.php', 
            method: 'GET',
            success: function(data) {
                const currentModificationTime = parseInt(data, 10);
                if (lastModificationTime === null) {
                    lastModificationTime = currentModificationTime;
                } else if (currentModificationTime > lastModificationTime) {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    }

    setInterval(checkForChanges, 1000);
</script>
<?php
include('functions/check_reminders.php');
?>

<script>
    console.log('hello??!?!?!');
    fetch('functions/check_reminders.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Create modal content
                let modalContent = '<div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="reminderModalLabel" aria-hidden="true">';
                modalContent += '<div class="modal-dialog" role="document">';
                modalContent += '<div class="modal-content">';
                modalContent += '<div class="modal-header">';
                modalContent += '<h5 class="modal-title" id="reminderModalLabel">Reminders</h5>';
                modalContent += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                modalContent += '<span aria-hidden="true">&times;</span>';
                modalContent += '</button>';
                modalContent += '</div>';
                modalContent += '<div class="modal-body">';
                modalContent += '<ul>';
                data.forEach(reminder => {
                    modalContent += '<li>' + reminder.task_name + ' at ' + reminder.reminder_time + ' <button class="btn btn-success complete-btn" data-id="' + reminder.id + '">Complete</button></li>';
                });
                modalContent += '</ul>';
                modalContent += '</div>';
                modalContent += '<div class="modal-footer">';
                modalContent += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                modalContent += '</div>';
                modalContent += '</div>';
                modalContent += '</div>';
                modalContent += '</div>';

                // Append modal to body
                document.body.insertAdjacentHTML('beforeend', modalContent);

                // Show modal
                $('#reminderModal').modal('show');

                // Attach click event to complete buttons
                document.querySelectorAll('.complete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        let reminderId = this.getAttribute('data-id');
                        fetch('functions/complete_reminder.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + reminderId
                        })
                        .then(response => response.text())
                        .then(result => {
                            alert(result);
                            // Optionally, you can remove the completed reminder from the list or hide the modal
                            $('#reminderModal').modal('hide');
                        });
                    });
                });
            }
        });
</script>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
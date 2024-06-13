<?php
include(__DIR__ . '/../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reminder_id = $_POST['id'];
    
    $sql = "UPDATE reminders SET status = 'completed' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reminder_id);
    
    if ($stmt->execute()) {
        echo "Reminder marked as completed.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
ob_start(); // Start output buffering
include('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task_name'];
    $reminder_time = $_POST['reminder_time'];
    $recurrence_interval = $_POST['recurrence_interval'];
    $recurrence_unit = $_POST['recurrence_unit'];

    $sql = "INSERT INTO reminders (task_name, reminder_time, recurrence_interval, recurrence_unit, status)
            VALUES (?, ?, ?, ?, 'active')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $task_name, $reminder_time, $recurrence_interval, $recurrence_unit);

    if ($stmt->execute()) {
        header("Location: ../reminders.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
ob_end_flush(); // End output buffering and flush output
?>

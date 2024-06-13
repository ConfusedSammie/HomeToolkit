<?php
include('../includes/connect.php');

$id = $_GET['id'];

$sql = "SELECT * FROM reminders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo "<strong>Task Name:</strong> " . $row['task_name'] . "<br>";
echo "<strong>Reminder Time:</strong> " . $row['reminder_time'] . "<br>";
echo "<strong>Recurrence:</strong> " . $row['recurrence_interval'] . " " . $row['recurrence_unit'] . "<br>";
echo "<strong>Status:</strong> " . $row['status'] . "<br>";

$stmt->close();
$conn->close();
?>

<?php
include('../includes/connect.php');

$sql = "SELECT * FROM reminders";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['task_name'] . "</td>";
    echo "<td>" . $row['reminder_time'] . "</td>";
    echo "<td>" . $row['recurrence_interval'] . " " . $row['recurrence_unit'] . "</td>";
    echo "<td><button class='btn btn-info' onclick='viewReminder(" . $row['id'] . ")'>View</button></td>";
    echo "</tr>";
}

$conn->close();
?>

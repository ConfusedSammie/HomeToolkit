<?php
include(__DIR__ . '/../includes/connect.php');

function logMessage($message) {
    $logfile = __DIR__ . '/../cron_log.txt';
    file_put_contents($logfile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

function checkReminders($conn) {
    $current_time = date('H:i:s'); // Current time
    $current_datetime = date('Y-m-d H:i:s');
    logMessage("Current time: " . $current_time);
    logMessage("Current datetime: " . $current_datetime);

    // Fetch reminders that need to be triggered now
    $reminders = [];

    // Query to fetch reminders with statuses active or completed
    $sql = "SELECT * FROM reminders WHERE status IN ('active') AND reminder_time <= ?";
    logMessage("SQL Query: " . $sql);

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $current_time);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            // Update status to active if it was completed and the interval has passed
            if ($row['status'] == 'completed') {
                $interval_seconds = 0;
                if ($row['recurrence_unit'] == 'days') {
                    $interval_seconds = intval($row['recurrence_interval']) * 86400; // 86400 seconds in a day
                } elseif ($row['recurrence_unit'] == 'weeks') {
                    $interval_seconds = intval($row['recurrence_interval']) * 604800; // 604800 seconds in a week
                }

                $last_completed_time = strtotime($row['last_triggered']);
                $next_due_time = $last_completed_time + $interval_seconds;

                if (time() >= $next_due_time) {
                    $reset_sql = "UPDATE reminders SET status = 'active' WHERE id = ?";
                    $update_stmt = $conn->prepare($reset_sql);
                    $update_stmt->bind_param("i", $row['id']);
                    $update_stmt->execute();
                    $update_stmt->close();
                    $row['status'] = 'active';
                }
            }
            $reminders[] = $row;
        }
        $stmt->close();
    } else {
        logMessage("Failed to prepare statement: " . $conn->error);
    }
    
    logMessage("Reminders found: " . json_encode($reminders));
    return $reminders;
}

// Check reminders and return data for modal
$reminders = checkReminders($conn);

if (!empty($reminders)) {
    echo json_encode($reminders);
    logMessage("Reminders returned: " . json_encode($reminders));
} else {
   // echo json_encode([]);
    logMessage("No reminders found.");
}

$conn->close();
?>

<?php
include('../includes/connect.php');
$data = json_decode(file_get_contents('php://input'), true);

$cat_id = $data['cat_id'];
$weight = $data['weight'];
$date_tracked = date('Y-m-d');

$sql = "INSERT INTO weights (cat_id, weight, date_tracked) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $cat_id, $weight, $date_tracked);

$response = [];
if ($stmt->execute()) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>

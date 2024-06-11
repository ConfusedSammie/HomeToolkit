<?php
include('../includes/connect.php');

$cat_id = intval($_GET['cat_id']);

$sql = "SELECT date_tracked, weight FROM weights WHERE cat_id = ? ORDER BY date_tracked DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cat_id);
$stmt->execute();
$result = $stmt->get_result();

$cat_data = [];
while ($row = $result->fetch_assoc()) {
    $date = $row['date_tracked'];
    $weight = $row['weight'];

    if (!isset($cat_data[$date])) {
        $cat_data[$date] = ['min' => $weight, 'max' => $weight];
    } else {
        if ($weight < $cat_data[$date]['min']) {
            $cat_data[$date]['min'] = $weight;
        }
        if ($weight > $cat_data[$date]['max']) {
            $cat_data[$date]['max'] = $weight;
        }
    }
}

$formatted_data = [];
foreach ($cat_data as $date => $weights) {
    $formatted_data[] = [
        'date' => $date,
        'weight' => $weights['min'] == $weights['max'] ? $weights['min'] : $weights['min'] . ' - ' . $weights['max']
    ];
}

$stmt->close();
$conn->close();

echo json_encode($formatted_data);

?>
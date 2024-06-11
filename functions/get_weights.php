<?php
include('../includes/connect.php');
$sql = "
SELECT cats.id as cat_id, cats.name as cat_name, cats.color as cat_color, weights.weight, weights.date_tracked
FROM weights
INNER JOIN cats ON weights.cat_id = cats.id
ORDER BY weights.date_tracked ASC";
$result = $conn->query($sql);

$weights = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $weights[] = $row;
  }
}
echo json_encode($weights);
$conn->close();
?>
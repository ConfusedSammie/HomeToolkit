<?php
include('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $location = $_POST['location'];
    $watering_frequency = $_POST['watering_frequency'];
    $last_watered_date = $_POST['last_watered_date'];
    $sunlight_requirement = $_POST['sunlight_requirement'];
    $notes = $_POST['notes'];

    // Handle image upload
    if (isset($_FILES['plant_image']) && $_FILES['plant_image']['error'] == 0) {
        $image_name = basename($_FILES["plant_image"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;

        // Create uploads directory if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($_FILES["plant_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        $image_path = null;
    }

    // Insert data into database
    $sql = "INSERT INTO plants ( type, location, watering_frequency, last_watered_date, sunlight_requirement, notes, image_path)
            VALUES ( ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissss",  $type, $location, $watering_frequency, $last_watered_date, $sunlight_requirement, $notes, $image_path);

   if ($stmt->execute()) {
        header("Location: ../plants.php?status=success&message=New plant added successfully");
    } else {
        header("Location: ../plants.php?status=error&message=Database error: " . $conn->error);
    }

    $stmt->close();
    $conn->close();
}
?>

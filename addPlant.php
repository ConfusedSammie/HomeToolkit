<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Plant</title>

    <?php include('includes/meta_includes.php'); ?>
    <?php include('includes/css_includes.php'); ?>
    <?php include('includes/connect.php'); ?>
</head>
<body>

    <div class="container form-container addPlantContainer">
        <h2 class="text-center">Add New Plant</h2>
        <form action="functions/insert_plant.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="type">Plant Type</label>
                <input type="text" class="form-control" id="type" name="type">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <select class="form-control" id="location" name="location" required>
                    <option value="(Empty)">(Empty)</option>
                    <option value="Alleyway">Alleyway</option>
                    <option value="Back Entrance (Outside)">Back Entrance (Outside)</option>
                    <option value="Bedroom">Bedroom</option>
                    <option value="Dining Room (Hanging)">Dining Room (Hanging)</option>
                    <option value="Front Entrance (Outside)">Front Entrance (Outside)</option>
                    <option value="Living Room (Hanging)">Living Room (Hanging)</option>
                    <option value="Living Room Shelves">Living Room Shelves</option>
                    <option value="Office">Office</option>
                    <option value="Vestibule">Vestibule</option>

                </select>
            </div>
            <div class="form-group">
                <label for="watering_frequency">Watering Frequency (days)</label>
                <input type="number" class="form-control" id="watering_frequency" name="watering_frequency" required>
            </div>
            <div class="form-group">
                <label for="last_watered_date">Last Watered Date</label>
                <input type="date" class="form-control" id="last_watered_date" name="last_watered_date">
            </div>
            <div class="form-group">
                <label for="sunlight_requirement">Sunlight Requirement</label>
                <select class="form-control" id="sunlight_requirement" name="sunlight_requirement" required>
                    <option value="Full Sun">Full Sun</option>
                    <option value="Partial Sun">Partial Sun</option>
                    <option value="Shade">Shade</option>
                </select>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"></textarea>
            </div>
            <div class="form-group">
            <label for="plant_image">Upload Image</label>
            <div class="upload-container" onclick="document.getElementById('plant_image').click();">
                <span class="upload-text">Select a file to upload.</span>
                <input type="file" id="plant_image" name="plant_image">
            </div>
        </div>
            <button type="submit" class="btn btn-primary btn-block">Add Plant</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include('functions/auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/meta_includes.php'); ?>
  <?php include('includes/css_includes.php'); ?>
  <?php include('includes/connect.php'); ?>
  <title>Homepage</title>
</head>
<body class="bg-light">
  <div class="container my-5">
    <button class='btn btn-primary'>Record Weight</button>
    <div>
      <h2 class="text-center">Cat Weights Over Time</h2>
      <canvas id="catWeightsChart" width="400" height="200"></canvas>

      <script src='js/line_chart_cats_weight.js'> </script>
    </div>
  </div>
  <?php
  include('includes/footer.php');
  ?>

</body>
</html>
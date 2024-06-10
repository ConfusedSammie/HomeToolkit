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
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4 shadow-sm homepageCard">
          <a href="plants.php">
            <div class='imageContainer'>
              <img src="https://t4.ftcdn.net/jpg/05/51/07/67/360_F_551076710_Q675H2O06HaA9oDBijQ4A2h17emW3xIF.jpg" class="card-img-top" alt="Plants" >
            </div>
            <div class="card-body">
              <h5 class="card-title">Plants Toolkit</h5>
              <p class="card-text">Explore a variety of tools and resources to help you take care of your plants.</p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4 shadow-sm homepageCard">
          <a href="cats.php">
            <div class='imageContainer'>
              <img src="images/catSleeping.png" class="card-img-top" alt="Cats">
            </div>
            <div class="card-body">
              <h5 class="card-title">Cats Toolkit</h5>
              <p class="card-text">Find useful tools and resources for taking care of your cats.</p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-4 shadow-sm homepageCard">
          <a href="home.php">
            <div class='imageContainer'>
              <img src="images/blueprint.png" class="card-img-top" alt="Cats">
            </div>
            <div class="card-body">
              <h5 class="card-title">Home Toolkit</h5>
              <p class="card-text">Find useful tools and resources for taking care of your home.</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('includes/footer.php');
  ?>

</body>
</html>
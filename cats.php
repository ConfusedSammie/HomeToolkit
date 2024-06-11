<?php
//include('functions/auth.php');
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
  <div class="container catPageContainer">
    <button class='btn btn-primary mt-3' data-toggle="modal" data-target="#recordWeightModal">Record Weight</button>
    <div class='row cat_weight_widgets'>
      <div class='col-12 col-md-6 cat_weight_chart'>
        <h2 class="text-center">Cat Weights Over Time</h2>
        <canvas id="catWeightsChart" width="400" height="200"></canvas>

        <script src='js/line_chart_cats_weight.js'> </script>
      </div>
      <div class='col-12 col-md-6 cat_weight_table'>
        <h3 class="text-center">Cat Data</h3>
        <div class="btn-group mb-3 d-flex justify-content-center" role="group" aria-label="Cat names">
          <button type="button" class="btn btn-secondary cat-btn" onclick="showCatData(1, this)">Gigi</button>
          <button type="button" class="btn btn-secondary cat-btn" onclick="showCatData(2, this)">Miso</button>
          <button type="button" class="btn btn-secondary cat-btn" onclick="showCatData(3, this)">Momo</button>
          <button type="button" class="btn btn-secondary cat-btn" onclick="showCatData(4, this)">Archie</button>
        </div>
        <table class="table table-striped" id="catDataTable" style="display:none;">
          <thead>
            <tr>
              <th>Date</th>
              <th>Weight (grams)</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include('includes/footer.php'); ?>

  <!-- Modal -->
  <div class="modal fade" id="recordWeightModal" tabindex="-1" role="dialog" aria-labelledby="recordWeightModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="recordWeightModalLabel">Record Cat Weight</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="recordWeightForm">
            <div class="form-group">
              <label>Select Cat</label>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary cat-button" onclick="selectCat(1, this)">Gigi</button>
                <button type="button" class="btn btn-secondary cat-button" onclick="selectCat(2, this)">Miso</button>
                <button type="button" class="btn btn-secondary cat-button" onclick="selectCat(3, this)">Momo</button>
                <button type="button" class="btn btn-secondary cat-button" onclick="selectCat(4, this)">Archie</button>
              </div>
            </div>
            <input type="hidden" id="catId" required>
            <div class="form-group">
              <label for="catWeight">Weight (grams)</label>
              <input type="number" class="form-control" id="catWeight" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
  <script>

    function showCatData(catId, button) {
      fetch('functions/get_cat_data.php?cat_id=' + catId)
      .then(function(response) {
        if (!response.ok) {
          throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
      })
      .then(function(data) {
        console.log('Fetched cat data:', data);
        var table = document.getElementById('catDataTable');
        var tbody = table.getElementsByTagName('tbody')[0];
        tbody.innerHTML = ''; 
        data.forEach(function(item) {
          var row = tbody.insertRow();
          var cellDate = row.insertCell(0);
          var cellWeight = row.insertCell(1);

          cellDate.innerHTML = item.date;
          cellWeight.innerHTML = item.weight;
        });

        table.style.display = 'table'; 
        var buttons = document.getElementsByClassName('cat-btn');
        for (var i = 0; i < buttons.length; i++) {
          buttons[i].classList.remove('selected');
        }
        button.classList.add('selected');
      })
      .catch(function(error) {
        console.error('Error fetching cat data:', error);
      });
    }

    function selectCat(catId, button) {
      document.getElementById('catId').value = catId;
      var buttons = document.getElementsByClassName('cat-button');
      for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('selected');
      }
      button.classList.add('selected');
    }

    document.getElementById('recordWeightForm').addEventListener('submit', function(event) {
      event.preventDefault();
      var catId = document.getElementById('catId').value;
      var weight = document.getElementById('catWeight').value;

      fetch('functions/record_weight.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          cat_id: catId,
          weight: weight
        })
      })
      .then(function(response) {
        if (!response.ok) {
          throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
      })
      .then(function(data) {
        console.log('Recorded data:', data);
        $('#recordWeightModal').modal('hide');
      })
      .catch(function(error) {
        console.error('Error recording weight:', error);
      });
    });
  </script>

</html>
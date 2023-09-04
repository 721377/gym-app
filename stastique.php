<?php
include 'side.php';
include 'config.php';
$stmt = mysqli_stmt_init($conn);





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/stati.css">
  <title>Document</title>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <link rel="icon" href="images/KOI-icon.png" type="image/x-icon">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

</head>

<body>


  <section class="command">

    <div class="grid-command">

      <div class="stati">
        <canvas id="myChart"></canvas>
      </div>





    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </section>

  <?php
  $select_query = $conn->query("select date , amout from statistique ORDER BY date ASC LIMIT 30");

  if (mysqli_num_rows($select_query) > 0) {
    foreach ($select_query as $data) {
      $date[] = $data['date'];
      $amout[] = $data['amout'];
    }
  }


  ?>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($date) ?>,
        datasets: [{
          label: ' Incoms in Dhs',
          data: <?php echo json_encode($amout) ?>,
          borderWidth: 1,
          borderColor: '#fe9000',
          backgroundColor: '#c8a063'
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>

</html>
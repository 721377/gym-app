<?php
include 'sidebar.php';
include 'head.php';
include 'dbcon.php';
$stmt = mysqli_stmt_init($conn);

//product select

$select_pr = "SELECT * FROM `produits`";

if (!mysqli_stmt_prepare($stmt, $select_pr)) {
  echo "sql failed";
} else {
  mysqli_stmt_execute($stmt);
  $result_pr = mysqli_stmt_get_result($stmt);
}

//local commande select
$local_select = "SELECT DISTINCT id_table FROM commands_locale";

if (!mysqli_stmt_prepare($stmt, $local_select)) {
  echo ("Error first_select");
} else {
  mysqli_stmt_execute($stmt);
  $result_local_select = mysqli_stmt_get_result($stmt);
}


//online commande select
$online_select = "SELECT DISTINCT id_user FROM commande_online";

if (!mysqli_stmt_prepare($stmt, $online_select)) {
  echo ("Error first_select");
} else {
  mysqli_stmt_execute($stmt);
  $result_online_select = mysqli_stmt_get_result($stmt);
}


//online users select
$online_users = "SELECT * FROM `online_users`";

if (!mysqli_stmt_prepare($stmt, $online_users)) {
  echo ("Error first_select");
} else {
  mysqli_stmt_execute($stmt);
  $result_online_users = mysqli_stmt_get_result($stmt);
}




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
</head>

<body>


  <section class="command">

    <div class="grid-command">

      <div class="stati">
        <canvas id="myChart"></canvas>
      </div>

      <div class="top-card">
        <div class="card user">
          <div class="icon">
            <img src="images/5440339.png" alt="">
          </div>
          <div class="num"><?php echo mysqli_num_rows($result_online_users) ?><span>users</span></div>


        </div>
        <div class="card user">
          <div class="icon">
            <img src="images/3080950.png" alt="">
          </div>
          <div class="num"><?php echo mysqli_num_rows($result_online_select) + mysqli_num_rows($result_local_select) ?><span>order</span></div>

          <div class="button">
            <a href="dashboard.php">see all</a>
          </div>
        </div>
        <div class="card user">
          <div class="icon">
            <img src="images/plat-de-service.png" alt="">
          </div>
          <div class="num"><?php echo mysqli_num_rows($result_pr) ?><span>plats</span></div>

          <div class="button">
            <a href="product.php">see all</a>
          </div>
        </div>
      </div>



    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </section>

  <?php
  $select_query = $conn->query("select date , amout from statistique ORDER BY id DESC LIMIT 7");

  if (mysqli_num_rows($select_query) > 0) {
    foreach ($select_query as $data) {
      $d[] = $data['date'];
      $a[] = $data['amout'];
    }
    $date = array_reverse($d);
    $amout = array_reverse($a);
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
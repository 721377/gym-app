<?php


include 'config.php';
$stmt = mysqli_stmt_init($conn);


$date = date("Y-m-d");



if (isset($_GET['id_client'])) {
  $code = $_GET['id_client'];

  $sql = "UPDATE client SET dat_ins = ?  WHERE id = ?";

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "error";
  } else {
    mysqli_stmt_bind_param($stmt, "si", $date, $code);
    mysqli_stmt_execute($stmt);
  }
}

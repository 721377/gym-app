<?php


include 'config.php';
$stmt = mysqli_stmt_init($conn);


// select the price




$date = date("Y-m-d");
$month = date('m', strtotime($date));


if (isset($_GET['id_client'])) {
  $code = $_GET['id_client'];



  $sql = "UPDATE client SET dat_ins = ?  WHERE id = ?";
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "error";
  } else {
    mysqli_stmt_bind_param($stmt, "si", $date, $code);
    mysqli_stmt_execute($stmt);


    $select = "SELECT prix FROM `client` WHERE id = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
      $error[] = "select is failed";
    } else {
      mysqli_stmt_bind_param($stmt, "i", $code);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $prix_row = mysqli_fetch_assoc($result);
      $prix = $prix_row['prix'];
    }



    $select_for_verification = mysqli_query($conn, "SELECT `id`, MONTH(date) AS month, `amout` FROM statistique ORDER BY id DESC LIMIT 1;");
    $rows_select_for_verification = mysqli_fetch_assoc($select_for_verification);

    if (mysqli_num_rows($select_for_verification) == 0) {
      $insert_1 = mysqli_query($conn, "INSERT INTO `statistique`(`date`, `amout`) VALUES ('$date',' $prix')");
    } else {
      if ($rows_select_for_verification['month'] ==  $month) {
        $prix_updated = $rows_select_for_verification['amout'] + $prix;
        $insert_1 = mysqli_query($conn, "UPDATE `statistique` SET `amout`='$prix_updated' WHERE `date` = '$date'");
      } else {
        $insert_1 = mysqli_query($conn, "INSERT INTO `statistique`(`date`, `amout`) VALUES ('$date',' $prix')");
      }
    }
  }
}

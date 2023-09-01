<?php

@include 'config.php';

$code=$_GET['id'];

// sql to to delete students
$sql = "DELETE FROM std_add WHERE id=$code";

$result = mysqli_query($conn, $sql);
header("location:admin_page.php#div");
?>
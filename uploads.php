<?php
include 'config.php';

if(isset($_POST['import'])){

    $fileName =   $_FILES['excel']['name'];
    $fileExtension =  explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));

    $newFileName = date("Y.m.d") . "-" . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads_file/" . $newFileName;
    move_uploaded_file( $_FILES["excel"]["tmp_name"],$targetDirectory );
  
    
    error_reporting(0);
    ini_set('display_error',0);

    require "excelReader/excel_reader2.php";
    require "excelReader/SpreadsheetReader.php";

    $read = new SpreadsheetReader($targetDirectory);
    foreach($read as $key=>$value){

    $nom=$value[0];
    $sport=$value[1];
    $dat=$value[2];
    $tele=$value[3];
    $prix=$value[4];
    $age = $value[5];


    
         $conn->query("INSERT INTO client(id,nom_com,age, sport,dat_ins,tele,prix) values('','$nom','$age', '$sport','$dat','$tele','$prix')");
    }

    header('location:client.php');

}

?>

<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_GET['id_client'])) {
    $id = $_GET['id_client'];

    if (!mysqli_stmt_prepare($stmt, "SELECT * FROM `client` WHERE id = ?")) {
        $error[] = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        $responseData = array(
            'nom' => "Nom : " . $data['nom_com'],
            'age' => "Age : " . $data['age'],
            'prix' => "Prix : " . $data['prix'],
            'tele' => "Telephone : " . $data['tele'],
            'date' => "Date D'inscription : " . $data['dat_ins'],

        );

        echo json_encode($responseData);
    }
} else {
    echo "Error: id_client parameter is missing";
}

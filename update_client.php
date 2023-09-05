<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_GET['id'])) {


    $code = $_GET['id'];

    $sql = "SELECT * FROM `client` WHERE id=?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    }
}


//partie modification
if (isset($_POST['submit'])) {


    if (empty($_POST['sport'])) {
        $error[] = "selectioner un sport";
    } else {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $date = $_POST['date'];
        $tele = $_POST['tele'];
        $prix = $_POST['prix'];;
        $sport = $_POST['sport'];

        $sql = "UPDATE client SET nom_com = ?, age=?,dat_ins=? ,tele=?  ,prix=? ,sport=? where id=?";

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "error";
        } else {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $age, $date, $tele, $prix, $sport, $code);
            mysqli_stmt_execute($stmt);
            header('location:client.php');
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link rel="stylesheet" href="css/update_form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

</head>

<body>
    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">

                <?php
                if (isset($error)) {
                    foreach ($error as $error) {

                        echo '<div class="error" id="acc">
                 <i class="fa-solid fa-circle-exclamation"></i>
                <p>' . $error . '</p>
                 </div>';
                    };
                };

                ?>

                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" name="name" value="<?= $row['nom_com'] ?>" required id="" />
                    <span></span>
                    <label for="">Nom complet</label>
                </div>
                <div class="txt_field">
                    <input type="text" value="<?= $row['age'] ?>" name="age" required id="" />
                    <span></span>
                    <label for="">Age</label>
                </div>

                <div class="txt_field">
                    <input type="text" value="<?= $row['tele'] ?>" name="tele" required id="" />
                    <span></span>
                    <label for="">tele</label>
                </div>

                <div class="select">
                    <select name="sport" id="">
                        <option value="" disabled selected>sport</option>
                        <option value="k1">K1</option>
                        <option value="aikido">aikido</option>
                        <option value="Box">Box</option>
                        <option value="musculation">musculation</option>

                    </select>

                </div>

                <div class="txt_field">
                    <input type="text" value="<?= $row['prix'] ?>" name="prix" id="" />
                    <span></span>
                    <label for="">Prix</label>
                </div>
                <div class="txt_field">
                    <input type="date" value="<?= $row['dat_ins'] ?>" name="date" class="date" required id="" placeholder="La Date D'inscription *" />
                    <span></span>

                </div>

                <button class="btn" type="submit" name="submit">
                    sauvegarder
                </button>
            </form>
        </div>
    </div>

</body>

</html>
<?php

include 'side.php';
include 'config.php';
$stmt = mysqli_stmt_init($conn);


/*


$code=$_GET['id'];

// sql to to update students
$sql = "SELECT * FROM std_add WHERE id=$code";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if(isset($_POST['submit'])){

$name = $_POST['nom'];
$price =  $_POST['prix'];
$date = $_POST['date'];
$tele = $_POST['tele'];



$edit = "UPDATE std_add SET nam='$name', prix='$price', date='$date ', tele='$tele' WHERE id=$code";
$final = mysqli_query($conn, $edit);
header("location:admin_page.php#div");
    }


*/








if (isset($_POST['save'])) {
    $name = $_POST['name'];

    $age =   $_POST['age'];
    $prix =  $_POST['prix'];
    $sport = $_POST['sport'];
    $date = $_POST['date'];
    $tele = $_POST['tele'];

    $month = date('m', strtotime($date));


    $select = "SELECT * FROM `client` WHERE `nom_com` = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error[] = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);





        if (mysqli_num_rows($result) > 0) {
            $error[] = "the client is alredy exist!";
        } else {

            $insert = "INSERT INTO `client`(`nom_com`, `age`, `dat_ins`, `tele`, `prix`, `sport`) VALUES (?,?,?,?,?,?);";
            if (!mysqli_stmt_prepare($stmt, $insert)) {
                $error[] = "insert is failed";
            } else {
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $age, $date, $tele, $prix, $sport);
                mysqli_stmt_execute($stmt);

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


                header('location:client.php');
            }
        }
    }
}

$select = mysqli_query($conn, "SELECT * FROM `client` ORDER BY id DESC");




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/client.css">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="name" />
                    <span></span>
                    <label for="">Nom complet</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="age" />
                    <span></span>
                    <label for="">Age *</label>
                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="tele" />
                    <span></span>
                    <label for="">tele *</label>
                </div>


                <div class="select">
                    <select name="sport" id="">
                        <option value="" disabled selected>sport</option>
                        <option value="K1">K1</option>
                        <option value="aikido">aikido</option>
                        <option value="Box">Box</option>
                        <option value="musculation">musculation</option>

                    </select>

                </div>

                <div class="txt_field">
                    <input type="text" name="prix" required id="" />
                    <span></span>
                    <label for="">Prix *</label>
                </div>
                <div class="txt_field">
                    <input type="date" name="date" class="date" required id="" placeholder="La Date D'inscription *" />
                    <span></span>

                </div>

                <button class="btn" type="submit" name="save">
                    sauvegarder
                </button>
            </form>
        </div>
    </div>



    <div class="bl font1" id="form_det">
        <div class="form-cont2">
            <div class="icon-form">
                <i class="bi bi-person-lines-fill"></i>

            </div>
            <div class="iformations">
                <h1 id="nom_cli">
                </h1>
                <h3 id="age"></h3>
                <h3 id="tele"></h3>
                <h3 id="prix"></h3>
                <h3 id="date"></h3>
            </div>
            <i class="bi bi-x-circle close-icon2"></i>

        </div>
    </div>


    <!-- <div class="bl2 font1" id="form_det">
        <div class="card_det">
            <div class="icon-form2">
                <i class="bi bi-person-add"></i>
            </div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="card-inner"></div>
            <div class="iformations">
                <h1 id="nom_cli">

                </h1>
                <h3 id="age"></h3>
                <h3 id="tele"></h3>
                <h3 id="prix"></h3>
            </div>
            <i class="bi bi-x-circle close-icon2"></i>
        </div>

    </div> -->





    <div class="holder">
        <div class="container">

            <div class="button" id="add">
                <button class="Btn">
                    <div class="sign">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)">
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                            <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                        </svg>
                    </div>

                    <div class="text">Ajouter</div>
                </button>
            </div>
            <div class="sersh">
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                        </g>
                    </svg>
                    <input placeholder="Rechercher" class="input" />
                </div>
            </div>
            <div class="title font2">
                <h2>Client</h2>
            </div>
            <form action="">
                <div class="combobox">
                    <label class="comboboxlab font1" for="combo">Les Sports</label>
                    <select name="" id="" class="select font3">
                        <option value="" disabled selected>sport</option>
                        <option value="K1">K1</option>
                        <option value="aikido">aikido</option>
                        <option value="Box">Box</option>
                        <option value="musculation">musculation</option>

                    </select>
                </div>
            </form>

            <div class="tableau">
                <table>
                    <thead>
                        <tr class="font1">
                            <th>nom complet</th>
                            <th>sport</th>
                            <th>condition</th>
                            <th>status</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>

                    <form action="">
                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                                <tr>

                                    <td><?= $row['nom_com'] ?></td>

                                    <td><?= $row['sport'] ?></td>

                                    <td>activer</td>
                                    <td class="switchtd">
                                        <input onclick="updateDate(<?= $row['id'] ?>) " type="checkbox" name="check" <?php
                                                                                                                        $expire_date = date("Y-m-d", strtotime("-30 days"));
                                                                                                                        $dat_ins = $row['dat_ins'];


                                                                                                                        if (strtotime($expire_date) <= strtotime($dat_ins)) {
                                                                                                                            echo "checked";
                                                                                                                        } ?> id="<?= $row['id'] ?>" class="checkboxInput">
                                        <label for="<?= $row['id'] ?>" class="toggleSwitch">
                                        </label>
                                    </td>


                                    <td>
                                        <i onclick="aff_det(<?php echo $row['id']; ?>);  handeldettactio() ;" class="bi bi-eye det"></i>
                                    </td>
                                    <td>
                                        <a href="update_client.php?id=<?php echo $row['id']; ?>"><i class="bi bi-pencil-square" id="update"></i></a>
                                    </td>
                                    <td>
                                        <i class="bi bi-trash3" onclick="deleteC(<?php echo $row['id']; ?>)"></i>
                                    </td>
                                </tr>

                            <?php } ?>



                        </tbody>

                    </form>
                </table>
            </div>
            <!-- excel-dilog -->
            
        <dialog data-modal>
            <form action="uploads.php" method="post" enctype="multipart/form-data">
                <label for="file" class="file"><i class="bi bi-file-earmark-arrow-up"></i>importer votre fichier </label>
                <input type="file" name="excel" id="file" required>
                <div class="butt">
                <input class="imp" type="submit" name="import" value="Importer">
                <button class="anul" type="submit" data-close-modal>annuler</button>
                </div>
            </form>
            </dialog>
            <div class=" uplod" data-open-modal >
                <button class="Btn">
                    <div class="sign">
                        <i class="bi bi-cloud-arrow-up"></i>

                    </div>

                    <div class="text">Importer un excel</div>
                </button>
            </div>
        </div>
    </div>

    <script>

const open = document.querySelector("[data-open-modal]");
const clos = document.querySelector("[data-close-modal]");
const model = document.querySelector("[data-modal]");

open.addEventListener("click",()=>{
    model.showModal();
});
clos.addEventListener("click",()=>{
    model.close();
})
</script>

    <script>
        function aff_det(id_client) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {



                if (this.readyState == 4 && this.status == 200) {
                    var nom_cli = document.getElementById('nom_cli');
                    var age = document.getElementById('age');
                    var tele = document.getElementById('tele');
                    var prix = document.getElementById('prix');
                    var date = document.getElementById('date');
                    var responseData = JSON.parse(this.responseText);
                    nom_cli.innerText = responseData.nom;
                    age.innerText = responseData.age;
                    tele.innerText = responseData.tele;
                    prix.innerText = responseData.prix;
                    date.innerText = responseData.date;

                }

            };
            xhttp.open("GET", "client_det.php?id_client=" + id_client, true);
            xhttp.send();
        }
    </script>





    <script>
        function updateDate(id_client) {
            alert('voulez vous vraiment modifier la date ?');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "client_date.php?id_client=" + id_client, true);
            xhttp.send();
        }
    </script>


    <script>
        function deleteC(id_client) {
            alert('voulez vous vraiment supprimer ?');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete_client.php?id=" + id_client, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>










    <script>
        flatpickr(".date", {});




        const bl = document.querySelector("#form_add");
        const close = document.querySelector(".close-icon");
        const add = document.querySelector("#add");
        bl.style.opacity = "0";
        bl.style.visibility = "hidden";
        if (sessionStorage.getItem("add") === "false") {
            sessionStorage.setItem("add", false);
        }

        add.addEventListener("click", function() {
            bl.style.opacity = "1";
            bl.style.visibility = "visible";
            sessionStorage.setItem("add", true);
        })
        if (sessionStorage.getItem("add") === "true") {
            bl.style.opacity = "1";
            bl.style.visibility = "visible";
        }

        close.addEventListener("click", function() {
            bl.style.opacity = "0";
            bl.style.visibility = "hidden";
            sessionStorage.setItem("add", false);


        });




        const bl2 = document.querySelector("#form_det");
        const close2 = document.querySelector(".close-icon2");
        const det = document.querySelector('.det')

        bl2.style.opacity = "0";
        bl2.style.visibility = "hidden";
        if (sessionStorage.getItem("det") === "false") {
            sessionStorage.setItem("det", false);
        }

        function handeldettactio() {
            bl2.style.opacity = "1";
            bl2.style.visibility = "visible";
            sessionStorage.setItem("det", true);
        }

        if (sessionStorage.getItem("det") === "true") {
            bl2.style.opacity = "1";
            bl2.style.visibility = "visible";
        }

        close2.addEventListener("click", function() {
            bl2.style.opacity = "0";
            bl2.style.visibility = "hidden";
            sessionStorage.setItem("det", false);


        });
    </script>

    



</body>

</html>
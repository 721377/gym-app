<?php
include 'side.php';
include 'config.php';
$stmt = mysqli_stmt_init($conn);
if (isset($_POST['save'])) {
    $email = $_POST['email'];   
    $nom =   $_POST['name'];
    $pass =  $_POST['pass'];
   




    $select = "SELECT * FROM `users` WHERE `email` = ?";


    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error[] = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);





        if (mysqli_num_rows($result) > 0) {
            $error[] = "this user is alredy exist!";
        } else {

            $insert = "INSERT INTO `users`(`nom`, `email`, `pass`) VALUES (?,?,?);";
            if (!mysqli_stmt_prepare($stmt, $insert)) {
                $error[] = "insert is failed";
            } else {
                mysqli_stmt_bind_param($stmt, "sss", $nom, $email, $pass);
                mysqli_stmt_execute($stmt);
                header('location:settings.php');
            }
        }
    }
}

$select = mysqli_query($conn, "SELECT * FROM `users`");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sittings</title>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/stin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

</head>

<body>


    
    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text"  placeholder="nom" id="" name="name" />
                    <span></span>
                    
                </div>
                <div class="txt_field">
                    <input type="email" placeholder="email"  required id="" name="email" />
                    <span></span>
                    
                </div>

                <div class="txt_field">
                    <input type="password" placeholder="mot de passe"  required id="" name="pass" />
                    <span></span>
                    
                </div>


                

               

                

                <button class="btn" type="submit" name="save">
                    ajouter
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

    <div class="holder">
        <div class="container">


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
            <div class="title font2">
                <h2>les profils</h2>
            </div>
           

            <div class="tableau">
                <table>
                    <thead>
                        
                        <tr class="font1">
                            <th>nom </th>
                            <th>email</th>
                            <th>mot de passe</th>
                            <th>action</th>
                        </tr>
                    </thead>


                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                            <tr>

                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['pass'] ?></td>
                                
                                <td>
                                <a class="trash" href="delete-user.php?id=<?= $row['id']?>"><i class="bi bi-trash3"></i></a>
                                </td>
                               
                            </tr>
                            
                        <?php } ?>
                       



                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <script>
      




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

        </script>

</body>

</html>
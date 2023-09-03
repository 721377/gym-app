<?php
include 'config.php';
include 'side.php';
$expire_date = date("Y-m-d", strtotime("-30 days"));
$expire = mysqli_query($conn, "SELECT * FROM `client` WHERE dat_ins <= '" . $expire_date . "'");

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
            <div class="title font2">
                <h2>les clinet non payer</h2>
            </div>
            <form action="">
                <div class="combobox">
                    <label class="comboboxlab font1" for="combo">Type d'utilisateur : </label>
                    <select name="" id="" class="select font3">
                        <option value="admin">admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </form>

            <div class="tableau">
                <table>
                    <thead>
                        <tr class="font1">
                            <th>nom complet</th>
                            <th>age</th>
                            <th>sport</th>
                            <th>date d'inscription</th>
                            <th>Telephone</th>
                            <th>prix</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($expire)) { ?>
                            <tr>

                                <td><?= $row['nom_com'] ?></td>
                                <td><?= $row['age'] ?></td>
                                <td><?= $row['sport'] ?></td>
                                <td><?= $row['dat_ins'] ?></td>
                                <td><?= $row['tele'] ?></td>
                                <td><?= $row['prix'] ?></td>
                            </tr>

                        <?php } ?>



                    </tbody>
                </table>
            </div>

        </div>
    </div>




</body>

</html>
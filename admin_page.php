<?php

// @include 'config.php';

// session_start();

// $expire_date = date("Y-m-d" ,strtotime("-30 days"));

// if(!isset($_SESSION['admin_name'])){
//    header('location:login_form.php');
// }


// if(isset($_POST['submit'])){
// $name = $_POST['nom'];
// $price =  $_POST['prix'];
// $date = $_POST['date'];
// $tele = $_POST['tele'];

// $insert = "INSERT INTO std_add(nam, prix, date, tele) VALUES('$name','$price','$date','$tele')";
//          mysqli_query($conn, $insert);
//          header('location:admin_page.php');
// }


// $sql = "SELECT * FROM std_add";
// $result = mysqli_query($conn, $sql);

// $count = "SELECT COUNT(nam) FROM std_add";
// $count_res = mysqli_query($conn, $count);
// $count_display = mysqli_fetch_assoc($count_res);
 
// $sum = "SELECT SUM(prix) FROM std_add";
// $sum_res = mysqli_query($conn, $sum);
// $sum_display = mysqli_fetch_assoc($sum_res);


   

// $expire = "SELECT * FROM std_add WHERE date <= '".$expire_date."'";
// $result_expir = mysqli_query($conn, $expire);

// function nopaye($result_expir){
    
//     while($exprow = mysqli_fetch_assoc($result_expir)) { 
  
//         echo '<tr>';
//              echo '<td>'.($exprow['nam']).'</td>';
//             echo '<td>' .($exprow['prix']).'</td>';
//              echo '<td>' .($exprow['date']).'</td>';
        
//              echo '</tr>';    
//              }

// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shet.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>dashbord</title>
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

   

    <section class="main">
       <div class="main-card">
       <div class="box">
            <i class='bx bx-user' ></i>
           <h2>Nombre D'etudients</h2>
           <h1 >2</h1>
        </div>

        <div class="box">
            <i class='bx bx-user' ></i>
           <h2>Nombre D'etudients</h2>
           <h1 >2</h1>
        </div>

        <div class="box">
            <i class='bx bx-user' ></i>
           <h2>Nombre D'etudients</h2>
           <h1 >2</h1>
        </div>

        <div class="box">
            <i class='bx bx-user' ></i>
           <h2>Nombre D'etudients</h2>
           <h1 >2</h1>
        </div>
            
          
       </div>
    </section>


       
      
        </div>
<script src="./myjs/index.js"></script>


<script>
    flatpickr(".date", {});
</script>


<script>
        const search = document.getElementById("t1");
        const rows = document.querySelectorAll("#tb tr");
        
        search.addEventListener("keyup", function(event){
            const q = event.target.value;
            rows.forEach(row => {
                row.querySelector('td').textContent.toLowerCase().startsWith(q)
                 ? row.style.display = ''
                  : (row.style.display = 'none');
            });
        });
    </script>

    <script>
        
        const tb_non = document.getElementById("table-two");
      const red = document.getElementById("point")
      var count = tb_non.rows.length-1;
      if(count>0){
            red.style.display="block";
      }
      red.innerHTML = count;
    </script>
  



</body>
</html>
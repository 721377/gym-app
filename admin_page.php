<?php

@include 'config.php';

session_start();

$expire_date = date("Y-m-d" ,strtotime("-30 days"));

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}


if(isset($_POST['submit'])){
$name = $_POST['nom'];
$price =  $_POST['prix'];
$date = $_POST['date'];
$tele = $_POST['tele'];

$insert = "INSERT INTO std_add(nam, prix, date, tele) VALUES('$name','$price','$date','$tele')";
         mysqli_query($conn, $insert);
         header('location:admin_page.php');
}


$sql = "SELECT * FROM std_add";
$result = mysqli_query($conn, $sql);

$count = "SELECT COUNT(nam) FROM std_add";
$count_res = mysqli_query($conn, $count);
$count_display = mysqli_fetch_assoc($count_res);
 
$sum = "SELECT SUM(prix) FROM std_add";
$sum_res = mysqli_query($conn, $sum);
$sum_display = mysqli_fetch_assoc($sum_res);


   

$expire = "SELECT * FROM std_add WHERE date <= '".$expire_date."'";
$result_expir = mysqli_query($conn, $expire);

function nopaye($result_expir){
    
    while($exprow = mysqli_fetch_assoc($result_expir)) { 
  
        echo '<tr>';
             echo '<td>'.($exprow['nam']).'</td>';
            echo '<td>' .($exprow['prix']).'</td>';
             echo '<td>' .($exprow['date']).'</td>';
        
             echo '</tr>';    
             }

}

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

   

    <div class="navig-cont">
    <div class="header">
        <div class="cher"> 
            <div class="menu">
                <i id="menu" style="font-size:28px;" class='bx bx-menu-alt-right'></i>
            </div>
            
            <input type="text" id="t1" placeholder="Recherchez"  id=""  ><i class='bx bx-search' ></i></div>
        <div class="set">
            <a href="#div" class="message" onclick="myFunction()">
        
            <div id="point" class="point"></div>
               
                
                <i id="bell" class='bx bx-bell'></i>
            </a>
            <div class="setteng">
                <i class='bx bx-cog'></i>
        </div>

        </div>
        <div class="log-out">
            <a href="logout.php">
            <i class='bx bx-log-out-circle'></i>deconnecter
        </a>
        </div>
    </div>
    <div class="nav-mom">
    <nav id="nav-bar">
        <ul>
            <li>
                <b></b>
                <b></b>
                <i class='bx bx-bar-chart-alt'></i>
                <a href="#home"> 
                    
                    statistiques
                </a>
            </li>

            <li>
                <b></b>
                <b></b>
                <i class='bx bx-table'></i>
                <a href="#div">
                  les eleves
                </a>
            </li> 

            <li>
                <b></b>
                <b></b>
                <i class='bx bxs-calendar-event' ></i>
                <a href="calander.php">
                   programme
                </a>
            </li>
           
            <li>
                <b></b>
                <b></b>
                <i class='bx bxs-file-export'></i>
                <a href="dowmload.php">
                    
                    exportez
                </a>
            </li>

            <li>
                <b></b>
                <b></b>
                <i class='bx bx-group'></i>
                <a href="">
                    
                    utilisateurs
                </a>
            </li>
        
            
        </ul>
    </nav>
</div>
</div>
<div class="img"></div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

!--form for add --!
<div class="bl" id="form">

    <div class="form-cont" >
        <form action="" method="post">
            <i class='bx bx-x' id="close"></i>
            <div class="icon">
                <i class='bx bx-user-plus' ></i>
            </div>

                <div class="txt_field">
                    <input type="text" required name="nom" id="">
                    <span></span>
                   <label for="">student name</label>
    
                </div>
                <div class="txt_field">
                    <input type="text" required name="prix" id="">
                    <span></span>
                   <label for="">Money</label>
    
                </div>
                <div class="txt_field">
                    <input class="date" type="date" placeholder="Date of inscription" required name="date" id="">
                    <span></span>
                    
                   
    
                </div>
                <div class="txt_field">
                    <input type="text" required name="tele" id="">
                    <span></span>
                   <label for="">Phone number</label>
    
                </div>

                    <input class="save" type="submit" name="submit" value="SAVE"> 
            
        </form>
    </div>

</div>
!--ends--!



<section class="home" id="home">
    <div class="chart-cont">
<div class="chart">
    <canvas id="myChart"></canva>
</div>

<div class="form">
    <form action="" method="post">
        <i class='bx bx-money-withdraw' ></i>
        <input class="text" placeholder="Revenus" type="text" name="" id="">
        <input class="date" placeholder="Mois" type="date" name="" id="">
        <input class="sub" type="submit" value="enregistrer">
    </form>
</div>
</div>

<section class="table">
    <h3>les eleves non payee</h3>
    <div align="center" class="table-box">
        
        <table id="table">
            <tr id="head">
                <th>nom d'etudiant</th>
                <th>Paiement</th>
                <th>date d'inscription</th>
            </tr>
            
           <?php nopaye(mysqli_query($conn, $expire))?>
           
        </table>
    </div>
</section>
</section>


<section class="div" id="div">

    <div class="cont">
        <div class="box1">
            <i class='bx bx-user' ></i>
           <h2>Nombre D'etudients</h2>
           <h1 ><?php echo implode($count_display) ?> </h1>
        </div>
        <div id="box" class="box2">
            <i class='bx bx-wallet' ></i>
            <h2>Revenus</h2>
           <h1 ><?php echo implode($sum_display)?></h1>
        </div>
    </div>
    <section class="tab">
       
       <div class="tab-cont">
       <div class="tab-add">
        <div class="a" id="add">
            <div class="add">
                <i class='bx bx-plus-circle'></i>
                nouveau eleve
            </div>
        </div>
        <div class="tab-disp">
    <div class="table-etudient">
        <table id="table">
            <tr id="head">
                <th>nom d'etudiant</th>
                <th>Paiement</th>
                <th>date d'inscription</th>
                <th>telephone</th>
                <th colspan="2">action</th>
            </tr>
            <tbody id="tb">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                   
                    <td><?php echo ($row['nam'])?></td>
                    <td><?php echo ($row['prix'])?></td>
                    <td><?php echo ($row['date'])?></td>
                    <td><?php echo ($row['tele'])?></td>
                    <td><a class="trash" href="supprimer.php?id=<?php echo ($row['id'])?>"><i class='bx bx-trash'></i></a></td>
                    <td><a class="edit" href="editer.php?id=<?php echo ($row['id'])?>"><i class='bx bx-edit-alt'></a></td>                    
                </tr>
                
                <?php } ?>
           
                </tbody>
          
        </table>
        </div>
    </div>

    <div id="table-nopay" class="table-nopay">
        <table id="table-two">
            <tr id="head">
                <th>les eleves non payee</th>
            </tr>
            <?php while($expr = mysqli_fetch_assoc($result_expir)) { ?>
  
             <tr>
      <td><?php echo ($expr['nam'])?></td> 
      
                 </tr>

      <?php }?>
            
            
        </table>
    </div>
</div> 
</div>
</section>
</section>

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
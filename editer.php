
<?php

@include 'config.php';

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




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body >
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>

*{
    margin:0;
    padding:0;
    list-style:none;
    text-decoration:none;
}

body{
    margin:0;
    padding:0;
    height:100vh;
    font-family:sans-serif;
    background: url(img/undraw_explore_re_8l4v.svg)no-repeat;
    background-size: cover;
    background-position: center;
    overflow: hidden;
}
.bl{
        position: fixed;
        top:0;
        left:0;
        width:100%;
        height:100vh;
        background: rgba(255, 255, 255, 0.17);
        backdrop-filter: blur(5.6px);
        -webkit-backdrop-filter: blur(5.6px);
        z-index: 11111;
        transition: 0.1s;
        font-family: 'dr';
    }
    .form-cont{
        z-index:111111111111;
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%, -50%);
        width:400px;
        height:560px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 8px 18px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(236, 238, 242, 0.37);
        overflow: hidden;
       
    }
   
    .form-cont i{
        position:absolute;
        right: 15px;
        top:10px;
        font-size: 30px;
        color:rgb(240, 119, 119);
    }
    .icon{
        position:relative;
        right:-68%;
        top:20px;
        display: inline-block;
        margin-bottom:38%;
       
    }
    .icon i{
        color:#82d393;
        font-size:60px;
        border: 1px solid #82d393;
        border-radius:50%;
        padding: 10px;
    }
    .form-cont form{
        padding:0 40px;
        box-sizing: border-box;
    }
    form .txt_field{
        position: relative;
        border-bottom: 1.5px solid  #516091;
        margin:34px 0;
       
    
    }
    .txt_field input{
       
    width:100%;
    padding:0 5px;
    height:40px;
    font-size: 15px;
    border: none;
    background: none;
    outline: none;
    }
    .txt_field label{
        
        position: absolute;
        top:50%;
        left:5px;
        color: #3d4e72;
        transform:translateY(-50%);
        font-size: 17px;
        pointer-events:none;
        transition: .1s ;
     
    }
    .txt_field span::before{
    content:'';
    position:absolute;
    top:40px;
    left:0;
    width: 0;
    height:2px;
    background:#88d498;
    
    }
    
    .txt_field .date::placeholder{
        color: #3d4e72;
        font-size: 17px;
        text-align: left;
        font-weight: lighter;
        font-family: 'dr';
        
    }
    
    .txt_field input:focus ~ label,
    .txt_field input:valid ~ label{
        top:-5px;
        color: #3d4e72;
        font-size: 18px;
    
    }
    .txt_field input:focus,
    .txt_field input:valid,
    .date {
        color: #3d4e72;
    }
    .txt_field input:focus ~ span::before,
    .txt_field input:valid ~ span::before{
       width:100%;
    
    }
    
    
    input[type="submit"]{
        width: 100%;
        height:50px;
        border: none;
        border-radius: 25px;
        background: #88d498;
        border-bottom: 25px;
        font-size: 19px;
        text-transform: uppercase;
        color:#FFFF;
        cursor: pointer;
        outline: none;
        transition:.1s;
        margin-top: 20px;
    }
    input[type="submit"]:hover{
        transform: scale(0.9);
    }

    </style>



<div class="bl" id="form">

    <div class="form-cont" >
        <form action="" method="post">
           <a  href="admin_page.php#div"><i class='bx bx-x' id="close"></i></a> 
            <div class="icon">
                <i class='bx bx-user-plus' ></i>
            </div>

                <div class="txt_field">
                    <input type="text" value="<?php echo ($row['nam'])?>"   name="nom" id="">
                    <span></span>
                   <label for="">student name</label>
    
                </div>
                <div class="txt_field">
                    <input type="text" value="<?php echo ($row['prix'])?>"  name="prix" id="">
                    <span></span>
                   <label for="">Money</label>
    
                </div>
                <div class="txt_field">
                    <input class="date" type="date" value="<?php echo ($row['date']) ?>" name="date" id="">
                    <span></span>
                    
                   
    
                </div>
                <div class="txt_field">
                    <input type="text" value="<?php echo($row['tele']) ?>"  name="tele" id="">
                    <span></span>
                   <label for="">Phone number</label>
    
                </div>

                    <input type="submit" name="submit" value="editer"> 
            
        </form>
    </div>

</div>


   
<script>
        flatpickr(".date", {});
    </script>


</body>

</html>




<?php
session_start();
$userInfo= isset($_SESSION['user'])?$_SESSION['user']:false;
echo $userInfo;
    require_once('../dbcon.php');
     //require_once('model.php');
        $dbserver ='localhost';
        $dbus ='root';
        $password='';
        $Avatar='';
        $dbname ='login';
        $connect_mysql = mysqli_connect($dbserver, $dbus, $password,$dbname);
        $mysql_db = mysqli_select_db($connect_mysql,'login');

        
        $isAdmin = 0;
        $email = '';
        if(isset($_COOKIE['email'])) {
           $email = $_COOKIE['email'];                  
        }
        if(isset($_COOKIE['Admin'])) {
            $isAdmin = $_COOKIE['Admin'];        
        }
        if($isAdmin == 1){
            $sql ="SELECT * FROM`user`";
        }else{
            $sql ="SELECT * FROM`user` WHERE `email` = '" . $_COOKIE['email'] . "'";
        }     
      
        $result = mysqli_query( $connect_mysql,$sql);
        if(isset($_GET['idel']) && !empty($_GET['idel'])){
           $id= $_GET['idel'];
            $sql_Del= mysqli_query( $connect_mysql,"DELETE FROM`user` WHERE `id` = '$id'");
            header('Location: http://localhost/BAITAP/ptable.php');
        }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng| APTECH</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
    .custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
    .custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
    </style>
<body>
<?php 

?>
<div class="container-fluid">
    <div class="row col-md-6 col-md-offset-2 custyle">
<form  method="POST">
<table class="table table-striped custab">
        <thead>
       <a href="../registration/sigin.php" class="btn btn-primary btn-xs pull-right"><b>+</b> Add username</a>
            <tr>
                <td>Ảnh đại diện</td>
                <td>ID</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Username</td>
                <td>Email</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php while($rows = mysqli_fetch_array($result)){?>
            <tr>
                <td>
                
                <?php 
                    if ($rows['Avatar']) {
                        echo "<img src=\"../uploads/".$rows['Avatar']."\" alt=\"\"width=\"100px\">";
                    }
                ?>
                </td>
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['firstname'];?></td>
                <td><?php echo $rows['lastname'];?></td>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['email'];?></td>               
                <?php
                echo "<td><button class=\"btn\"><a href=\"pupdate.php?id=".$rows['id']."\">Edit</a></button>";
                if($isAdmin == 1){
                echo    "<button class=\"btn\"><a href=\"pdelete.php?id=".$rows['id']."\">Delete</a></button>";
                }
                echo '</td>'
                ?>               
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
 </div>
</div>
</body>
</html>
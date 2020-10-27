<?php
    require_once('../dbcon.php');
     //require_once('model.php');
        $dbserver ='localhost';
        $dbus ='root';
        $password='';
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
        if ($isAdmin) {
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id= $_GET['id'];
                 $sql_Del= mysqli_query( $connect_mysql,"DELETE FROM`user` WHERE `id` = '$id'");
                 header('Location: http://localhost/BAITAP/users/ptable.php');
             }
        }
 ?>
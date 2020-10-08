<?php
require_once('../dbcon.php');
    $firstname='';
    $lastname='';
    $username='';
    $email='';
    $password='';
    $retypepassword='';
    $xml='';
    $error_fn='';
    $error_ln='';
    $error_us='';
    $error_email='';
    $error_pass='';
    $error_repass='';

    if(isset($_POST['submit'])){
        if(empty($_POST['firstname'])){
            $error_fn='Họ không được rỗng';
        }
        if(empty($_POST['lastname'])){
            $error_ln='tên  không được rỗng';
        }
        if(empty($_POST['username'])){
            $error_us='tên đăng nhập không được rỗng';
        }
        if(empty($_POST['email'])){
            $error_email='Email không được rỗng';
        }
        if(empty($_POST['password'])){
            $error_pass='Password không được rỗng';
        }elseif(($_POST['password']<5)){
            $error_pass='Pass lớn hơn 5 kí tự';
        }
        if(empty($_POST['retypepassword'])){
            $error_repass='Retypepassword không được rỗng';
        }
        if($_POST['password'] != $_POST['retypepassword']){
            $error_repass='Retypepassword nhập lại không đúng';
        }
        $tuser = $_POST['username'];
        $tema = $_POST['email'];
        $result = mysqli_query( $conn,"SELECT `username` FROM`user` WHERE `username` = '$tuser'");
        
         while($rows = mysqli_fetch_array($result)){
              $tbus=$rows['username'];
         }
        $result = mysqli_query( $conn,"SELECT `email` FROM`user` WHERE `email` = '$tema'");
        
         while($rows = mysqli_fetch_array($result)){
              $tbem=$rows['email'];
         }
        }else{$tbus = ''; $tbem = '';}
         if(empty($tbus)){
             $tb = 1;
         }else{
              $tb = 0;
         }
         if($tb == 0 ){
            $error_us ='Ten dang nhap da ton tai';
         }

         if(empty($tbem)){
             $tbem = 1;
         }else{
              $tbem = 0;
         }
         if($tbem == 0 ){
            $error_email ='email da ton tai';
         }
?>
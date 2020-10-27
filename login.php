<?php
require_once('dbcon.php');
session_start();
if(isset($_SESSION['user']) && !empty( $_SESSION['user'])){
               header('location: Admin.php');
                
           }
    $email='';
    $password=''; 
    $xml='';
    $error='';
    $username='';

    // if(isset($_POST['submit'])){
    //     unset($_COOKIE);
    // }
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $error='Email không được rỗng';
        }else{
            if(empty($_POST['password'])){
                $error='Password không được rỗng';
            }
        }
    }
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){
        $temail = $_POST['email'];
        $tpw = md5($_POST['password']);
        $admin = 0;
        $login= 0;
        $sql="SELECT * FROM `user` WHERE `email`='$temail' and `password`='$tpw'";
        $result = mysqli_query( $conn,$sql);
        //echo $sql;
        while($rows = mysqli_fetch_array($result)){
            $login=1;
            $admin= $rows['Admin'];
            // setcookie("email", $temail, time()+3600);
            // setcookie("Admin", $admin, time()+3600);
            
            $_SESSION['user']= $rows['username'];
            $userInfo= isset($_SESSION['user'])?$_SESSION['user']:false;
            // echo $userInfo;
           if(isset($_SESSION['user']) && !empty( $_SESSION['user'])){
               header('location: Admin.php');
                
           }
           

           
            $xml= 'Đăng nhập thành công';
        //lưu giá trí và không gửi lại biểu mẫu
        // setcookie("email", $_POST['email'],time()+600);
        // setcookie("pwd", md5($_POST['password']),time()+600);
        
        
        }
        // echo $login;echo $admin;
        // if($login ==1 && $admin ==1){
            
        //     header('location: Admin.php');
        //     echo $login;echo $admin;
        // }else{
        //     header('location: login.php');
        //     echo $login;echo $admin;
        // }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="head/css.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,400i|Noto+Sans:400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    </head>
    <style>
    span{
        color:red;
    }
    </style>
    <body>
        <div class="to">
            <div class="form">
                <form  method ="POST">
                    <h2>ĐĂNG NHẬP</h2>
                    <i class="fab fa-app-store-ios"></i>
                    <label >Email</label>
                    <input value="<?php echo $email;?>" type="email" name="email">
                    <br><span><?php echo $error;?></span>
                    <label>Password</label>
                    <input value="<?php echo $password;?>" type="password" name="password">
                    <br><span><?php echo $error;?></span>
                    <input id="submit" type="submit" name="submit" value="Login">
                    <?php echo $xml;?>
                </form>
            </div>                
        </div>
    </body>
</html>
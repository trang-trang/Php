<?php
    require_once 'register.php';
    //require_once '../dbcon.php';
    $title ='ĐĂNG KÝ | APTECH';
    $ptitle= 'Đăng ký';
    $id= isset($_GET['id'])?$_GET['id']:false;

    if(!isset($_GET['id']) && isset($_POST['submit'])  && !empty($_POST['username']) && !empty($_POST['email'])
    && !empty($_POST['password']) && !empty($_POST['retypepassword']) && ($_POST['password'] == $_POST['retypepassword']) && $tb == 1 && $tbem == 1){
        $us=isset($_POST['submit'])?$_POST['username']:false;
        $em=isset($_POST['submit'])?$_POST['email']:false;
        $ps= isset($_POST['submit'])?md5($_POST['password']):false;
        
        $sql = "INSERT INTO user (username,email,password)
        VALUES ( '$us','$em','$ps')";
        if ($conn->query($sql) === TRUE) {
            $xml = 'Đăng ký thành công';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
         $conn->close();
         header('location: http://localhost/BAITAP/title.php');
    }elseif(isset($_POST['submit1']) && !empty($_POST['username'])  && !empty($_POST['email'])
    && !empty($_POST['password']) && !empty($_POST['retypepassword']) && ($_POST['password'] == $_POST['retypepassword']) && isset($_GET['id']) && !empty($_GET['id'])){
        $us= isset($_POST['submit1'])?$_POST['username']:false;
        $em=isset($_POST['submit1'])?$_POST['email']:false;
        $ps= isset($_POST['submit1'])?md5($_POST['password']):false;
        $result = mysqli_query( $conn," UPDATE `user` SET `username`='$us', `email`='$em',`password`='$ps' WHERE `id` = '$id'");
        $xml = 'Sửa thông tin thành công';
    }
    $submit = 'submit';
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $title= 'Sửa thông tin';
        $submit = 'submit1';
        $ptitle= 'Sửa thông tin';
        $sql = mysqli_query( $conn,"SELECT * FROM`user` WHERE `id` = '$id'");
        while($rows = mysqli_fetch_array($sql)){
           
            $use= $rows['username'];
            $ema= $rows['email'];
        }
    }
    
    $use = isset($_GET['id'])?$use:false;
    $ema = isset($_GET['id'])?$ema:false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    background-color: #17a2b8;
    height: 100vh;
    }
    #login .container #login-row #login-column #login-box {
    margin-top: 120px;
    max-width: 800px;
    height: auto;
    border: 1px solid #9C9C9C;
    background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -85px;
    }
    .notice{
        color:red;
    }

    .oauth-buttons {
        text-align:center;
    }
    .oauth-buttons .fa{
        cursor:pointer;
        margin-top:10px;
        color:inherit;
        width:30px;
        height:30px;
        text-align:center;
        line-height:30px;
        margin:5px;
        margin-top:15px;
    }
    .oauth-buttons .fa:hover{
        color:white;
    }
    .oauth-buttons .fa-google-plus:hover{
        background: #dd4b39;
    }
    .oauth-buttons .fa-facebook:hover{
        background:	#8b9dc3;
    }

    .oauth-buttons .fa-linkedin:hover{
        background:	#0077b5;
    }

    .oauth-buttons .fa-twitter:hover{
        background:	#55acee;
    }

</style>
<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-sm-6">
                        <form  id="login-form" class="form" method="POST">
                            <h3 class="text-center text-info"><?php echo $title?></h3>
                            
                            <div class="form-group">
                                <label for="firstname" class="text-info">Firstname:</label><br>
                                <input type="text" name="username" id="username"  placeholder="Tên đăng nhập" class="form-control"><i class="notice"><?php echo $error_fn;?></i>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="text-info">Lastname:</label><br>
                                <input type="text" name="username" id="username"  placeholder="Tên đăng nhập" class="form-control"><i class="notice"><?php echo $error_ln;?></i>
                            </div>

                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" value="<?php echo $use;?>" placeholder="Tên đăng nhập" class="form-control"><i class="notice"><?php echo $error_us;?></i>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" placeholder="email" value="<?php echo $ema;?>" class="form-control"><i class="notice"><?php echo $error_email;?></i>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password"  placeholder="password" class="form-control"><i class="notice"><?php echo $error_pass;?></i>
                            </div>
                            <div class="form-group">
                                <label for="retypepassword" class="text-info">Retype Password:</label><br>
                                <input type="password" name="retypepassword" placeholder="retypepassword" class="form-control"><i class="notice"><?php echo $error_repass;?></i>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="<?php echo $submit;?>" class="btn btn-info btn-md " value="<?php echo $ptitle;?>">
                            </div>
                            <div class="form-group oauth-buttons">
                                <span><a href="https://vi-vn.facebook.com/"></a><i class="fa fa-facebook"></i> </span>
                                <span><i class="fa fa-google-plus"></i> </span>
                                <span><i class="fa fa-linkedin"></i> </span>
                                <span><i class="fa fa-twitter"></i> </span>
                            </div>
                            <?php echo $xml;?>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
</body>
</html>
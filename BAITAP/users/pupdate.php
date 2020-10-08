<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    require_once('../dbcon.php');
     //require_once('model.php');
        $dbserver ='localhost';
        $dbus ='root';
        $password='';
        $dbname ='login';
        $error='';
        $connect_mysql = mysqli_connect($dbserver, $dbus, $password,$dbname);
        $mysql_db = mysqli_select_db($connect_mysql,'login');
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * From `user` Where `id` = '$id'";
            if ($rs = mysqli_query($connect_mysql,$sql)) {
                $edituser = mysqli_fetch_assoc($rs);
            }
            if(isset($_POST['bsubmit'])){
                if(isset($_FILES['ifile'])){
                    $errors= array();
                    $file_name = $_FILES['ifile']['name'];
                    $file_size = $_FILES['ifile']['size'];
                    $file_tmp = $_FILES['ifile']['tmp_name'];
                    $file_type = $_FILES['ifile']['type'];
                    $file_ext=strtolower(end(explode('.',$_FILES['ifile']['name'])));
                    
                    $expensions= array("jpeg","jpg","png");
                    
                    if(in_array($file_ext,$expensions)=== false){
                        $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                    }
                    
                    if($file_size > 2097152) {
                        $errors[]='Kích thước file không được lớn hơn 2MB';
                    }
                    if(empty($errors)==true) {
                        $fullfile = $id.".".$file_ext;
                        move_uploaded_file($file_tmp,"../uploads/".$fullfile);
                        $sql = "UPDATE `user` SET `Avatar` = '$fullfile' WHERE `id` = '$id'";
                        $rs = mysqli_query($connect_mysql,$sql);
                        echo "Success";
                    } else {
                        print_r($errors);
                    }
                }
                if(empty($_POST['email'])){
                    $error='Email không được rỗng';
                } else if(empty($_POST['password'])){
                    $error='Password không được rỗng';
                } else {
                    $pusername = $_POST['username'];
                    $pemail = $_POST['email'];
                    $ppassword = md5($_POST['password']);
                    $firstname= $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $sql = "UPDATE `user` SET `firstname`='$firstname',`lastname`='$lastname',`username` = '$pusername',`email`='$pemail',`password`='$ppassword' WHERE `id` = '$id'";
                    if (mysqli_query($connect_mysql,$sql)) {
                        header('Location: http://localhost/BAITAP/users/ptable.php');
                    }
                }
            }
        }
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
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng | APTECH</title>
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
        <p><?php echo $error ?></p>
        <p>
            <form action="pupdate.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            
            <label for="firstname">Firstname:</label>
            <br>
            <input type="text" name="firstname" value="<?php echo $edituser['firstname'] ?>">
            <br>

            <label for="lastname">Lastname:</label>
            <br>
            <input type="text" name="lastname" value="<?php echo $edituser['lastname'] ?>">
            <br>

            <label for="lusername">Username:</label>
            <br>
            <input type="text" name="username" id="username" value="<?php echo $edituser['username'] ?>">
            <br>
            <label for="lemail">Email</label>
            <br>
            <input type="text" name="email" id="email" value="<?php echo $edituser['email'] ?>">
            <br>
            <label for="lpassword">Password</label>
            <br>
            <input type="password" name="password" id="password">
            <br>
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" name="ifile" id="ifile">
            <input class="btn btn-primary btn-xs" type="submit" name="bsubmit" value="Save">
            </form>
        </p>
    </div>
</div>
</body>
</html>
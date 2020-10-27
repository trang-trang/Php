<?php
    require_once('pregister.php');
        $dbserver ='localhost';
        $dbus ='root';
        $password='';
        $dbname ='login';
        $connect_mysql = mysqli_connect($dbserver, $dbus, $password,$dbname);
        $mysql_db = mysqli_select_db($connect_mysql,'login');

/*
kiểm tra điều kiện
    1. nếu đã đăng nhập thì cho vào xem danh sách người dùng
    if()
        1.1 kiềm tra thêm tài khoản này có phải là admin không
            1.1.1 nếu không là quản lý admin thì chỉ cho phép tháy mỗi mình người dùng đó thôi
                SELECT * FROM `user` WHERE `username` = 'trang'
            1.1.2 nếu là tài khoản quản trị thì cho xem hết
                SELECT * FROM`user`
    2. nếu chưa đăng nhập thì đẩy về trang login
*/

        $result = mysqli_query( $connect_mysql,"SELECT * FROM`user`");


        if(isset($_GET['idel']) && !empty($_GET['idel'])){
           $id= $_GET['idel'];
            $sql_Del= mysqli_query( $connect_mysql,"DELETE FROM`user` WHERE `id` = '$id'");
            header('Location: http://localhost/BAITAP/pupdate.php');
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
<div class="container-fluid">
    <div class="row col-md-6 col-md-offset-2 custyle">
<form  method="POST">
<table class="table table-striped custab">
        <thead>
       <a href="index.php" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Email</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php while($rows = mysqli_fetch_array($result)){?>
            <tr>
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['email'];?></td>
               
                <td>
                    <button><a href="index.php?id=<?php echo $rows['id']; ?>">Update</a></button>
                    /*
                        kiểm tra tài khoản có phải là admin thì mới hiện nút xóa
                        // cách đơn giản là làm 1 biến tổng kiểm tra ở đầu và gán vào giá trị isAdmin luôn
                    */              
                    <button name="del"><a href="ptable.php?idel=<?php echo $rows['id']; ?>">Delete</a></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
 </div>
</div>
</body>
</html>
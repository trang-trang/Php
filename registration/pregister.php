<?php
$dbname = 'login';
$servername ='';
$password='';
$us='root';
$conn = new mysqli($servername, $us, $password, $dbname);
         if ($conn->connect_error) {
            //Xuất thông báo lỗi và dừng chương trình
        die("Connection failed: " . $conn->connect_error);
        }   
?>
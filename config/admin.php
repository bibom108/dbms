<?php
$server   = "localhost";   // Khai báo server
$dbname   = "db_assignment";      // Khai báo database

$con = mysqli_connect($server,'db-admin','',$dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$con) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
   // echo "Kết nối thành công sẽ tiếp tục dòng code bên dưới đây."
?>
<?php
$server   = "localhost";   // Khai báo server
$dbname   = "db_assignment";      // Khai báo database

$manager = mysqli_connect($server,'db-manager','',$dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$manager) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
   // echo "Kết nối thành công sẽ tiếp tục dòng code bên dưới đây."
?>
<?php
$username = "db-admin"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "db_assignment";      // Khai báo database

// Kết nối database
$con = mysqli_connect($server, $username, $password, $dbname);
$student = mysqli_connect($server,'db-student','',$dbname);
$teacher = mysqli_connect($server,'db-teacher','',$dbname);
$stdcare = mysqli_connect($server,'db-customerserice','',$dbname);
$bra_mng = mysqli_connect($server,'db-manager','',$dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$con) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
   // echo "Kết nối thành công sẽ tiếp tục dòng code bên dưới đây."
?>
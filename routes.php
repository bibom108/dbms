<?php
$pages = array(
  'error' => ['errors'],
  'student' => ['layouts','login', 'register', 'profile', 'mycourse', 'myresult', 'myrequest', 'myrate', 'course'],
  'staff' =>['layouts', 'profile', 'mycourse', 'myresult', 'myrequest', 'myrate', 'course']
);
$controllers = array(
  //Admin controller
  'errors' => ['index'],
  'layouts' => ['index'], // Bổ sung thêm các hàm trong controllers
  'user' => ['index', 'add', 'editInfo', 'editPass', 'delete'],
  'login' => ['index', 'check', 'logout'],

  //Main controller
  'register' => ['index', 'submit', 'editInfo'],
  'profile' => ['index', 'update','layouts'],
  'mycourse' => ['index','delete','rateforcourse','search','layouts'],
  'myresult' => ['index','layouts'],
  'myrequest' => ['index','layouts'],
  'myrate' => ['index','layouts'],
  'course' => ['index']
  //'login' => ['index']
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if(!array_key_exists($page, $pages)) {
  echo "1";
}
if( !array_key_exists($controller, $controllers)) {
  echo $controller;
  echo "2";
}
if(!in_array($action, $controllers[$controller])) {
  echo "3";
}
if (!array_key_exists($page, $pages) || !array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $page = 'error';
  $controller = 'errors';
  $action = 'index';
}
if($page=='error'){
  $controller = 'errors';
  $action = 'index';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' .$page ."/" . $controller . '_controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();

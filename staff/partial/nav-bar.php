<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    // while ($token !== false)
    // {
    // echo "$token<br>";
    // $token = strtok(" ");
    // }
    $temp = strtok($url,"/"); 
    while($temp != false){
        $token = $temp;
        $temp = strtok("/");
    } 
?>
<div class="nav-bar-col">
    <ul>
        <li onclick="window.location.assign('../home.php');">
            <div class="text">Trang Chủ</div>
        </li>
        <li onclick="window.location.assign('./profile.php');"
            <?php  
                if($token == "profile.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Thông tin</div>
        </li>
        <li onclick="window.location.assign('./serviceStaff.php');"
            <?php  
                if($token == "serviceStaff.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Nhân Viên CSKH</div>
        </li>
        <li onclick="window.location.assign('./tutorStaff.php');"
            <?php  
                if($token == "tutorStaff.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Giảng Viên</div>
        </li>
        <li onclick="window.location.assign('./manageBranchStaff.php');"
            <?php  
                if($token == "manageBranchStaff.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Quản lí chi nhánh</div>
        </li>
        <li onclick="window.location.assign('./manageCourseStaff.php');"
            <?php  
                if($token == "manageCourseStaff.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Quản lí khoá học</div>
        </li>
        <li onclick="window.location.assign('./student.php');"
            <?php  
                if($token == "student.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Học Viên</div>
        </li>
        <li onclick="window.location.assign('./course.php');"
            <?php  
                if($token == "course.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Khoá học</div>
        </li>
        <li onclick="window.location.assign('./result.php');"
            <?php  
                if($token == "result.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Kết quả khoá học</div>
        </li>
        <li onclick="window.location.assign('./request.php');"
            <?php  
                if($token == "request.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Yêu cầu</div>
        </li>
        <li onclick="window.location.assign('./myrate.php');"
            <?php  
                if($token == "myrate.php"){
                echo "class = \"active\"";
            }?>
        >
            <div class="text">Đánh giá khoá học</div>
        </li>
    </ul>
</div>
<script src="./js/navbar.js"> 
</script>
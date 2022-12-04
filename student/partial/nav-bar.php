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
            <iconify-icon icon="material-symbols:home"></iconify-icon>
            <div class="text">Trang Chủ</div>
        </li>
        <li onclick="window.location.assign('./profile.php');"
            <?php  
                if($token == "profile.php"){
                echo "class = \"active\"";
            }?>
        >
            <iconify-icon icon="mdi:account"></iconify-icon>
            <div class="text">Thông tin học viên</div>
        </li>
        <li onclick="window.location.assign('./mycourse.php');"
            <?php  
                if($token == "mycourse.php"){
                echo "class = \"active\"";
            }?>
        >
            <iconify-icon icon="mdi:book-open-blank-variant"></iconify-icon>
            <div class="text">Khoá học của tôi</div>
        </li>
        <li onclick="window.location.assign('./myresult.php');"
            <?php  
                if($token == "myresult.php"){
                echo "class = \"active\"";
            }?>
        >
            <iconify-icon icon="mdi:web"></iconify-icon>
            <div class="text">Kết quả khoá học</div>
        </li>
        <li onclick="window.location.assign('./myrequest.php');"
            <?php  
                if($token == "myrequest.php"){
                echo "class = \"active\"";
            }?>
        >
            <iconify-icon icon="mdi:comment-question"></iconify-icon>
            <div class="text">Yêu cầu</div>
        </li>
        <li onclick="window.location.assign('./myrate.php');"
            <?php  
                if($token == "myrate.php"){
                echo "class = \"active\"";
            }?>
        >
            <iconify-icon icon="mdi:check-bold" ></iconify-icon>
            <div class="text">Đánh giá khoá học</div>
        </li>
    </ul>
</div>

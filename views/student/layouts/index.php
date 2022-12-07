<?php 
    session_start();
    require_once('./models/connection.php');
    
    $con = DB::getInstance();;
?>
  <head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="public/assets/css/header.css">
    <link rel="stylesheet" href="public/assets/css/footer.css">
    <link rel="stylesheet" href="public/assets/css/allcss.css">
    <link rel="stylesheet" href="public/assets/css/home.css">
    <!-- Icon CDN -->
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Text -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="landing">
        <?php 
          if (isset($_SESSION['idStudent'])) {
            require_once "./views/student/header-logined.php"; 
          }
          else require_once "./views/student/header-unlogin.php";
        ?>
        <div class="introduce-text">
          <div class="container-fluid !direction !spacing width-1280">
            <div class="row">
                <div class="col-5">
                  <div class="line-1">
                    VASCO
                  </div>
                  <div class="line-2">
                    We empower you to learn what you love.
                  </div>
                  <div class="button button-color-blue " onclick="window.location.assign('./course.php');">
                      LEARN MORE
                  </div>
                </div>
            </div>
          </div>
        </div>    
    </div>
    <div class="content">
      <div class="course-section width-1280">
          <div class="title">
              TOP COURSE
          </div>

          <div class="row">
          <?php 
                $i = 0;
                $output='';
                //$sqlcourse = mysqli_query($con,"SELECT * FROM course");
                $sqlcourse = $con->query("SELECT * FROM course");
                //$rowcourse = mysqli_fetch_assoc($sqlcourse);
                
                if ($sqlcourse->num_rows > 0) {
                  // output data of each row
                  while($rowcourse = $sqlcourse->fetch_assoc()) {
                    $courseid = $rowcourse["course_id"];
                    //var_dump("id: " . $rowcourse["course_id"]. " - Name: " . $rowcourse["name"]. "<br>");
                    $sqlteach = $con->query("SELECT DISTINCT * FROM teach WHERE course_id = '{$courseid}'");
                    $rowteach = $sqlteach->fetch_assoc();
                    $sqlteacher = $con->query("SELECT DISTINCT * FROM teacher, staff WHERE teacher_id = '{$rowteach['teacher_id']}' AND teacher_id = staff_id");
                    $rowteacher = $sqlteacher->fetch_assoc();
                    $i++;
                    $output .= '
                      <div class="course-item col-3">
                        <div class="image"> 
                          <img src="public/assets/images/course'. $i .'.jpg" alt="" style ="width: 100% !important">
                        </div>
                        <div class="text">
                          <div class="price">'.$rowcourse['fee'].'$</div>
                          <div class="title-course">'.$rowcourse['name'].'</div>
                          <div class="description-course">
                              <div class="author">'.$rowteacher['name'].'</div>
                              <div class="more">Xem Thêm >>></div>
                          </div>
                        </div>
                      </div>';
                      if($i> 7)break;
                    }
                    echo $output;
                  }
                ?>
          </div>
      </div>
      <div class="counter">
        <div class="row width-1280" style="margin: auto;">
            <div class="col-3 item">
              <div class="image">
                <img src="public/assets/images/cookie tracking.png" alt="">
              </div>
              <div class="text">
                <div class="amount">1257</div>
                <div class="title">TOP COURSE</div>
                <div class="description">Take courses from the world's best instruction and universities.</div>
              </div>
            </div>
            <div class="col-3 item">
              <div class="image">
                <img src="public/assets/images/child consent.png" alt="">
              </div>
              <div class="text">
                <div class="amount">99981</div>
                <div class="title">HAPPY LEARNER</div>
                <div class="description">Learner from all around the world.</div>
              </div>
            </div>
            <div class="col-3 item">
              <div class="image">
                <img src="public/assets/images/pseudonymisation 1.png" alt="">
              </div>
              <div class="text">
                <div class="amount">578</div>
                <div class="title">TUTORS</div>
                <div class="description">Learn your favorite course with world-class instructors.</div>
              </div>
            </div>
        </div>
      </div>
      <div class="instructor">
        <div class="title">OUSTANDING INSTRUCTOR</div>
          <div class="row">
            <?php 
               $i = 0;
               $output='';
               //$sqlcourse = mysqli_query($con,"SELECT * FROM course");
               $sqlteacher = $con->query("SELECT name FROM teacher, staff WHERE teacher.teacher_id = staff.staff_id");
               if ($sqlteacher->num_rows > 0) {
                // output data of each row
                while($rowteacher = $sqlteacher->fetch_assoc()) {
                  $i++;
                  $output .= '
                    <div class="col-3 item">
                      <div class="image">
                        <img src="public/assets/images/teacher'. $i .'.png" alt="">
                      </div>
                      <div class="text">
                        <div class="name">'.$rowteacher['name'].'</div>
                      </div>
                    </div>';
                    if($i> 3)break;
                }
                echo $output;
              }
            ?>
          </div>
      </div>
      <div class="letter">
        <div class="row width-980" style="margin: auto;">
          <div class="col-6 item">
            <img src="public/assets/images/image 1.png" alt="" style="width: 100%">
          </div>
          <div class="col-6 item">
            <div class="text">
              <div class="line-1">Get Regular <br> Updates from</div>
              <div class="line-2">VASCO</div>
            </div>
            <div class="input">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subscribe to Newsletter:</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
                <button type="submit" class="btn btn-primary mb-3">Subscribe</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require "./views/student/footer.php" 
        ?>

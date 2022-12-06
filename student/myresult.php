<?php
    session_start();
    include('../config/ketnoi.php');

    if (isset($_SESSION['idStudent'])) {
    }
    else {
        header('Location:../login.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Request</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/allcss.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/mycourse.css">
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
    <?php require "./partial/header-logined.php"?>
    <div class="content container-fluid !direction !spacing">
      <div class="row">
        <div class="col-3 navigation-bar">
          <?php require "./partial/nav-bar.php"?>
        </div>
        <div class="col-9">
          <div class="link row">
              <div class="text">Kết quả khoá học</div>
              <button type="button" class="btn btn-primary" onclick="window.location.assign('../course.php');">Đăng ký thêm khoá học</button>
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                          <div class="title row">
                            <h3 class="box-title">Kết quả</h3>                          
                          </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Khoá Học</th>
                                            <th>Tên Khoá học</th>
                                            <th>Giáo Viên Đánh Giá</th>
                                            <th>Điểm</th>
                                            <th>Đánh giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $output = '';
                                        $i = 0;
                                        // lựa chọn các kết quả của người đăng nhập mà giáo viên đã đánh giá
                                        $sqlresult = $con->query("
                                          SELECT result.score,result.comment, course.course_id , course.name AS course_name, staff.name AS teacher_name
                                          FROM (result INNER JOIN course ON result.course_id = course.course_id)
                                          INNER JOIN (
                                            teach INNER JOIN staff ON teach.teacher_id = staff.staff_id
                                          ) ON teach.course_id = result.course_id AND result.student_id = '{$_SESSION['idStudent']}'
                                        ");
                                        
                                        if ($sqlresult->num_rows > 0) {
                                          // output data of each row
                                          while( $rowresult = $sqlresult->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowresult['course_id'].'</td>
                                            <td>'.$rowresult['course_name'].'</td>
                                            <td>'.$rowresult['teacher_name'].'</td>
                                            <td>'.$rowresult['score'].'</td>
                                            <td>'.$rowresult['comment'].'</td>'; 
                                          }
                                        }                                         
                                        echo $output;
                                      ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
          </div>
        </div>
      </div>

    </div>
    <?php require "../partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
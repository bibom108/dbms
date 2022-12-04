<?php
    session_start();
    include('../config/ketnoi.php');

    if (true) {
    }
    else {
        header('Location:../login.php');
    }
    /*
      MỤC ĐÍCH PAGE NÀY
      SHOW TẤT CẢ CÁC ĐÁNH GIÁ CỦA HỌC VIÊN VỀ CÁC KHOÁ HỌC
    */
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Đánh Giá</title>
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
              <div class="text">Đánh giá của tôi</div>
              <button type="button" class="btn btn-primary">Thêm đánh giá</button>
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                          <div class="title row">
                            <h3 class="box-title">Đánh Giá</h3>                         
                          </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Khoá học</th>
                                            <th>Tên khoá học</th>
                                            <th>Học viên</th>
                                            <th>Thời Gian Yêu Cầu</th>
                                            <th>Nội Dung</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $i = 0;
                                        $output = '';
                                        $sqlrate = $con->query("SELECT review.content, course.name AS course_name, course.course_id, student.name AS student_name
                                        FROM (review INNER JOIN course ON review.course_id = course.course_id)
                                        INNER JOIN student ON review.student_id = student.student_id
                                        ");
                                        if ($sqlrate->num_rows > 0) {
                                          // output data of each row
                                          while($rowrate = $sqlrate->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowrate['course_id'].'</td>
                                            <td>'.$rowrate['course_name'].'</td>
                                            <td>'.$rowrate['student_name'].'</td>
                                            <td>Chưa có</td>
                                            <td>'.$rowrate['content'].'</td>
                                            ';
                                              if(true){
                                                $output.= '<td>
                                                            <button type="button" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                          </td>
                                                        </tr>';
                                            }
                                            else{
                                                $output.= '<td>
                                                            
                                                            </td>
                                                        </tr>';
                                            }
                                          }
                                          echo $output;
                                        }
                                        
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
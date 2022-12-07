<?php
    session_start();
    include('../config/ketnoi.php');

    if (isset($_SESSION['id']) and $_SESSION['type'] == 'Chăm sóc khách hàng') {
    }
    else {
      header('Location:./profile.php');
    }
    /*
      MỤC ĐÍCH PAGE NÀY
      SHOW TẤT CẢ CÁC ĐÁNH GIÁ CỦA HỌC VIÊN VỀ CÁC KHOÁ HỌC
    */

    if(isset($_POST['submitdelete'])){
      $student_id = $_POST['inputIDstudent'];
      $course_id = $_POST['inputIDcourse'];
      // Xóa đánh giá khoá học
      $query = "CALL DeleteReview('{$student_id}' , '{$course_id}')";
      //$query = "DELETE FROM review WHERE student_id='{$student_id}' AND course_id='{$course_id}'";
      $con->query($query);
    }
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
                                            <th>Thời Gian đánh giá</th>
                                            <th>Nội Dung</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $i = 0;
                                        $output = '';
                                        $sqlrate = $con->query("SELECT review.time, review.content, course.name AS course_name, course.course_id, student.name AS student_name, student.student_id
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
                                            <td>'.$rowrate['time'].'</td>
                                            <td>'.$rowrate['content'].'</td>
                                            ';
                                              
                                            $output.= '<td>
                                                        <button onclick="document.getElementById(\'inputIDstudent\').value = '.$rowrate['student_id'].'; document.getElementById(\'inputIDcourse\').value = '.$rowrate['course_id'].'" type="button" data-toggle="modal" data-target="#deleteRequestModal" class="btn btn-danger"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                      </td>
                                                    </tr>';
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
      <div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Quản Lý</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá đánh giá này chứ ?
              <form action="" method="post">
                <div class="form-group">
                  <input id="inputIDstudent" type="hidden" name="inputIDstudent" value="">
                  <input id="inputIDcourse" type="hidden" name="inputIDcourse" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="submit" name = "submitdelete" class="btn btn-danger">Yes</button>
                </div>
              </form>
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
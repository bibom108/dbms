<?php
    session_start();
    include('../config/student.php');

    if(isset($_POST['submitdanhgia'])){
      $id = $_POST['inputID'];
      $text = $_POST['inputText'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Kiểm tra sv đã đánh giá chưa
        $query = "SELECT * FROM review WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
        $res = $student->query($query);
        if ($res->num_rows > 0) {
          // Đã đánh giá
        }
        else {
          // Thêm vào đánh giá mới
          $query = "INSERT INTO review(student_id, course_id, content) VALUES('{$_SESSION['idStudent']}', '{$id}', '{$text}')";
          $student->query($query);
        }
      }
      else {

      }
    }

    if(isset($_POST['submithuylop'])){
      $id = $_POST['inputID'];
      // Kiểm tra sv đã nhấn hủy trước đó chưa
      $query = "SELECT * FROM accept WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}' AND type = 'OUT'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Đã nhấn hủy trước đó
      }
      else {
        // Thêm accept OUT mới
        $query = "INSERT INTO accept(course_id, student_id, type) VALUES('{$id}', '{$_SESSION['idStudent']}', 'OUT')";
        $student->query($query);
      }
    }

    if (isset($_SESSION['idStudent'])) {
      //nhận form bộ lọc và thiết lập where
      if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['course_filter'] = $_POST;
      }
      if(!empty($_SESSION['course_filter'])){
        $where = '';
        foreach($_SESSION['course_filter'] as $field =>$value){
          if(!empty($value)){
            $where .= (!empty($where)) ? " AND "."`".$field."` LIKE '%".$value."%'": "`".$field."` LIKE '%".$value."%'";
          }
        }
      }
    }
    else {
        header('Location:../login.php');
    }

    //select $sqlcourse to render 
    if(empty($where)){
      $sqlcourse =  $student->query("SELECT * FROM course 
        INNER JOIN(
          SELECT course_id 
            FROM study
            INNER JOIN(
                SELECT student_id
                FROM student    
            WHERE student_id = '{$_SESSION['idStudent']}'
            ) AS temp1
            on temp1.student_id = study.student_id
        ) AS temp2
        ON temp2.course_id = course.course_id
      ");
    }
    else {
      $sqlcourse =  $student->query("SELECT * FROM course 
        INNER JOIN(
          SELECT course_id 
            FROM study
            INNER JOIN(
                SELECT student_id
                FROM student    
            WHERE student_id = '{$_SESSION['idStudent']}'
            ) AS temp1
            on temp1.student_id = study.student_id
        ) AS temp2
        ON temp2.course_id = course.course_id
        WHERE (".$where.")
      ");      
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Profile</title>
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
              <div class="text">Khoá học của tôi</div>
              <button type="button" class="btn btn-primary"  onclick="window.location.assign('../course.php');">Đăng ký thêm khoá học</button>
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Khóa Học</h3>
                            <div class="course-search">
                              <form action="mycourse.php?action=search" method="post" id = "product-search-form">
                                  <fieldset>
                                      <legend>Lọc khoá học</legend>
                                        <select name="status" id="status">
                                          <option value="">All</option>
                                          <option value="In progress">In Progress</option>
                                          <option value="Finished">Finished</option>
                                        </select>
                                      <input type="submit" value="Lọc" />
                                  </fieldset>
                              </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Tên Khóa Học</th>
                                            <th>Cấp Độ</th>
                                            <th>Thời Lượng</th>
                                            <th>Ngày Bắt Đầu</th>
                                            <th>Giờ Học</th>
                                            <th>Tình trạng</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $output = '';
                                        $i = 0;
                                        if ($sqlcourse->num_rows > 0) {
                                          // output data of each row
                                          while( $rowcourse = $sqlcourse->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowcourse['course_id'].'</td>
                                            <td>'.$rowcourse['name'].'</td>
                                            <td>'.$rowcourse['level'].'</td>
                                            <td>'.$rowcourse['length'].'</td>
                                            <td>'.$rowcourse['start_date'].'</td>
                                            <td>'.$rowcourse['time'].'</td>
                                            <td>'.$rowcourse['status'].'</td>';
                                              
                                            if($rowcourse['status'] == "In progress"){
                                                $output.= '<td>
                                                            <button onclick="document.getElementById(\'inputID\').value = '.$rowcourse['course_id'].'" type="button" data-toggle="modal" data-target="#deleteCourseModal" class="btn btn-danger deletecourse" style="color: #fff; 
                                                            padding-right:18px;">Hủy Khóa Học</button>
                                                            </td>
                                                        </tr>';
                                            }
                                            else{
                                                $output.= '<td>
                                                            <button onclick="document.getElementById(\'inputID\').value = '.$rowcourse['course_id'].'" type="button" data-toggle="modal" data-target="#createModal" class="btn btn-success" style="color: #fff;">Đánh Giá</button>
                                                            </td>
                                                        </tr>';
                                            }
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
      <!-- Delete Request Modal -->
      <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá khoá học chứ ?
            </div>
            <form action="" method="post">
                <div class="form-group">
                  <input id="inputID" type="hidden" name="inputID" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submithuylop" type="submit" class="btn btn-danger">Yes</button>
                </div>
             </form>
          </div>
        </div>
      </div>
      <!-- Create Request Modal -->
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalTitle">Tạo Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputText">Nội dung</label>
                  <input type="text" style="height: 200px" class="form-control" id="inputText" placeholder="">
                  <input id="inputID" type="hidden" name="inputID" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submitdanhgia" type="submit" class="btn btn-primary">Đánh giá</button>
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
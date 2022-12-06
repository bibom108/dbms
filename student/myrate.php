<?php
    session_start();
    include('../config/student.php');

    if(isset($_POST['submitthaydoi'])){
      $id = $_POST['inputIDthaydoi'];
      $text = $_POST['inputText'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Sửa đánh giá
        $query = "UPDATE review SET content = '{$text}' WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
        $student->query($query);
      }
      else {
      }
    }

    if(isset($_POST['submitxoa'])){
      $id = $_POST['inputIDxoa'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Xóa đánh giá
        $query = "DELETE FROM review WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
        $student->query($query);
      }
      else {
      }
    }

    if (isset($_SESSION['idStudent'])) {
    }
    else {
        header('Location:../login.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Rate</title>
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
              <button type="button" class="btn btn-primary"  onclick="window.location.assign('../course.php');">Đăng ký thêm khoá học</button>
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
                                            <th>Thời Gian</th>
                                            <th>Nội Dung</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i = 0;
                                        $output = '';
                                        $sqlrate = $student->query(" SELECT review.content, review.time , course.name , course.course_id
                                        FROM review, course
                                        WHERE review.course_id = course.course_id AND review.student_id = '{$_SESSION['idStudent']}'
                                        ");
                                        if ($sqlrate->num_rows > 0) {
                                          // output data of each row
                                          while( $rowrate = $sqlrate->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowrate['course_id'].'</td>
                                            <td>'.$rowrate['name'].'</td>
                                            <td>'.$rowrate['time'].'</td>
                                            <td>'.$rowrate['content'].'</td>';

                                            $output.= '<td>
                                                        <button onclick="document.getElementById(\'inputIDxoa\').value = '.$rowrate['course_id'].'" type="button" data-toggle="modal" data-target="#deleteRequestModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                        <button onclick="document.getElementById(\'inputIDthaydoi\').value = '.$rowrate['course_id'].'" type="button" data-toggle="modal" data-target="#editRequestModal" class="btn btn-success"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
                                                      </td>
                                                    </tr>';
                                            
                                          }
                                          echo $output;
                                        }
                                        else echo 'Không có đánh giá nào';
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
      <!-- Create Request Modal -->
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalTitle">Tạo Đánh Giá</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Họ và Tên</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputID">ID Khoá Học</label>
                  <input type="number" class="form-control" id="inputEmail" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputText">Nội dung</label>
                  <input type="text" style="height: 200px" class="form-control" id="inputText" placeholder="">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Delete Request Modal -->
      <div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Đánh Giá</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá đánh giá này chứ ?
              <form action="" method="post">
                <div class="form-group">
                  <input id="inputIDxoa" type="hidden" name="inputIDxoa" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submitxoa" type="submit" class="btn btn-danger">Yes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Edit Request Modal -->
      <div class="modal fade" id="editRequestModal" tabindex="-1" role="dialog" aria-labelledby="editRequestModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalTitle">Chỉnh Sửa Đánh Giá</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputText">Nội dung</label>
                  <input name="inputText" type="text" style="height: 200px" class="form-control" id="inputText" placeholder="">
                  <input id="inputIDthaydoi" type="hidden" name="inputIDthaydoi" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submitthaydoi" type="submit" class="btn btn-primary">Lưu thay đổi</button>
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
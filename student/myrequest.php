<?php
    session_start();
    include('../config/student.php');

    if(isset($_POST['submitcreate'])){
      $id = $_POST['inputIDcreate'];
      $text = $_POST['inputTextcreate'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Kiểm tra sv đã có yêu cầu chưa chấp thuận hay ko
        $query = "SELECT * FROM request WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}' AND status = 0";
        $res = $student->query($query);
        if ($res->num_rows > 0) {
          // Đã có
        }
        else {
          // Thêm vào yêu cầu mới
          $query = "INSERT INTO request(student_id, course_id, content) VALUES('{$_SESSION['idStudent']}', '{$id}', '{$text}')";
          $student->query($query);
        }
      }
      else {
        // sv ko học khóa này hoặc id khóa học ko hợp lệ
      }
    }

    if(isset($_POST['submitdelete'])){
      $id = $_POST['inputIDxoa'];
      $table = $_POST['inputtablexoa'];
      if ($table == "accept") {
        // Xóa yêu cầu trong accept table
        $query = "DELETE FROM accept WHERE student_id='{$_SESSION['idStudent']}' AND course_id='{$id}'";
        $student->query($query);
      }
      else {
        // Xóa yêu cầu trong request table
        $query = "DELETE FROM request WHERE student_id='{$_SESSION['idStudent']}' AND course_id='{$id}' AND status = 0";
        $student->query($query);
      }
    }

    if(isset($_POST['submitchange'])){
      $id = $_POST['inputIDchange'];
      $text = $_POST['inputTextchange'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Sửa yêu cầu
        $query = "UPDATE request SET content = '{$text}' WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}' AND status = 0";
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
    <?php require "../partial/header-logined.php"?>
    <div class="content container-fluid !direction !spacing">
      <div class="row">
        <div class="col-3 navigation-bar">
          <?php require "./partial/nav-bar.php"?>
        </div>
        <div class="col-9">
          <div class="link row">
              <div class="text">Yêu cầu của tôi</div>
              <button type="button" class="btn btn-primary" onclick="window.location.assign('../course.php');">Đăng ký thêm khoá học</button>
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                          <div class="title row">
                            <h3 class="box-title">Yêu Cầu</h3>
                            <!-- Button trigger modal -->                          
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                              <iconify-icon icon="material-symbols:add-box"></iconify-icon>Tạo yêu cầu
                            </button>
                          </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Khoá học</th>
                                            <th>Tên Khoá học</th>
                                            <th>Thời Gian</th>
                                            <th>Nội Dung</th>
                                            <th>Trạng thái</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $i = 0;
                                        $output = '';
                                        $sqlrequest = $student->query("SELECT request.content, request.status , request.time , course.name AS course_name, course.course_id
                                                                   FROM request, course
                                                                   WHERE request.course_id = course.course_id AND request.student_id = '{$_SESSION['idStudent']}'");
                                        $acceptquery = $student->query("SELECT *, accept.time AS reg_time FROM accept, course WHERE accept.course_id = course.course_id AND accept.student_id = '{$_SESSION['idStudent']}'");
                                        if ($sqlrequest->num_rows > 0) {
                                          // output data of each row
                                          while( $rowrequest = $sqlrequest->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowrequest['course_id'].'</td>
                                            <td>'.$rowrequest['course_name'].'</td>
                                            <td>'.$rowrequest['time'].'</td>
                                            <td>'.$rowrequest['content'].'</td>';
                                              
                                              if($rowrequest['status'] == 0){
                                                $output.= '
                                                        <td>Chưa được duyệt</td>
                                                        <td>
                                                            <button onclick="document.getElementById(\'inputIDxoa\').value = '.$rowrequest['course_id'].'; document.getElementById(\'inputtablexoa\').value = \'request\'" type="button" data-toggle="modal" data-target="#deleteRequestModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                            <button onclick="document.getElementById(\'inputIDchange\').value = '.$rowrequest['course_id'].'" type="button" data-toggle="modal" data-target="#editRequestModal" class="btn btn-success"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
                                                          </td>
                                                        </tr>';
                                            }
                                            else{
                                                $output.= '<td>
                                                            Đã được duyệt
                                                            </td>
                                                        </tr>';
                                            }
                                          }
                                        }
                                        if ($acceptquery->num_rows > 0) {
                                          while( $rowaccept = $acceptquery->fetch_assoc()) {
                                            $i++;
                                            $acceptmsg = "";
                                            if ($rowaccept['type'] == "IN") {
                                              $acceptmsg = "Đăng kí khóa học";
                                            }
                                            else $acceptmsg = "Hủy khóa học";
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowaccept['course_id'].'</td>
                                            <td>'.$rowaccept['name'].'</td>
                                            <td>'.$rowaccept['reg_time'].'</td>
                                            <td>'. $acceptmsg .'</td>';
                                              
                                            if($rowaccept['time_acc'] == null){
                                                $output.= '
                                                        <td>Chưa được duyệt</td>
                                                        <td>
                                                            <button onclick="document.getElementById(\'inputIDxoa\').value = '.$rowaccept['course_id'].'; document.getElementById(\'inputtablexoa\').value = \'accept\'" type="button" data-toggle="modal" data-target="#deleteRequestModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                        </td>
                                                        </tr>';
                                            }
                                            else{
                                                $output.= '<td>
                                                            Đã được duyệt
                                                            </td>
                                                        </tr>';
                                            }
                                          }
                                        }
                                        if ($output == '') {echo 'Không có yêu cầu nào';}
                                        else echo $output;
            
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
              <h5 class="modal-title" id="createModalTitle">Tạo Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputIDcreate">ID Khoá Học</label>
                  <input type="number" class="form-control" id="inputIDcreate" name = "inputIDcreate" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputTextcreate">Nội dung</label>
                  <input type="text" style="height: 200px" class="form-control" id="inputTextcreate" name="inputTextcreate" placeholder="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" name = "submitcreate" class="btn btn-primary">Tạo yêu cầu</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Delete Request Modal -->
      <div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá yêu cầu chứ ?
              <form action="" method="post">
                <div class="form-group">
                  <input id="inputIDxoa" type="hidden" name="inputIDxoa" value="">
                  <input id="inputtablexoa" type="hidden" name="inputtablexoa" value="">
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
      <!-- Edit Request Modal -->
      <div class="modal fade" id="editRequestModal" tabindex="-1" role="dialog" aria-labelledby="editRequestModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalTitle">Chỉnh Sửa Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <input type="hidden" class="form-control" id="inputIDchange" name="inputIDchange" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputTextchange">Nội dung</label>
                  <input type="text" style="height: 200px" class="form-control" id="inputTextchange" name="inputTextchange" placeholder="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" name = "submitchange" class="btn btn-primary">Lưu thay đổi</button>
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
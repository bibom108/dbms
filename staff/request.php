<?php
    session_start();
    include('../config/ketnoi.php');
    if (isset($_SESSION['id']) and $_SESSION['type'] == 'Chăm sóc khách hàng') {
    }
    else {
      header('Location:./profile.php');
    }
    //giả sử login với 1 id là giáo viên 
    // if (true) {
    //   //nhận form bộ lọc và thiết lập where
    //   if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
    //     $_SESSION['course_filter'] = $_POST;
    //   }
    //   if(!empty($_SESSION['course_filter'])){
    //     $where = '';
    //     foreach($_SESSION['course_filter'] as $field =>$value){
    //       switch($field) {
    //         case 'status':
    //           if(!empty($value)){
    //             $where .= (!empty($where)) ? " AND "."`".$field."` LIKE ".$value."": "`".$field."` LIKE ".$value."";
    //           }
    //           break;
    //         default:
    //           if(!empty($value)){
    //             $where .= (!empty($where)) ? " AND "."`".$field."` LIKE '%".$value."%'": "`".$field."` LIKE '%".$value."%'";
    //           }
    //           break;
    //       }
    //     }
    //   }
    // }
    // else {
    //     header('Location:../login.php');
    // }

    /*
            MỤC ĐÍCH PAGE NÀY
            SHOW KẾT QUẢ ĐÁNH GIÁ CỦA GIÁO VIÊN ĐANG ĐĂNG NHẬP
    */
        //select $sqlcourse to render 

    if(empty($_POST['status']) and !isset($_POST['filter'])){
      $sqlrequest = $con->query("SELECT request.time, request.content, request.status, student.student_id  , student.name as student_name, course.name as course_name, course.course_id
      FROM (request INNER JOIN course ON request.course_id = course.course_id)
      INNER JOIN student ON student.student_id = request.student_id
      ");
    }
    else if ($_POST['status'] == 'a'){
      $sqlrequest = $con->query("SELECT request.time, request.content, request.status ,student.student_id , student.name as student_name, course.name as course_name, course.course_id
      FROM (request INNER JOIN course ON request.course_id = course.course_id)
      INNER JOIN student ON student.student_id = request.student_id
      ");
    }
    else {
      $sqlrequest = $con->query("SELECT request.time, request.content, request.status ,student.student_id  , student.name as student_name, course.name as course_name, course.course_id
      FROM (request INNER JOIN course ON request.course_id = course.course_id)
      INNER JOIN student ON student.student_id = request.student_id
      WHERE request.status = '{$_POST['status']}'
      ");   
    }
    if(isset($_POST['submitxoa'])){
      $id = $_POST['inputIDcourse'];
      $id_student = $_POST['inputIDstudent'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$id_student}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Xóa yêu cầu
        $query = "CALL DeleteRequest('{$id_student}', '{$id}')";
        //$query = "DELETE FROM request WHERE student_id = '{$id_student}' AND course_id='{$id}' AND status = 0";
        $student->query($query);
      }
      else {
      }
    }
    if(isset($_POST['submitduyet'])){
      $id = $_POST['acceptIDcourse'];
      $id_student = $_POST['acceptIDstudent'];
      // Kiểm tra sv có học khóa này ko
      $query = "SELECT * FROM study WHERE student_id = '{$id_student}' AND course_id = '{$id}'";
      $res = $student->query($query);
      if ($res->num_rows > 0) {
        // Chấp nhận yêu cầu
        $query = "CALL AcceptRequest('{$id_student}', '{$id}')";
        //$query = "UPDATE request SET request.status = '1' WHERE student_id = '{$id_student}' AND course_id='{$id}' AND status = 0";
        $student->query($query);
      }
      else {
      }
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
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                          <div class="title row">
                            <h3 class="box-title">Yêu Cầu</h3>
                            <!-- Button trigger modal -->                          
                          </div>
                          <div class="course-search">
                              <form action="" method="post" id = "product-search-form">
                                  
                                        <select name="status" id="status">
                                          <option value="a">All</option>
                                          <option value="1">Đã được duyệt</option>
                                          <option value="0">Chưa được duyệt</option>
                                        </select>
                                        <button type="submit" name="filter" class="btn btn-primary">Lọc</button>
                                  
                              </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Khoá học</th>
                                            <th>Tên Học viên</th>
                                            <th>Thời Gian</th>
                                            <th>Nội Dung</th>
                                            <th>Trạng Thái</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $output = '';
                                      $i = 0;
                                             
                                      if ($sqlrequest->num_rows > 0) {
                                        $i = 0;
                                        $output = '';
                                        while( $rowrequest = $sqlrequest->fetch_assoc()) {
                                          $i++;
                                          $output .= '<tr> 
                                          <td>'.$i.'</td>
                                          <td>'.$rowrequest['course_name'].'</td>
                                          <td>'.$rowrequest['student_name'].'</td>
                                          <td>'.$rowrequest['time'].'</td>
                                          <td>'.$rowrequest['content'].'</td>';
                                            
                                          if($rowrequest['status'] == 0){
                                              $output.= '
                                                      <td>Chưa duyệt</td>
                                                      <td style = "font-size: 18px">
                                                          <button type="button" data-toggle="modal" 
                                                          onclick="document.getElementById(\'acceptIDcourse\').value = '.$rowrequest['course_id'].'; document.getElementById(\'acceptIDstudent\').value = '.$rowrequest['student_id'].';"
                                                          data-target="#acceptRequestModal" class="btn btn-success"><iconify-icon icon="healthicons:yes"></iconify-icon></button>
                                                          <button type="button" 
                                                          onclick="document.getElementById(\'inputIDcourse\').value = '.$rowrequest['course_id'].'; document.getElementById(\'inputIDstudent\').value = '.$rowrequest['student_id'].';"
                                                          data-toggle="modal" data-target="#deleteRequestModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                        </td>
                                                      </tr>';
                                          }
                                          else{
                                              $output.= '<td>
                                                          Đã duyệt
                                                          </td>
                                                          <td style = "font-size: 18px">
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
      <!-- Create Request Modal -->
      <div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createRequestModalTitle">Tạo Yêu Cầu</h5>
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
            <div class="modal-header" style="background-color: #dc3545; color: white">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá yêu cầu chứ ?
            </div>
            <form action="" method="post">
                <div class="form-group">
                  <input id="inputIDstudent" type="hidden" name="inputIDstudent" value="">
                  <input id="inputIDcourse" type="hidden" name="inputIDcourse" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submitxoa" type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Accept Request Modal -->
      <div class="modal fade" id="acceptRequestModal" tabindex="-1" role="dialog" aria-labelledby="acceptRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
              <h5 class="modal-title" id="exampleModalLabel">Duyệt Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc duyệt yêu cầu chứ ?
            </div>
            <form action="" method="post">
                <div class="form-group">
                  <input id="acceptIDstudent" type="hidden" name="acceptIDstudent" value="">
                  <input id="acceptIDcourse" type="hidden" name="acceptIDcourse" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name = "submitduyet" type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
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
    <script>
      function get_IDCourse_IDStudent_Delete(){

      }
    </script>
  </body>
</html>
<?php
    session_start();
    include('../config/ketnoi.php');

    if (isset($_SESSION['id']) and ($_SESSION['type'] == 'Quản lý khóa học' or $_SESSION['type'] == 'Giáo viên')) {
    }
    else {
      header('Location:./profile.php');
    }

    if (isset($_POST['addcourse'])){
      $name = $_POST['inputName'];
      $level = $_POST['inputLevel'];
      $len = $_POST['inputLength'];
      $startdate = $_POST['inputStartDate'];
      $time = $_POST['inputTime'];
      $date = $_POST['inputDate'];
      $man = $_POST['inputManager'];
      $fee = $_POST['inputFee'];

      while (true){
        $id = rand(1000000, 1999999);
        $query = "SELECT * FROM course WHERE course_id = '{$id}'";
        $res = $con->query($query);
        if($res->num_rows == 0){
          break;
        }
      }
      
      $query = "INSERT INTO course(course_id, start_date, level, name, length, time, manager_id, fee) VALUES('{$id}', '{$startdate}', '{$level}', '{$name}', '{$len}', '{$time}', '{$man}', '{$fee}')";
      $con->query($query);
      $query = "INSERT INTO schedule(course_id, class_date) VALUES('{$id}', '{$date}')";
      $con->query($query);
    }

    if (true) {
      //Kiểm tra action và thực hiện lọc
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
    /*
          MỤC ĐÍCH PAGE NÀY
          SHOW TẤT CẢ CÁC KHOÁ HỌC HIỆN CÓ TRONG HỆ THỐNG
    */
    if(!empty($where)){
      $sqlcourse =  $con->query("
      SELECT *, co.name as course_name, staff.name as staff_name FROM
      (
        SELECT temp.class_date, course.* FROM course
        INNER JOIN(
          SELECT * FROM schedule
        ) temp
        ON temp.course_id = course.course_id
        WHERE (".$where.")
      ) co
      INNER JOIN staff
      ON co.manager_id = staff.staff_id
    ");
    }
    else {
      $sqlcourse =  $con->query("
        SELECT *, co.name as course_name, staff.name as staff_name FROM
        (
          SELECT temp.class_date, course.* FROM course
          INNER JOIN(
            SELECT * FROM schedule
          ) temp
          ON temp.course_id = course.course_id
        ) co
        INNER JOIN staff
        ON co.manager_id = staff.staff_id
    ");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Khoá Học</title>
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
                            <h3 class="box-title">Khoá học</h3>
                            <!-- Button trigger modal -->                          
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                              <iconify-icon icon="material-symbols:add-box"></iconify-icon>Tạo khoá học
                            </button>
                          </div>
                          <div class="course-search">
                            <form action="course.php?action=search" method="post" id = "product-search-form">
                                <fieldset>
                                    <legend>Tìm kiếm khoá học</legend>
                                    Tên khoá học <input type ="text" name ="name" value =""/>
                                    Cấp độ <input type ="text" name ="level" value =""/>
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
                                            <th>Tên Khoá Học</th>
                                            <th>Cấp Độ</th>
                                            <th>Thời Lượng</th>
                                            <th>Ngày Bắt Đầu</th>
                                            <th>Giờ Học</th>
                                            <th>Ngày Học</th>
                                            <th>Học Phí</th>
                                            <th>Người quản lí</th>
                                            <!-- <th>Tác vụ</th> -->
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
                                            <td>'.$rowcourse['course_name'].'</td>
                                            <td>'.$rowcourse['level'].'</td>
                                            <td>'.$rowcourse['length'].'</td>
                                            <td>'.$rowcourse['start_date'].'</td>
                                            <td>'.$rowcourse['time'].'</td>
                                            <td>'.$rowcourse['class_date'].'</td>
                                            <td>'.$rowcourse['fee'].'</td>
                                            <td>'.$rowcourse['staff_name'].'</td>';
                                             //khoá học kết thúc chưa nếu chưa thì có quyền huỷ khoá học nếu rồi thì được quyền đánh giá
                                            if(true){
                                                $output.= '<!-- <td>
                                                <button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-success"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
                                                <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                                            </td> -->
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
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Yes</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Create Request Modal -->
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createRequestModalTitle">Tạo mới khoá học</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Tên khoá học</label>
                  <input type="text" class="form-control" name="inputName" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputLevel">Cấp độ</label>
                  <input type="text" class="form-control" name="inputLevel" value="Beginner">
                </div>
                <div class="form-group">
                  <label for="inputLength">Thời lượng</label>
                  <input type="number" class="form-control" name="inputLength" value="10">
                </div>
                <div class="form-group">
                  <label for="inputStartDate">Ngày bắt đầu</label>
                  <input type="date" class="form-control" name="inputStartDate" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputTime">Giờ học</label>
                  <input type="time" class="form-control" name="inputTime" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputDate">Ngày học</label>
                  <input type="text" class="form-control" name="inputDate" value="Thứ 5">
                </div>
                <div class="form-group">
                  <label for="inputFee">Học phí</label>
                  <input type="number" class="form-control" name="inputFee" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputManager">ID Người quản lí khóa học</label>
                  <input type="text" class="form-control" name="inputManager" placeholder="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" name="addcourse" class="btn btn-primary">Thêm khóa học</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Edit Request Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createRequestModalTitle">Chỉnh sửa thông tin khoá học</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Tên khoá học</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Cấp độ</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Thời lượng</label>
                  <input type="number" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Ngày bắt đầu</label>
                  <input type="date" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Giờ học</label>
                  <input type="time" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Ngày học</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
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
    </div>
    <?php require "../partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
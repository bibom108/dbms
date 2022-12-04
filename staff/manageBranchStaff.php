<?php
    session_start();
    include('../config/ketnoi.php');
    $temp_manager_id = '6611311';
    if (true) {
    }
    else {
        header('Location:../login.php');
    }
    /*
          MỤC ĐÍCH PAGE NÀY
          SHOW TẤT CẢ CÁC NHÂN VIÊN QUẢN LÝ CHI NHÁNH, VÀ TẤT CẢ CÁC NHÂN VIÊN CÓ TRONG CHI NHÁNH HIỆN TẠI
    */
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Quản Lí Chi Nhánh</title>
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
              <div class="text">Quản Lí Chi Nhánh</div>  
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông Tin Nhân Viên Quản Lí</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Họ và Tên</th>
                                            <th>Địa Chỉ</th>
                                            <th>Giới Tính</th>
                                            <th>Ngày Sinh</th>
                                            <th>Chi Nhánh Quản Lí</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php 
                                      $sqlmanage_branch = $con->query("SELECT * FROM manager, staff 
                                        WHERE staff.staff_id = manager.manager_id AND manager.dept = 'Quản lí chi nhánh'
                                      ");
                                      if($sqlmanage_branch->num_rows > 0){
                                        $i = 0;
                                        $output = '';
                                        while($rowmanage_branch = $sqlmanage_branch->fetch_assoc()){
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowmanage_branch['manager_id'].'</td>
                                            <td>'.$rowmanage_branch['name'].'</td>
                                            <td>'.$rowmanage_branch['address'].'</td>
                                            <td>'.$rowmanage_branch['gender'].'</td>
                                            <td>'.$rowmanage_branch['dob'].'</td>
                                            <td>'.$rowmanage_branch['address'].'</td>';
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
                <div class="row" style="margin-top: 30px;">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông Tin Nhân Viên Khu Vực <?php 
                                //Lấy branch_id, địa chỉ của người quản lí đặt tạm thời là 6611311 
                                $sqlbranchis_managed = $con->query("SELECT * FROM branch WHERE manager_id = '{$temp_manager_id}'");
                                $rowbranchis_managed = $sqlbranchis_managed->fetch_assoc();
                                echo $rowbranchis_managed['address'];
                            ?></h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Họ và Tên</th>
                                            <th>Địa Chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Giới Tính</th>
                                            <th>Ngày Sinh</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php 
                                      $sqlstaffin_branch = $con->query("SELECT * FROM staff 
                                        INNER JOIN(
                                          SELECT branch_id
                                          FROM branch
                                          INNER JOIN(
                                            SELECT * 
                                            FROM manager
                                            WHERE manager_id = '{$temp_manager_id}'
                                          ) AS temp1
                                          ON temp1.manager_id = branch.manager_id
                                        ) AS temp2
                                        ON temp2.branch_id = staff.branch_id;
                                      ");
                                      if($sqlstaffin_branch->num_rows > 0){
                                        $i = 0;
                                        $output = '';
                                        while($rowstaffin_branch = $sqlstaffin_branch->fetch_assoc()){
                                            $i++;
                                            $output .= '<tr> 
                                            <td>'.$i.'</td>
                                            <td>'.$rowstaffin_branch['staff_id'].'</td>
                                            <td>'.$rowstaffin_branch['name'].'</td>
                                            <td>'.$rowstaffin_branch['address'].'</td>
                                            <td>'.$rowstaffin_branch['phone'].'</td>
                                            <td>'.$rowstaffin_branch['email'].'</td>
                                            <td>'.$rowstaffin_branch['gender'].'</td>
                                            <td>'.$rowstaffin_branch['dob'].'</td>';
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Yes</button>
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
    </div>
    <?php require "../partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
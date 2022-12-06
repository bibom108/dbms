<?php
    session_start();
    include('../config/ketnoi.php');
    if (isset($_SESSION['id']) and $_SESSION['type'] == 'Quản lý chi nhánh') {
    }
    else {
      header('Location:./profile.php');
    }
    /*
          MỤC ĐÍCH PAGE NÀY
          SHOW TẤT CẢ CÁC NHÂN VIÊN QUẢN LÝ CHI NHÁNH, VÀ TẤT CẢ CÁC NHÂN VIÊN CÓ TRONG CHI NHÁNH HIỆN TẠI
    */

    if(isset($_POST['createManager'])){
      $name = $_POST['inputName'];
      $gender = $_POST['gender'];
      $dob = $_POST['inputDate'];
      $phone = $_POST['inputPhone'];
      $email = $_POST['inputEmail'];
      $address = $_POST['inputAddress'];
      $branch = $_POST['inputBranch'];
      // Kiểm tra tuổi của nhân viên
      $bday = new DateTime($dob); // Your date of birth
      $today = new Datetime(date('y-m-d'));
      $diff = $today->diff($bday);
      if ($diff->y >= 18) {
        // Random ra id staff
        while (true){
          $id = rand(6000000, 6999999);
          $query = "SELECT * FROM manager WHERE manager_id = '{$id}'";
          $res = $con->query($query);
          if($res->num_rows == 0){
            break;
          }
        }
        // Thêm nhân viên quản lý chi nhánh mới
        $query = "INSERT INTO staff(staff_id, name, gender, dob, phone, email, address, role) VALUES('{$id}', '{$name}', '{$gender}', '{$dob}', '{$phone}', '{$email}', '{$address}', 'Quản lý chi nhánh')";
        $con->query($query);
        $query = "INSERT INTO manager(manager_id, dept) VALUES('{$id}', 'Quản lý chi nhánh')";
        $con->query($query);
        // Random ra id branch
        while (true){
          $br_id = rand(0000000, 9999999);
          $query = "SELECT * FROM branch WHERE branch_id = '{$br_id}'";
          $res = $con->query($query);
          if($res->num_rows == 0){
            break;
          }
        }
        $query = "INSERT INTO branch(branch_id, address, manager_id) VALUES('{$br_id}', '{$branch}', '{$id}')";
        $con->query($query);
        
        // Update lại branch của quản lí mới trong staff table 
        $query = "UPDATE staff SET branch_id = '{$br_id}' WHERE staff_id = '{$id}'";
        $con->query($query);
      }
    }

    // if(isset($_POST['submitdelete'])){
    //   $id = $_POST['inputIDxoa'];
    //   // Xóa quản lý chi nhánh trong staff
    //   $query = "DELETE FROM staff WHERE staff_id='{$id}'";
    //   $con->query($query);
    // }

    if(isset($_POST['submitedit'])){
      $id = $_POST['inputIDedit'];
      $name = $_POST['inputName'];
      $address = $_POST['inputAddress'];
      
      $query = "UPDATE staff SET name = '{$name}', address = '{$address}'  WHERE staff_id='{$id}'";
      $con->query($query);
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Quản Lý Chi Nhánh</title>
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
                              <h3 class="box-title">Thông Tin Nhân Viên Quản Lý Chi Nhánh</h3>
                              <!-- Button trigger modal -->                          
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createRequestModal">
                                <iconify-icon icon="material-symbols:add-box"></iconify-icon>Thêm quản lý
                              </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Họ và Tên</th>
                                            <th>Địa Chỉ cá nhân</th>
                                            <th>Giới Tính</th>
                                            <th>Ngày Sinh</th>
                                            <th>Chi Nhánh Quản Lý</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php 
                                      $sqlmanage_branch = $con->query("SELECT *, staff.address AS address, branch.address AS branch_address FROM manager, staff, branch
                                        WHERE staff.staff_id = manager.manager_id AND manager.dept = 'Quản lý chi nhánh' AND branch.manager_id = manager.manager_id 
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
                                            <td>'.$rowmanage_branch['branch_address'].'</td>';
                                            $output.= '
                                                <td style = "font-size: 18px">
                                                    <button onclick="document.getElementById(\'inputIDedit\').value = '.$rowmanage_branch['staff_id'].'" type="button" data-toggle="modal" data-target="#editRequestModal" class="btn btn-success"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
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
                <div class="row" style="margin-top: 30px;">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông Tin Nhân Viên theo Khu Vực </h3>
                            <div class="course-search">
                              <form action="" method="post">
                                  <!-- <fieldset>
                                      Khu vực <input type ="text" name ="type" value =""/>
                                      <input type="submit" value="Lọc" />
                                  </fieldset> -->
                                  <div class="form-group">
                                    <label for="area">Khu vực</label>
                                    <select name="area" id="area">
                                      <?php 
                                        $query = "SELECT * FROM branch";
                                        $branches = $con->query($query);
                                        $output = '';
                                        while($branch = $branches->fetch_assoc()){
                                          $output .= '<option value="'.$branch['branch_id'].'">'.$branch['address'].'</option>';
                                        }
                                        echo $output;
                                      ?>
                                    </select>
                                    <button type="submit" name="filter" class="btn btn-primary">Lọc</button>
                                  </div>
                              </form>
                            </div>          
                            
                            
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
                                      // $sqlstaffin_branch = $con->query("SELECT * FROM staff 
                                      //   INNER JOIN(
                                      //     SELECT branch_id
                                      //     FROM branch
                                          
                                      //   ) AS temp2
                                      //   ON temp2.branch_id = staff.branch_id;
                                      // ");
                                      $tmp = 'x';
                                      if (isset($_POST['area'])) {
                                        $tmp = $_POST['area'];
                                      }
                                      $query = "SELECT * FROM staff WHERE branch_id = '{$tmp}'";
                                      $sqlstaffin_branch = $con->query($query);
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
              Bạn có chắc sẽ xoá quản lý này chứ ?
              <form action="" method="post">
                <div class="form-group">
                  <input id="inputIDxoa" type="hidden" name="inputIDxoa" value="">
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
              <h5 class="modal-title" id="editRequestModalTitle">Thay đổi thông tin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Họ và Tên</label>
                  <input type="text" class="form-control" id="inputName" name = "inputName" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputAddress">Địa chỉ</label>
                  <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="">
                </div>
                <div class="form-group">
                  <input id="inputIDedit" type="hidden" name="inputIDedit" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" name = "submitedit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Create Request Modal -->
      <div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createRequestModalTitle">Thêm Quản Lý Chi Nhánh</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Họ và Tên</label>
                  <input type="text" class="form-control" id="inputName" name="inputName" placeholder="">
                </div>
                <div class="form-group">
                  <label for="gender">Giới tính</label>
                  <br>
                  <select name="gender" id="gender">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputDate">Ngày sinh</label>
                  <input type="date" class="form-control" id="inputDate" name="inputDate" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputPhone">Số điện thoại</label>
                  <input type="number" class="form-control" id="inputPhone" name="inputPhone" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputAddress">Địa chỉ</label>
                  <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="">
                </div>
                <div class="form-group">
                  <label for="inputBranch">Chi nhánh quản lý mới</label>
                  <input type="text" class="form-control" id="inputBranch" name="inputBranch" placeholder="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" name="createManager" class="btn btn-primary">Thêm quản lý</button>
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
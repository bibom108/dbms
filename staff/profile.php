<?php
    session_start();
    include('../config/ketnoi.php');
    //giả sử login với 1 id là giáo viên 
    if (true) {
        $sqlstaff = $con->query("SELECT * FROM staff WHERE staff.staff_id = '5511211' ");
        $rowstaff = $sqlstaff->fetch_assoc();
    }
    else {
        header('Location:../login.php');
    }
    /*
          MỤC ĐÍCH PAGE NÀY
          SHOW TẤT CẢ CÁC THÔNG TIN CỦA NGƯỜI ĐANG ĐĂNG NHẬP
    */
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
              <div class="text">Thông tin cá nhân</div>
              .<button type="button" class="btn btn-primary">Đăng ký thêm khoá học</button>
          </div>
          <div class="wrapper-content row"> 
            <div class="col-9">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputFname">Fullname: </label>
                    <input type="text" class="form-control" id="inputFname" readonly value="<?php echo $rowstaff['name'] ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputDoB">Date of Birth</label>
                    <input type="date" class="form-control" id="inputDoB" value="<?php echo $rowstaff['dob'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="text" class="form-control" id="inputEmail" value="<?php echo $rowstaff['email'] ?>">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputPhone">Phone number: </label>
                    <input type="number" class="form-control" id="inputPhone" value="<?php echo $rowstaff['phone'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" placeholder="********">
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress"  value="<?php echo $rowstaff['address'] ?>" >
                </div>
                <button type="submit" class="btn btn-primary">CẬP NHẬT THÔNG TIN</button>
              </form>
            </div>
            <div class="col-3 avatar-column">
              <div class="circle">
                <iconify-icon icon="material-symbols:camera-enhance-rounded"></iconify-icon>
              </div>
              <div class="line-1"><?php echo $rowstaff['name'] ?></div>
              <div class="line-2"><?php echo $rowstaff['email'] ?></div>
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
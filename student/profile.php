<?php
    session_start();
    include('../config/admin.php');

    if(isset($_POST['submit'])){
      $name = $_POST['inputFname'];
      $address = $_POST['inputAddress'];

      $query = "UPDATE student SET name = '{$name}', address = '{$address}' WHERE student_id = '{$_SESSION['idStudent']}'";
      $con->query($query);
    }

    if (isset($_SESSION['idStudent'])) {
        $sqlstudent =  $con->query("SELECT * FROM student WHERE student_id = '{$_SESSION['idStudent']}'");
        $rowstudent = $sqlstudent->fetch_assoc();
        $bday = new DateTime($rowstudent['dob']); // Your date of birth
        $today = new Datetime(date('y-m-d'));
        $diff = $today->diff($bday);
        if($diff->y >= 18){
            $sqlstudentcontact = mysqli_query($con, "SELECT * FROM studentt18 WHERE student_id = '{$_SESSION['idStudent']}'");
            $rowstudentcontact = mysqli_fetch_assoc($sqlstudentcontact);
        }
        else{
            $sqlstudentcontact = mysqli_query($con, "SELECT * FROM supervisor WHERE student_id = '{$_SESSION['idStudent']}'");
            $rowstudentcontact = mysqli_fetch_assoc($sqlstudentcontact);
        }
    }
    else {
        header('Location:../login.php');
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
              .<button type="button" class="btn btn-primary" onclick="window.location.assign('../course.php');">Đăng ký thêm khoá học</button>
          </div>
          <div class="wrapper-content row"> 
            <div class="col-9">
              <form action="" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputFname">Fullname: </label>
                    <input type="text" class="form-control" name="inputFname" id="inputFname" value="<?php echo $rowstudent['name'] ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputDoB">Date of Birth</label>
                    <input type="date" class="form-control" id="inputDoB" readonly value="<?php echo $rowstudent['dob'] ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="text" class="form-control" id="inputEmail" readonly value="<?php echo $rowstudentcontact['email'] ?>">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputPhone">Phone number: </label>
                    <input type="number" class="form-control" id="inputPhone" readonly value="<?php echo $rowstudentcontact['phone'] ?>">
                  </div>
                  <!-- <div class="form-group col-md-6 gender">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                      <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                      <label class="form-check-label" for="inlineRadio3">Other</label>
                    </div>
                  </div> -->
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" placeholder="********">
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" name="inputAddress" id="inputAddress"  value="<?php echo $rowstudent['address'] ?>" >
                </div>
                <button type="submit" id = "liveToastBtn" name ="submit" class="btn btn-primary">CẬP NHẬT THÔNG TIN</button>
              </form>
            </div>
            <div class="col-3 avatar-column">
              <div class="circle">
                <iconify-icon icon="material-symbols:camera-enhance-rounded"></iconify-icon>
              </div>
              <div class="line-1"><?php echo $rowstudent['name'] ?></div>
              <div class="line-2"><?php echo $rowstudentcontact['email'] ?></div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!--TOASTER-->
    <?php require "../partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
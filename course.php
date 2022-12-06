<?php 
    session_start();
    include('./config/admin.php');
    global $con;

    if(isset($_POST['submitsign'])){
      $id = $_POST['inputIDsign'];

      // Kiểm tra sv đã có yêu cầu chưa chấp thuận hay ko
      $query = "SELECT * FROM accept WHERE student_id = '{$_SESSION['idStudent']}' AND course_id = '{$id}' AND type = 'IN'";
      $res = $con->query($query);
      if ($res->num_rows > 0) {
        // Đã có
      }
      else {
        // Thêm vào yêu cầu mới
        $query = "INSERT INTO accept(student_id, course_id, type) VALUES('{$_SESSION['idStudent']}', '{$id}', 'IN')";
        $con->query($query);
      }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Khoá học</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/allcss.css">
    <link rel="stylesheet" href="./css/course.css">
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
    <div class="wrapper">
        <div class="landing-1">
            <?php 
            if (isset($_SESSION['idStudent'])) {
                require "./partial/header-logined.php"; 
            }
            else require "./partial/header-unlogin.php";
            ?>
            <div class="content course" style="margin: auto;">
                <h2 style="text-align: center; width: 100%; color: white; margin: 10px 0;"></h2>
                <?php 
                    $sqlcourse = $con->query("SELECT * FROM course");
                    if ($sqlcourse->num_rows > 0) {
                        $i = 0;
                        $output ='';
                        while($rowcourse = $sqlcourse->fetch_assoc()){
                           $check = 0;
                            $i++;
                            $output .='<div class="card card-body mt-3 course-item-horizontal">
                                <div class="media align-items-center text-center text-lg-left flex-column flex-lg-row">
                                    <div class="mr-2 mb-3 mb-lg-0"> <img src="./images/course'.$i.'.jpg" width="150" height="150" alt=""> </div>
                                    <div class="media-body">
                                        <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">ID Khóa Học: '.$rowcourse['course_id'].'</a> </h6>
                                        <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                            <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Cấp độ: '.$rowcourse['level'].'</a></li>
                                            <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"></a></li>
                                        </ul>
                                        <p class="mb-3">Thời lượng:  '.$rowcourse['length'].'</p>
                                        <p class="mb-3">Ngày Bắt Đầu: '.$rowcourse['start_date'].'</p>
                                        <p class="mb-3">Giờ Học: '.$rowcourse['time'].'</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                        <h3 class="mb-0 font-weight-semibold">$80000</h3>
                                        <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                        <div class="text-muted">
                                            Đánh giá của học viên <i class="fas fa-eye showrate"></i>
                                        </div>
                                        <div class="text-muted show-rate" style="display:none"></div>
                                        <form class="form-submit" action"addcourse.php">
                                            <input type="hidden" name="idcourse" id="idcourse" value="">';
                            if (isset($_SESSION['idStudent'])) {
                                $sqlstudy = $con->query("SELECT study.course_id FROM `study` 
                                INNER JOIN student ON student.student_id = study.student_id 
                                WHERE study.student_id = '{$_SESSION['idStudent']}'
                                ");
                                if($sqlstudy->num_rows > 0 ){
                                    while($rowstudy = $sqlstudy->fetch_assoc()){
                                        if($rowcourse['course_id'] == $rowstudy['course_id']){
                                            $output.='<button type="submit" disabled class="btn btn-success text-white mt-2 insertcourse"> Khoá học đã đăng ký </button></form>
                                            </div>
                                        </div>
                                    </div>';
                                            $check = 1;
                                            break;
                                        }
                                    }
                                }
                            }
                            if($check == 0)$output.='<button onclick="document.getElementById(\'inputIDsign\').value = '.$rowcourse['course_id'].'" type="button" data-toggle="modal" data-target="#createModal" style="color: #fff" class="btn btn-warning text-white mt-2 insertcourse"> Đăng Ký Khóa Học </button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                        echo $output;
                    }

                ?>
            </div>
        </div>
    </div>
    <!-- Create Request Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đăng kí khóa học</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Bạn có chắc đăng kí khóa học này?
            <form action="" method="post">
              <div class="form-group">
                <input id="inputIDsign" type="hidden" name="inputIDsign" value="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name = "submitsign" class="btn btn-success">Yes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require "./partial/footer.php" 
        ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

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
            <?php require "./partial/header-unlogin.php" ?>

            <div class="row content" style="margin: auto;">
                <h2 style="text-align: center; width: 100%; color: white; margin: 10px 0;">Khoá học ""</h2>
                <?php 
                    $output = '';
                    $output .='<div class="card card-body mt-3 course-item-horizontal">
                    <div class="media align-items-center text-center text-lg-left flex-column flex-lg-row">
                        <div class="mr-2 mb-3 mb-lg-0"> <img src="#" width="150" height="150" alt=""> </div>
                        <div class="media-body">
                            <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">ID Khóa Học:</a> </h6>
                            <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Cấp độ:</a></li>
                                <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"></a></li>
                            </ul>
                            <p class="mb-3">Thời lượng: </p>
                            <p class="mb-3">Ngày Bắt Đầu: </p>
                            <p class="mb-3">Giờ Học:</p>
                            <ul class="list-inline list-inline-dotted mb-0">
                                <li class="list-inline-item">Bấm vào đây để xem thêm <i id="myBtn"class="fas fa-eye showdetail"></i></li>
                                <div id="myModal" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content" style="width:40%" >
                                        <div class="modal-header">
                                            <h3>Teacher</h3>
                                            <span class="close">&times;</span>
                                            </div>
                                            <div class="modal-body">
                                            <p>Email:</p>
                                            <p>Giới tính:</p>
                                            </div>
                                            <div class="modal-footer">
                                            <h3></h3>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                            <h3 class="mb-0 font-weight-semibold">$80000</h3>
                            <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                            <div class="text-muted">
                                Đánh giá của học viên <i class="fas fa-eye showrate"></i>
                            </div>
                            <div class="text-muted show-rate" style="display:none"></div>
                            <form class="form-submit" action"addcourse.php">
                                <input type="hidden" name="idcourse" id="idcourse" value="">
                                <button type="submit" name="addcourse" class="btn btn-warning text-white mt-2 insertcourse"> Đăng Ký Khóa Học </button>
                            </form>
                        </div>
                    </div>
                </div>';
                    echo $output;
                ?>
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
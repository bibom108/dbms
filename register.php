<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/allcss.css">
    <link rel="stylesheet" href="./css/register.css">
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
    <div class="landing-1">
    <?php require "./partial/header-unlogin.php"?>
        <div class="row width-980 content" style="margin: auto;">
            <div class="title">Đăng ký</div>
            <div class="col-6" style="margin: auto;">
                <div class="default-login">
                    <form action="" method="post">
                        <div class="mb-3 user">
                            <label for="username" class="form-label">Họ và Tên</label>
                            <input type="email" class="form-control" id="username" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 user">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="email" class="form-control" id="username" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 user">
                            <label for="username" class="form-label">Email</label>
                            <input type="email" class="form-control" id="username" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 user">
                            <label for="username" class="form-label">Số điện thoại</label>
                            <input type="email" class="form-control" id="username" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 pwd">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div>
                                <input type="password" class="form-control" id="password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="mb-3 pwd">
                            <label for="password" class="form-label">Nhập lại mật khẩu</label>
                            <div>
                                <input type="password" class="form-control" id="password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="" id="">
                                <label for="">Chấp nhận các điều khoản</label>
                            </div>
                        </div>
                        <div class="row btn">
                            <div class="col-4">
                                <div class="button button-color-blue" onclick="window.location.assign('./home.php');">
                                    ĐĂNG KÝ
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="button button-color-blue blue-contrast" onclick="window.location.assign('./login.php');">
                                    TRỞ VỀ ĐĂNG NHẬP
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require "./partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
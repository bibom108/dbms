<?php
    session_start();
    include('../config/admin.php');

    if (isset($_SESSION['id'])) {
        header('Location:./profile.php');
    }
    else {
    }

    $error = [];
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];

        if(empty($username)){
            $error['username'] = 'Bạn chưa nhập tên tài khoản';
        }
        if(empty($pwd)){
            $error['pwd'] = 'Bạn chưa nhập password';
        }

        if(empty($error)){
            $query = 'SELECT * FROM user_management WHERE user = '.$username.' AND password = '.$pwd.';';
            $res = $con->query($query);
            if ($res->num_rows > 0) {
                $_SESSION['id'] = $username;
                $_SESSION['type'] = $res->fetch_assoc()['type'];
                header('Location:./profile.php');
            }
            else {
                $error['pwd'] = 'Sai tên đăng nhập hoặc mật khẩu';
            }
        }
    }

?>
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
    <link rel="stylesheet" href="./css/login.css">
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
            <div class="row width-1280 content" style="margin: auto;">
                <div class="image col-6">
                    <img src="./images/rafiki.png" alt="không load được">
                </div>
                <div class="col-5">
                    <div class="other-login">
                        <p>Đăng nhập với</p>
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    </div>
                    <div class="or"></div>
                    <div class="default-login">
                        <form action="" method="post" role="form">
                            <div class="mb-3 user">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" name = "username" class="form-control" id="username" placeholder="name@example.com">
                                <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['username']) ? $error['username'] : '';
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 pwd">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div>
                                    <input type="password" name = "pwd" class="form-control" id="password">
                                    <i class="fa fa-eye-slash" aria-hidden="true" id = "togglePassword"></i>
                                </div>
                                <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['pwd']) ? $error['pwd'] : '';
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <button class="button button-color-blue" name ="submit" type = "submit" onclick="window.location.assign('./home.php');">
                                ĐĂNG NHẬP
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "./partial/footer.php" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
  
            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
                
            password.setAttribute('type', type);

            // Toggle the eye and bi-eye icon
            togglePassword.classList.toggle('fa-eye');
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    session_start();
    include('./config/admin.php');
    
    if (isset($_SESSION['idStudent'])) {
        header('Location:./student/profile.php');
    }
    else {
    }

    $permitted_chars = '0123456789';
    function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }
    $error = [];
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $pwd = $_POST['pwd'];
        $repwd = $_POST['repwd'];
        $email = $_POST['email'];
        if(empty($username)){
            $error['username'] = 'Bạn chưa nhập tên tài khoản';
        }
        if(empty($pwd)){
            $error['pwd'] = 'Bạn chưa nhập password';
        }
        if(empty($fullname)){
            $error['fullname'] = 'Bạn chưa nhập họ và tên';
        }
        if(empty($phone)){
            $error['phone'] = 'Bạn chưa nhập số điện thoại';
        }
        if(empty($repwd)){
            $error['repwd'] = 'Hãy nhập lại password';
        }
        if(empty($email)){
            $error['email'] = 'Bạn chưa nhập email';
        }
        if(empty($error)){
            $id = generate_string($permitted_chars, 7);
            $sql = "INSERT INTO student (student_id, name) VALUES ('$id', '$fullname')";
            $query = mysqli_query($con, $sql);
            echo 'Đăng ký thành công';
            if($query)header("location: login.php");   
        }
        //chỗ này cần thay đổi nè
        
        // $sqlstudent = $con->query("SELECT name FROM student");
        // if ($sqlstudent->num_rows > 0) {
        //     // output data of each row
        //     while($rowstudent = $sqlstudent->fetch_assoc()) {
        //         echo $rowstudent['name'];
        //     }
        // }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!--   meta tags -->
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
                        <div class="mb-3 fullname">
                            <label for="fullname" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="fullname" placeholder="" name ='fullname'>
                            <div class="has-error">
                                <span> 
                                    <?php 
                                        echo isset($error['fullname']) ? $error['fullname'] : '';
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 user">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" placeholder="name" name ='username'>
                            <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['username']) ? $error['username'] : '';
                                        ?>
                                    </span>
                            </div>
                        </div>
                        <div class="mb-3 email">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name ='email'  >
                            <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['email']) ? $error['email'] : '';
                                        ?>
                                    </span>
                                </div>
                        </div>
                        <div class="mb-3 phone">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" id="phone" placeholder="" name ='phone'  >
                            <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['phone']) ? $error['phone'] : '';
                                        ?>
                                    </span>
                                </div>
                        </div>
                        <div class="mb-3 pwd">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div>
                                <input type="password" class="form-control password" id="password" name ='pwd'  >
                                <i class="fa fa-eye-slash togglePassword" aria-hidden="true"></i>
                            </div>
                            <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['pwd']) ? $error['pwd'] : '';
                                        ?>
                                    </span>
                                </div>
                        </div>
                        <div class="mb-3 pwd">
                            <label for="password" class="form-label">Nhập lại mật khẩu</label>
                            <div>
                                <input type="password" class="form-control password" id="re-password" name ='repwd'  >
                                <i class="fa fa-eye-slash togglePassword" aria-hidden="true"></i>
                            </div>
                            <div class="has-error">
                                    <span> 
                                        <?php 
                                            echo isset($error['repwd']) ? $error['repwd'] : '';
                                        ?>
                                    </span>
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
                                <button type = "submit" class="button button-color-blue" onclick="window.location.assign('./student/profile.php');">
                                    ĐĂNG KÝ
                                </button>
                            </div>
                            <div class="col-7">
                                <button class="button button-color-blue blue-contrast" onclick="window.location.assign('./login.php');">
                                    TRỞ VỀ ĐĂNG NHẬP
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require "./partial/footer.php"?>
    <script>
        const togglePasswords = Array.from(document
            .querySelectorAll('.togglePassword'));
        const password = Array.from(document.querySelectorAll('.password'));
        console.log(togglePasswords);
        console.log(password);
        togglePasswords.forEach((item,index) => {
            item.addEventListener('click', () => {
            
            // Toggle the type attribute using
            // getAttribure() method
            const type = password[index]
                .getAttribute('type') === 'password' ?
                'text' : 'password';
                
            password[index].setAttribute('type', type);

            // Toggle the eye and bi-eye icon
            item.classList.toggle('fa-eye');
            });
        })
    </script>
    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php  
 $HTTP_HOST = $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="./assets/libs/jquery-3.6.4.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="text-center">
                    <h3 class="text-info">Đăng Nhập</h3>
                </div>
        
               <form method='POST' action='/check_login' id="check_login_form">
           
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên Đăng Nhập:</label>
                        <input type="text" class="form-control" name="user_name" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật Khẩu:</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                   
                    <p class='text-center'>Bạn chưa có tài khoản ? <a href='/signup.php'>Đăng
                    ký</a></p>
                    <div id="error_handing">

                    </div>
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php  include_once "./page-js/js_login.php"; ?>
</html>
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
    <title>Resol | Đăng Ký</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="text-center">
                    <h3 class="text-info">Đăng Ký</h3>
                </div>
           
                <form action='/user/create_user' method='POST' enctype='multipart/form-data' id="signup_form">
               

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên Đăng Nhập:</label>
                        <input type="text" class="form-control" name="user_name" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật Khẩu:</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Họ Và Tên:</label>
                        <input type="text" class="form-control" name="full_name" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Số Điện Thoại:</label>
                        <input type="text" maxlength="10" class="form-control" name="fone_num"
                            aria-describedby="emailHelp">

                    </div>

                    <div id="error_handing">

                    </div>

                   
                    <p class='text-center'>Bạn đã có tài khoản ? <a href='/login.php'>Đăng
                    nhập</a></p>
                  
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Đăng Ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php  include_once "./page-js/js_signup.php"; ?>
</html>
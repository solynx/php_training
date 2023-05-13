<?php  $HTTP_HOST = $_SERVER["HTTP_HOST"];
   session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resol - Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
   <link rel="stylesheet" href="./assets/css/main.css">
   <script src="./assets/libs/jquery-3.6.4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="wrapper">
        <div class="wrapper-navbar">
            <nav class="navbar navbar-expand-lg navbar-light wrapper-navbar-list">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="#">Resol</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offset-sm-3 collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav d-flex flex_grow">
                            <li class="nav-item navbar-list-item">
                                <a class="nav-link  navbar-list-item-option" aria-current="page" href="#">Trang chủ</a>
                            </li>
                            <li class="nav-item navbar-list-item">
                                <a class="nav-link navbar-list-item-option" href="#contact">Liên Hệ</a>
                            </li>
                            <li class="nav-item navbar-list-item">
                                <a  class="nav-link navbar-list-item-option" href="/restaurant_area.php">Nhà Hàng</a>
                            </li>
                    
                            <?php  
                                if(isset($_SESSION["user_name"])) {
                                    if($_SESSION["user_name"] == "admin") {
                                       echo "<li class='nav-item navbar-list-item'>
                                       <a style='max-height: 165px;' class='nav-link navbar-list-item-option' href='/admin.php'>Trang Quản Trị</a>
                                   </li>";
                                    }
                                }
                                if(isset($_SESSION["user_name"])) {
                                   echo " <li class='nav-item navbar-list-item flex_grow' >
                                    <a class='nav-link navbar-list-item-option  float-end' style='font-size:12px' id='user_logout' href='/logout.php'>Đăng Xuất</a>
                                </li>";;
                                }
                                else{
                                  echo " <li class='nav-item navbar-list-item flex_grow'>
                                    <a class='nav-link navbar-list-item-option float-end'  style='font-size:12px' href='/login.php'>Đăng Nhập</a>
                                </li>";;
                                }
                            ?>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/high-angle-shot-table-with-elegant-setting-restaurant-hall-evening.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/serving-tables-wedding-old-restaurant.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/restaurant-hall-with-lots-table.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
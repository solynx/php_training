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
       <link rel='stylesheet' href='./assets/css/dashboard.css'>
       <title>Resol | Dashboard</title>
       <script src="./assets/libs/jquery-3.6.4.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
           integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
           crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   
   <body>
       <div class="wrapper d-flex">
        
<div class="sidebar">
    <div class="sidebar-brand text-center">
        <h4>Dashboard</h4>
    </div>
    <div class="sidebar-service">

        <div class="sidebar-service-item">
            <nav class="navbar">
                <div class="container-fluid">
                    <button class="navbar-toggler btn-show-restaurant" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar_restaurant_collapse" aria-controls="navbar_restaurant_collapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-gear" style="font-size:14px"></i>
                        <span style="font-size:14px">Quản Lý Nhà Hàng</span>
                    </button>

                </div>
            </nav>
            <div class="collapse" id="navbar_restaurant_collapse">
                <div>
                    <ul class="d-block" style="list-style-type:none">
                       
                        <li><a class='dropdown-item' id="new_restaurant" href='/new_restaurant'>Thêm Nhà Hàng</a>
                        </li>
                        <li><a class='dropdown-item' id="list_restaurent" href='/list_restaurant'>Danh Sách Nhà
                        Hàng</a></li>
                    
                        

                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar-service-item">
            <nav class="navbar">
                <div class="container-fluid">
                    <button class="navbar-toggler btn-show-restaurant" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar_order_collapse" aria-controls="navbar_order_collapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-gear" style="font-size:14px"></i>
                        <span style="font-size:14px">Đơn Đặt Bàn</span>
                    </button>

                </div>
            </nav>
            <div class="collapse" id="navbar_order_collapse">
                <div>
                    <ul class="d-block" style="list-style-type:none">
                     
                       <li><a class='dropdown-item' id="order_today" href='/order_today'>Đơn Hôm Nay</a></li>
                       <li><a class='dropdown-item' id="all_order" href='/all_order'>Tất Cả Đơn</a></li>
                    
                        

                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

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
    <link rel="stylesheet" href="assets/css/restaurant-area.css">
   <script src='/assets/libs/jquery-3.6.4.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Restaurant Area</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Khu Vực
                </div>
                <div class="col-sm-4 mt-3">
             
                  <form action='http://$HTTP_HOST/restaurant/area' method='POST' id='area_submit'>
              
                        <select  id="area_value" class="form-select" name="area_value" aria-label="Default select example">
                            <option selected>Chọn Khu Vực</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="Hồ Chí Minh">Thành Phố Hồ Chí Minh</option>
                        </select>
                        <button type="submit" class="btn btn-info mt-3">Tìm Kiếm</button>
                     
                      <a href='/index.php' class='btn btn-info mt-3 mx-2' >Về Trang Chủ</a>
                   
                    </form>
                   
                </div>
                <div class="container">
                        <div id="restaurant_detail" class="mt-3">

                        </div>
                </div>
                <div class="card-body">
                    
                    <div class="container">
                    
                        <div class="row" id="restaurant_list_filter">
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php  include_once "./page-js/js_restaurant-area.php";?>
</html>
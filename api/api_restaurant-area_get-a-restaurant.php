<?php  
session_start();
include_once "../includes/connect.php";



    $id = 1;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["id"])) {
            $id = $params["id"];
        }
    }

    $query ="SELECT * FROM tb_restaurant WHERE id='$id';";
    $result = mysqli_query($dbc,$query);
   
   
    $data["status"] = false;
    $data["data"] = "empty";
    if($result->num_rows) {
        $result = mysqli_fetch_assoc($result);
        extract($result);
        $data["status"] = true;
        $data["data"] = "<div class='card'>
        <img  src='uploads/".$image_url."' class='card-img-top img-max-height' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'>".$name."</h5>
            <p class='card-text'>
            <div><b>Số điện thoại:</b> <small>".$fone_number."</small></div>
            <div><b>Số chỗ:</b> <small>".$slot_num."</small></div>
            <div><b>Giá gốc:</b> <small><del>".number_format($price, 0, ',', '.')." VNĐ</del></small></div>
            <div><b>Giá ưu đãi:</b> <small>".number_format($sale_price, 0, ',', '.')." VNĐ</small></div>
            <div><b>Địa chỉ:</b> <small>".$address."</small></div>
            <div class='row'>
                <div class='col-6'>
                    <i class='fa fa-star' style='color:#ffc107'></i>
                    ".$star_total."
                </div>
                <div class='col-6'>
                    <small class='float-end'> ".$count_order." lượt đặt</small>
                </div>
            </div>
            </p>
            <div id='error_handing'></div>
            <div class='text-center'>
               <span class='d-flex' style='justify-content:space-evenly'>
                   
                       
                        <button  data-restaurant-id='$id' class='btn btn-info btn-order-table'>Đặt Bàn</button>
                  
                    <a href='home' id='hide-restaurant-detail' class='btn btn-info'>Quay Lại</a>
               </span>
            </div>
            <div id='confirm_order'></div>
            <div id='error_handing'></div>
        </div>
    </div>
    ";
    
    }
    



header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($dbc);

?>
<?php  
session_start();
include_once "../includes/connect.php";

if($_SESSION["user_name"] == "admin")
{
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
    $HtmlData = "";
    $data["status"] = true;
    if(!$result->num_rows) {
        $data["status"] = false;
    }
    while($restaurant = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                              $HtmlData= $HtmlData." <div class='card'>
                              <img src='/uploads/".$restaurant["image_url"]."' class='card-img-top' alt='...'>
                              <div class='card-body'>
                                  <h5 class='card-title'>".$restaurant['name']."</h5>
                                  <p class='card-text'>
                                  <div><b>Số điện thoại:</b> <small>".$restaurant['fone_number']."</small></div>
                                  <div><b>Số chỗ:</b> <small>".$restaurant['slot_num']."</small></div>
                                  <div><b>Giá gốc:</b> <small>".number_format($restaurant['price'], 0, ',', '.')." VNĐ</small></div>
                                  <div><b>Giá ưu đãi:</b> <small>".number_format($restaurant['sale_price'], 0, ',', '.')." VNĐ</small></div>
                                  <div><b>Địa chỉ:</b> <small>".$restaurant['address']."</small></div>
                                  <div class='row'>
                                      <div class='col-6'>
                                          <i class='fa fa-star' style='color:#ffc107'></i>
                                          ".$restaurant['star_total']."
                                      </div>
                                      <div class='col-6'>
                                          <small class='float-end'> ".$restaurant['count_order']." lượt đặt</small>
                                      </div>
                                  </div>
                                  </p>
                                  <div class='text-center'>
                                      <a href='back' id='hide_detail_restaurant' class='btn btn-info'>Quay lại</a>
                                  </div>
                              </div>
                          </div>";
                         
        }

$data['data'] = $HtmlData;

header('Content-Type: application/json');
echo json_encode($data);
mysqli_free_result($result); // giải phóng bộ nhớ
mysqli_close($dbc);
}
?>
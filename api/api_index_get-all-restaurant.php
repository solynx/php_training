<?php  
include_once "../includes/connect.php";


$query = "SELECT * FROM tb_restaurant ORDER BY count_order  DESC LIMIT 4";
$result = mysqli_query($dbc,$query);

$HtmlData = "";
while($restaurant = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $city = explode(", ", $restaurant['address']);
    $HtmlData = $HtmlData." <div class='col-sm-6 col-md-3'>
    <div class='card'>
        <img style='max-height: 165px;min-height:165px' src='./uploads/".$restaurant["image_url"]."' class='card-img-top' alt='...'>
        <div class='card-body'>
    <h5 class='card-title'>".$restaurant['name']."</h5>
    <p class='card-text'>

        <div><b>Khu vực:</b> <small>".end($city)."</small></div>
        <div class='row'>
            <div class='col-6'>
                <i class='fa fa-star' style='color:#ffc107'></i> ".$restaurant['star_total']."
            </div>
            <div class='col-6'>
            <small class='float-end'>   ".$restaurant['count_order']." lượt đặt</small>
            </div>
        </div>
    </p>

   
    <div class='text-center'>
        <button class='btn btn-info btn-view-restaurant' data-restaurant-id='".$restaurant["id"]."'>Xem Thông Tin</button>
    </div>
</form>
</div>
</div>
</div>";
}   
$data['restaurant_trending'] = $HtmlData;

$HtmlData = "";
$query = "SELECT DISTINCT * FROM tb_restaurant  LIMIT 4";
$result = mysqli_query($dbc,$query);
while($restaurant = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $city = explode(", ", $restaurant['address']);
    $HtmlData = $HtmlData." <div class='col-sm-6 col-md-3'>
    <div class='card'>
        <img style='max-height: 165px;min-height:165px' src='./uploads/".$restaurant["image_url"]."' class='card-img-top' alt='...'>
        <div class='card-body'>
    <h5 class='card-title'>".$restaurant['name']."</h5>
    <p class='card-text'>

        <div><b>Khu vực:</b> <small>".end($city)."</small></div>
        <div class='row'>
            <div class='col-6'>
                <i class='fa fa-star' style='color:#ffc107'></i> ".$restaurant['star_total']."
            </div>
            <div class='col-6'>
            <small class='float-end'>   ".$restaurant['count_order']." lượt đặt</small>
            </div>
        </div>
    </p>
    <div class='text-center'>
        <button class='btn btn-info btn-view-restaurant' data-restaurant-id='".$restaurant["id"]."'>Xem Thông Tin</button>
    </div>
</div>
</div>
</div>"; 
}
$data['restaurant_sales'] = $HtmlData;

$query = "SELECT * FROM tb_restaurant WHERE sale_price='99000'  LIMIT 4";
$result = mysqli_query($dbc,$query);
$HtmlData = "";
while($restaurant = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $city = explode(", ", $restaurant['address']);
    $HtmlData = $HtmlData." <div class='col-sm-6 col-md-3'>
    <div class='card'>
        <img style='max-height: 165px;min-height:165px' src='./uploads/".$restaurant["image_url"]."' class='card-img-top' alt='...'>
        <div class='card-body'>
    <h5 class='card-title'>".$restaurant['name']."</h5>
    <p class='card-text'>

        <div><b>Khu vực:</b> <small>".end($city)."</small></div>
        <div class='row'>
            <div class='col-6'>
                <i class='fa fa-star' style='color:#ffc107'></i> ".$restaurant['star_total']."
            </div>
            <div class='col-6'>
            <small class='float-end'>   ".$restaurant['count_order']." lượt đặt</small>
            </div>
        </div>
    </p>
    <div class='text-center'>
         <button class='btn btn-info btn-view-restaurant' data-restaurant-id='".$restaurant["id"]."'>Xem Thông Tin</button>
    </div>
</div>
</div>
</div>"; 
}
$data['restaurant_sale99'] = $HtmlData;

header('Content-Type: application/json');
echo json_encode($data);
mysqli_free_result($result); // giải phóng bộ nhớ
mysqli_close($dbc);
?>
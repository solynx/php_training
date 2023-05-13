<?php  
session_start();
include_once "../includes/connect.php";
include_once "../includes/functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["restaurant_name"];
    $address= $_POST["restaurant_address"];
    $fone_num = $_POST["restaurant_fone_num"];
    $slot = $_POST["restaurant_slot"];
    $price = $_POST["restaurant_price"];
    $sale_price= $_POST["restaurant_sale_price"];
   
    
    $file_name =random_string(36).$_FILES["restaurant_image"]["name"];
    header('Content-Type: application/json');
   
    $uuid = guidv4();
    $uuid2 = "7e592794-ec72-11ed-a05b-0242ac120003";
    $order_num = rand(20,200);
    $star = rand(20,50)/10;
    $query = "INSERT INTO tb_restaurant VALUES ('$uuid', '$name', '$star', '$slot','$price','$sale_price','$uuid2','$file_name ','$address','$fone_num','$order_num')";
  
    $result = mysqli_query($dbc,$query);
   
    $data["status"]= false;
    if($result) {
        move_uploaded_file($_FILES["restaurant_image"]["tmp_name"],"../uploads/".$file_name);
        $data["status"]= true;
       
    }
    header('Content-Type: application/json');
    echo json_encode($data);

    mysqli_close($dbc);
}
else{
    $data["status"] = "The request must be POST";
    echo json_encode($data);
    mysqli_close($dbc);
}

?>
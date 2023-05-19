<?php  
session_start();
include_once "../includes/connect.php";
include_once "../includes/functions.php";
include_once "../includes/validation.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['name'] = $_POST["restaurant_name"];
    $data['address']= $_POST["restaurant_address"];
    $data['fone_num'] = $_POST["restaurant_fone_num"];
    $data["slot"] = (int)$_POST["restaurant_slot"];
    $data["price"] = (int)$_POST["restaurant_price"];
    $data["sale_price"] = (int)$_POST["restaurant_sale_price"];
    $flag = false;
   
    //accept image .jpg , .png
    if(!imageValidate($_FILES["restaurant_image"])){
        $data['status'] = false;
        echo json_encode($data);die();
    }
   
    $data = antiSQLInjectionXSS($dbc,$data);
    extract($data);
    $file_name =random_string(36).$_FILES["restaurant_image"]["name"];
    header('Content-Type: application/json');
   
    $uuid = guidv4();
    $uuid2 = "7e592794-ec72-11ed-a05b-0242ac120003";
    $order_num = rand(20,200);
    $star = rand(20,50)/10;
    $query = $dbc->prepare("INSERT INTO tb_restaurant (id, name, star_total, slot_num, price, sale_price, owner_id, image_url, address, fone_number, count_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssdiiissssi", $uuid, $name, $star, $slot, $price, $sale_price, $uuid2, $file_name, $address, $fone_num, $order_num);
    $result=$query->execute();

    // $query = "INSERT INTO tb_restaurant VALUES ('$uuid', '$name', '$star', '$slot','$price','$sale_price','$uuid2','$file_name ','$address','$fone_num','$order_num')";
  
    // $result = mysqli_query($dbc,$query);
   
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
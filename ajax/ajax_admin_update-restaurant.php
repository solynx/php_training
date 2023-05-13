<?php  
session_start();
include_once "../includes/connect.php";
include_once "../includes/functions.php";
if($_SESSION["user_name"] == "admin") {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = 1;
        if($queryString=$_SERVER["QUERY_STRING"]) {
            $param= "";
            parse_str($queryString, $params);
            if(isset($params["id"])) {
                $id = $params["id"];
            }
        }

        $name = $_POST["restaurant_name"];
        $address = $_POST["restaurant_address"];
        $fone_num = $_POST["restaurant_fone_num"];
        $slot = $_POST["restaurant_slot"];
        $price = $_POST["restaurant_price"];
        $sale_price = $_POST["restaurant_sale_price"];
        $file_name = "";
        
        if($_FILES["restaurant_image"]["size"]) {
            $file_name =random_string(36).$_FILES["restaurant_image"]["name"];
        }
        $query = "UPDATE tb_restaurant SET name='".$name."', address='".$address."', 
        fone_number='".$fone_num."', slot_num='".$slot."', price='".$price."', 
        sale_price='".$sale_price."' ";
        $query = isset($file_name)?$query." , image_url='".$file_name."'"." WHERE id='".$id."';": $query." WHERE id='".$id."';";
        $result = mysqli_query($dbc,$query);
        $data["status"] = $result;
        if($file_name && $result) {
           $move= move_uploaded_file($_FILES["restaurant_image"]["tmp_name"],"../uploads/".$file_name);
           $data["status"] = $move;
        }
        
        header('Content-Type: application/json');
        echo json_encode($data);
 
        mysqli_close($dbc);
    }
}
?>
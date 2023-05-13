<?php  
session_start();
include_once "../includes/connect.php";
include_once "../includes/functions.php";
if(isset($_SESSION["user_name"])) {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $restaurant_id = $_POST["restaurant_id"];
        $time_common = $_POST["time_common"];
        $data["status"] = false;
        $query = "SELECT id from tb_user where user_name='".$_SESSION["user_name"]."';";
        $user_id = mysqli_query($dbc,$query);
            if($user_id->num_rows) {
                $uuid = guidv4();
                $current_time = date('Y-m-d H:i:s');
                $user_id= mysqli_fetch_assoc($user_id);
                $user_id = $user_id["id"];
                $query = "INSERT INTO tb_order VALUES ('$uuid', '$user_id', '$restaurant_id', '$time_common','$current_time','$current_time')";
                $result = mysqli_query($dbc,$query);
                $data["status"] = $result ? $result : false;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
         
            mysqli_close($dbc);
    }
}

?>
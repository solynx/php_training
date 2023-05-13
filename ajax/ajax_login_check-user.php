<?php  
session_start();
include_once "../includes/connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM tb_user WHERE user_name='".$user_name."' AND password ='".$password."';";
    $result = mysqli_query($dbc,$query);
    $data["status"] = $result->num_rows > 0 ? true : false;
    if($data["status"]) {
        $_SESSION["user_name"] = $user_name;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    mysqli_free_result($result); // giải phóng bộ nhớ
    mysqli_close($dbc);
}
else{
    $data["status"] = "The request must be POST";
    echo json_encode($data);
    mysqli_close($dbc);
}

?>
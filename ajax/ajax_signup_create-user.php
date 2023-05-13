<?php  
include_once "../includes/connect.php";
include_once "../includes/functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $password = md5($_POST["password"]);
    $full_name = $_POST["full_name"];
    $fone_number = $_POST["fone_num"];
    $email = $_POST["email"];
    $uuid = guidv4();
    $query = "INSERT INTO tb_user VALUES ('$uuid', '$user_name', '$password', '$email','$full_name','$fone_number');";
   
    $result = mysqli_query($dbc,$query);
    header('Content-Type: application/json');
   

    mysqli_close($dbc);
   
    if($result) {
    
        $data["status"]=true;
        echo json_encode($data);
        die();
    }
  
    $data["status"]=false;
    echo json_encode($data);
    die();

}

?>
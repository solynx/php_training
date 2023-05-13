<?php  
session_start();
include_once "../includes/connect.php";

if(isset($_SESSION["user_name"])) {
   

    $query ="SELECT full_name, fone_number FROM tb_user WHERE user_name='".$_SESSION["user_name"]."';";
    $result = mysqli_query($dbc,$query);
   
   
    $data["status"] = false;
    $data["data"] = "empty";
    if($result->num_rows) {
        $result = mysqli_fetch_assoc($result);
     
        $data["status"] = true;
        $data["data"] = $result;
    
    }
    



header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($dbc);

}
?>
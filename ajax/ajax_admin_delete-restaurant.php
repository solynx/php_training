<?php  
session_start();
include_once "../includes/connect.php";

if($_SESSION["user_name"] == "admin") {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $restaurantId = $_POST["id"];
      
        $query = "DELETE FROM tb_restaurant WHERE id= '$restaurantId'";

        $result = mysqli_query($dbc,$query);
        
        $data["status"] = $result;
        
        header('Content-Type: application/json');
        echo json_encode($data);
 
        mysqli_close($dbc);
    }
}

?>
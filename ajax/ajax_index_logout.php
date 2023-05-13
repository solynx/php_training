<?php  
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION["user_name"])) {
        unset($_SESSION["user_name"]);
        $data["status"] = true;
        echo json_encode($data);
        die();
    }
}

?>
<?php
session_start();  
include_once "../includes/connect.php";
if($_SESSION["user_name"] == "admin") {

    if($_SERVER["REQUEST_METHOD"] == "GET") {

        $query = "SELECT DISTINCT DATE(created_at) AS date_filter FROM tb_order GROUP BY date_filter ORDER BY date_filter ASC;";
        $result = mysqli_query($dbc,$query);
        $HtmlData="";
        while($date  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $formattedDate = date("j n Y", strtotime($date["date_filter"]));
            $HtmlData=$HtmlData."<option value='".$date["date_filter"]."'>$formattedDate</option>";
        }
        $data["date_history"] = $HtmlData;
        $data["status"] = true;

        header('Content-Type: application/json');
        echo json_encode($data);
        mysqli_free_result($result); 
        mysqli_close($dbc);

        
    }
}
?>
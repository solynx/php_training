<?php
session_start();  
include_once "../includes/connect.php";
if($_SESSION["user_name"] == "admin") {

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $area = "ABC";
        $offset = 0;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["area"])) {
            $area = $params["area"];
            $offset = $params["offset"];
        }
    }
   
    $query ="SELECT * FROM tb_restaurant WHERE address LIKE '%".$area."%' LIMIT 12 OFFSET $offset;";

    $result = mysqli_query($dbc,$query);

    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    $data['data'] = $result;
    $data['status'] = true;
        header('Content-Type: application/json');
        echo json_encode($data);
  
        mysqli_close($dbc);

        
    }
}
?>
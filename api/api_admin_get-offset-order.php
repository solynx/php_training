<?php
session_start();  
include_once "../includes/connect.php";

if($_SESSION["user_name"] == "admin") {
    
    $offset = 0;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["offset"])) {
            $offset = $params["offset"];
        }
    }


    $current_time = date('Y-m-d');

        $query ="select O.`time_common`, U.`full_name`,U.`fone_number`,R.`name` as restaurant_name from tb_order as O JOIN `tb_user` as U ON U.`id` = O.`user_id`
        JOIN `tb_restaurant` as R ON R.`id` = O.`restaurant_id` WHERE DATE(created_at) = '$current_time' LIMIT 12 OFFSET $offset;";
    
        $orders =mysqli_query($dbc, $query);
        $HtmlData = "";
    while($order  = mysqli_fetch_array($orders, MYSQLI_ASSOC)) {
        $offset ++;
        $HtmlData = $HtmlData."<tr>
            <th scope='row'>".$offset."</th>
            <td>".$order['full_name']."</td>
            <td>".$order['fone_number']."</td>
            <td>".$order['time_common']." Giờ</td>
            <td>".$order['restaurant_name']."</td>
            </tr>";
        
    }

    $data["orders"] = $HtmlData;
    $data["status"] = true;
    if(!$data["orders"]){
        $data["orders"] = "empty";
      
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    mysqli_free_result($orders); // giải phóng bộ nhớ
    mysqli_close($dbc);
}

?>
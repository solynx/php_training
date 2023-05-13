<?php
session_start();  
include_once "../includes/connect.php";
if($_SESSION["user_name"] == "admin") {

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $date = 1;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["date"])) {
            $date = $params["date"];
        }
    }
   
        $query ="select O.`time_common`, U.`full_name`,U.`fone_number`,R.`name` as restaurant_name from tb_order as O JOIN `tb_user` as U ON U.`id` = O.`user_id`
        JOIN `tb_restaurant` as R ON R.`id` = O.`restaurant_id` WHERE DATE(created_at) = '$date';";
   
        $result = mysqli_query($dbc,$query);
       
        $i=1;
        $HtmlData="";
        while($order  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $HtmlData=$HtmlData."<tr>
                                <th scope='row'>".$i."</th>
                                <td>".$order['full_name']."</td>
                                <td>".$order['fone_number']."</td>
                                <td>".$order['time_common']." Giờ</td>
                                <td>".$order['restaurant_name']."</td>
                            </tr>";
            $i++;
        }
        $data["orders"] = $HtmlData;
        $data["status"] = true;

        header('Content-Type: application/json');
        echo json_encode($data);
        mysqli_free_result($result); 
        mysqli_close($dbc);

        
    }
}
?>
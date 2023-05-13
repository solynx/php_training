<?php  
session_start();
include_once "../includes/connect.php";

if($_SESSION["user_name"] == "admin")
{
    $id = 1;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["id"])) {
            $id = $params["id"];
        }
    }

    $query ="SELECT * FROM tb_restaurant WHERE id='$id';";
    $result = mysqli_query($dbc,$query);
  
    $data["status"] = true;
    if(!$result->num_rows) {
        $data["status"] = false;
    }
    

$data['data'] = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($data);
mysqli_free_result($result); // giải phóng bộ nhớ
mysqli_close($dbc);
}
?>
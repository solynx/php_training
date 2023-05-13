<?php  
session_start();
include_once "../includes/connect.php";

if($_SESSION["user_name"] == "admin")
{
    $offset = 1;
    if($queryString=$_SERVER["QUERY_STRING"]) {
        $param= "";
        parse_str($queryString, $params);
        if(isset($params["offset"])) {
            $offset = $params["offset"];
        }
    }

    $query ="SELECT * FROM tb_restaurant LIMIT 12 OFFSET $offset;";
    $result = mysqli_query($dbc,$query);
    $HtmlData = "";
    $data["status"] = true;
    if(!$result->num_rows) {
        $data["status"] = false;
    }
    while($restaurant = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                              $HtmlData= $HtmlData."<tr>
                                    <th scope='row'>".$offset."</th>
                                    <td>".$restaurant['name']."</td>
                                    <td>".$restaurant['address']."</td>
                                    <td>".$restaurant['fone_number']."</td>
                                    <td>
                                       
                                            <div class='btn-group' role='group' aria-label='Basic example'>
                                               
                                                    <button class='btn btn-info btn-detail-restaurant' data-restaurant-id= ".$restaurant['id'].">
                                                    <i
                                                    class='fa fa-eye'></i></button>

                                                    <button class='btn btn-warning btn-edit-restaurant' data-restaurant-id= ".$restaurant['id'].">
                                                    <i
                                                        class='fa-solid fa-pencil'></i></button>

                                                    <button class='btn btn-danger btn-delete-restaurant' data-restaurant-id= ".$restaurant['id'].">
                                                    <i class='fas fa-trash'></i></button>
                                             
                                            </div>
                                        
                                    </td>
                                </tr>";
                            $offset++;
        }

$data['data'] = $HtmlData;

header('Content-Type: application/json');
echo json_encode($data);
mysqli_free_result($result); // giải phóng bộ nhớ
mysqli_close($dbc);
}
?>
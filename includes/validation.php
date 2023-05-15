<?php  
function antiSQLInjectionXSS ($dbc, $data=[]) {

    foreach($data as $column) {
        $column = mysqli_escape_string($dbc,$column);
        $column = htmlspecialchars($column, ENT_QUOTES, 'UTF-8');
    }

    return $data ;
}

function imageValidate($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
        $file_info = getimagesize($file["tmp_name"]);
        if ($file_info !== false && $file_info["mime"] == "image/jpeg") {
            $image_type_arr = array('jpg', 'jpeg', 'png');
            $uploaded_file = $file['tmp_name'];
            $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            
            if (!in_array($file_extension, $image_type_arr)) {
                    return false;
            } else {
               return true;
            }
        } else {
            return false;
        }
      } else {
            return false;
      }
}

?>
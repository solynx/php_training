<?php  

$dbc = new mysqli("localhost","root","","db_resol");

        
if($dbc->connect_errno) {
    trigger_error("Could not connect to DB: " . mysqli_connect_error());
	exit("Can't connect db....");
}
else {
    mysqli_set_charset($dbc, 'utf8');
}

define("BASE_URL", $_SERVER['SERVER_NAME']);
?>
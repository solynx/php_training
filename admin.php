<?php  
session_start();
if(!isset($_SESSION["user_name"]) || $_SESSION["user_name"] != "admin" ){
            include_once "./assets/html/404.html";
            die(); 
}
?>
 
 <?php
           //sidebar  
          include_once "./includes/admin_sidebar.php";
          include_once "./includes/admin_content.php";
?>
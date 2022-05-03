<?php 
session_start();
$conn = new mysqli("localhost","root","","user_access");
$errorMessage ='';

function cando ($pid) {
  return in_array($pid, $_SESSION["user"]["permissions"]);
}

function menu_url($pid)
{
   global $conn;
  	
      $menu_result = $conn->query("SELECT * FROM `permissions` WHERE `perm_id` IN ($pid)  ") ; 

      $menu_array = array();
      while($menu_row = $menu_result->fetch_assoc()){

         $menu_array[] = $menu_row;
      }
      return $menu_array;
}

$permission_id =  $_SESSION['user']['permissions'][0];
$menu_array = menu_url($permission_id);
?>
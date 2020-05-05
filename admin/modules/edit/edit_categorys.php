<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if (isset($_GET['submit'])) {
    
  $sql = "UPDATE `vehicle_category` SET `name` = '".$_GET["name"]."', `description` = '".$_GET["description"]."', `photo` = '".$_GET["photo"]."' WHERE `vehicle_category`.`id` = ".$_GET["id"].";";

  if($conn->query($sql)){
    header("location: /admin/categorys.php");
  }else{
    echo "Eror";
  }
}

?>

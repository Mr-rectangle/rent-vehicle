<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if (isset($_GET['submit'])) {
    
   $sql = "INSERT INTO `vehicle_category` (`name`, `description`, `photo`) VALUES ('".$_GET["name"]."', '".$_GET["description"]."', '".$_GET["photo"]."')";
  
  if($conn->query($sql)){
    header("location: /admin/categorys.php");
  }else{
    echo "Eror";
  }
}

?>
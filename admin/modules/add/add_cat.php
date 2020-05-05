<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if (isset($_POST['submit'])) {
	INSERT INTO `vehicle_category` (`id`, `name`, `description`, `photo`) VALUES (NULL, 'fgh', 'fgh', 'fgh');
  $sql = "INSERT INTO `vehicle_category` (`name`, `description`, `photo`) VALUES ('".$_POST["name"]."', '".$_POST["description"]."', '".$_POST["photo"]."')";

  if($conn->query($sql)){
    header("location: /admin/categories.php");
  }else{
    echo "Eror";
  }

}
?>
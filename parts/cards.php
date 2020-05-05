<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

$sql_vehicle = "SELECT * FROM vehicle WHERE vehicle_category_id =" . $cat['id'] . " LIMIT 6";
$result_vehicle = $conn->query($sql_vehicle);
while ($product = mysqli_fetch_assoc($result_vehicle)) {

include 'current-card.php';
}

?>
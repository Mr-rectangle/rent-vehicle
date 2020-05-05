<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*===========План=======================
Фактично все так як в додаванні тільки видаляємо
1.Створити таблицю в БД. для друзів
2.Створити ссилку на видалення з друзів
3.Створити сторінку в якій будемо обробляти 
	видалення користувачів з друзів
4.Перенаправляємо користувача на головну сторінку 
=======================================*/

if (isset($_GET["id"])) {
	//створюємо sql запит на видалення з таблиці друзів  
	//"DELETE FROM `categories` WHERE `categories`.`id` = 5"
	$sql = "DELETE FROM `vehicle_category` WHERE `vehicle_category`.`id` = ".$_GET["id"]."";
	// виконуємо запит і якщо все гаразд переходимо на головну
	
	if(mysqli_query($conn, $sql)) {
		header("Location: /admin/categorys.php");
	}else{
		//інакше виводимо помилку
		echo "<h2> Помилка </h2>";
	}
}
//SELECT * FROM `products` WHERE `id` = 6 ORDER BY `category_id` ASC
//DELETE FROM `products` WHERE `products`.`id` = 5
?>
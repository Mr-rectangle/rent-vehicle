<?php
//подключить базу данных
include $_SERVER["DOCUMENT_ROOT"] . '/configs/db.php';

//получить номер страницы из адресной строки 
$page = $_GET["page"];
//кол-во товаров для вывода (6 за каждую страницу)
$offset = $page * 6;

//выполнить запрос на 6 новых записей из БД
$sql_more = "SELECT * FROM vehicle LIMIT 6 OFFSET " . $offset;
//получить записи
$result_more = $conn->query($sql_more);
//извлечение массива
while ($product = mysqli_fetch_assoc($result_more) ) {
	include $_SERVER['DOCUMENT_ROOT'] . '/parts/current-card.php';
}
?>
<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';

/*
===================================
Поновлення даних про транспортні засоби в БД 
*/

 	
	if(isset($_POST["save_rent"])){	
			//якщо була зміненf модель і такої моделі нема в таблиці, то додаємо її
            //поновлюємо дані про vehicle за його id 
  			$sql3="UPDATE rent SET  `rent_status_id`='".$_POST["rent_status_id"]."', `payment_received`='".$_POST["payment_received"]."' WHERE `id`='" .$_POST["rent_id"]."'" ;
  			
  			
        	
        	if(mysqli_query($conn, $sql3)){
				echo "<h2>rent update</h2>";
				header("Location: info_rent.php?id=".$_POST['rent_id']);
				}else{
					echo "<h2>Erro</h2>".mysqli_error($conn);
				}
			
		
}
?>
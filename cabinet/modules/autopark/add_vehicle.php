<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
 
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
/*
===================================
Додавання товару в БД 
*/

	
	if(isset($_POST["add_vehicle"])&&$_POST["reg_number"]!=null){		
	//якщо змінна не порожня і файл зберігається у змінній file
		if(!empty($_FILES['file']['size'])){
			// визначення типу файлу
  			// $imageinfo = getimagesize($_FILES['file']['tmp_name']);
			// $arr = array('image/jpeg','image/gif','image/png','image/jpg');
			//перевірка чи відповідає тип завантаженого файлу одному типу із масива 
			// if(!array_search($imageinfo['mime'],$arr)) { 
			// 	echo ('Рисунок повинен бути формату JPG, GIF или PNG');
			// }
 		// 	else {
			//якщо фото змінене і відрізняється від завантаженого раніше, то виконуємо завантаження
				
				if (basename($_FILES['file']['name'])!=$_POST['current_file']){
				
					$photo =date('YmdHis').basename($_FILES['file']['name']);
					$path =$dir_img_vehicle.$photo;
					$mov = move_uploaded_file($_FILES['file']['tmp_name'],$path);
					if($mov) {
						//збереження імені файлу в тектсовому форматі
						$photo = htmlentities(stripslashes(strip_tags(trim($photo))),ENT_QUOTES,'UTF-8');
			  			}
				}
		}
		 else{
		  		$photo='vehicle_icon.jpg'; 
		  		}


			//якщо введеної моделі нема в таблиці, то додаємо її
			$sql = "SELECT * FROM model WHERE name='".$_POST['model_name']."'";
			var_dump($sql);
			$result=$conn->query($sql);

			if($row=mysqli_fetch_assoc($result)){
				$model_id=$row['id'];
			} else {
				$sql1="INSERT INTO `model` (`name`) VALUES ('".$_POST["model_name"]."')";
				var_dump($sql1);
				if(mysqli_query($conn, $sql1)){
					echo "<h2>model add</h2>";
				}else{
					echo "<h2>Erro</h2>".mysqli_error($conn);
				}
				$result1=$conn->query($sql1);
               	$sql2 = "SELECT id FROM model ORDER BY id DESC LIMIT 1";
               	
				$result2=$conn->query($sql2);
				$model_id=mysqli_fetch_assoc($result2);
				
			} 
            

		$sql3="INSERT INTO `vehicle` ( `reg_number`, `current_km`, `year`, `engine_size`, `daily_hire_rate`, `vehicle_category_id`, `model_id`, `owner_id`, `created_date`, `employee`, `additional_inf`, `location`, `photo`) VALUES ('".$_POST["reg_number"]."', '".$_POST["current_km"]."','".$_POST["year"]."','".$_POST["engine_size"]."', '".$_POST["daily_hire_rate"]."', '".$_POST["vehicle_category_id"]."', '".$model_id['id']."', '".$_COOKIE["user_id"]."' ,default,'".$_POST["employee"]."', '".$_POST["additional_inf"]."', '".$_POST["location"]."', '".$photo."')" ;
  			
		if(mysqli_query($conn, $sql3)){
			echo "<h2>Vehicle add</h2>";
			header("Location: /cabinet/autopark.php");
		}else{
			echo "<h2>Erro</h2>".mysqli_error($conn);
		}
	
	}

	
?>
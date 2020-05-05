<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';

/*
===================================
Поновлення даних про користувача в БД 
*/

 	if(isset($_POST["save_user"])&&isset($_POST["user_id"])){
	     var_dump($_FILES['file']['name']);
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
				var_dump($_FILES['file']['name']);
				if (basename($_FILES['file']['name'])!=$_POST['current_file']){
				
					$photo =date('YmdHis').basename($_FILES['file']['name']);
					$path =$dir_img_logo.$photo;
					var_dump($path);
					$mov = move_uploaded_file($_FILES['file']['tmp_name'],$path);
					if($mov) {
						//збереження імені файлу в тектсовому форматі
						$photo = htmlentities(stripslashes(strip_tags(trim($photo))),ENT_QUOTES,'UTF-8');
			  			}
				}
		}
		else{
			$photo=$_POST['current_file'];
		
		  }

		  var_dump($photo);
		  	//Виберемо інформацію про поточного корисувача для отримання значення, щоб отримати доступ до зовнішніх ключів, які не міняються
		  	$sql="SELECT * FROM user, corporation,address WHERE user.id=".$_POST['user_id']." AND  user.corporation_id=corporation.id AND corporation.address_id=address.id";
		   	$result=$conn->query($sql);
		  	$user_data=mysqli_fetch_assoc($result);
			
		  	//Поновимо дані таблиці corporation
			$sql1 = "UPDATE corporation SET  `name`='".$_POST["name"]."', `logo`='".$photo."'  WHERE id=".$user_data["corporation_id"];
			        
		    if(mysqli_query($conn, $sql1)){
			echo "<h2>corporation update</h2>";
			}else{
				echo "<h2>Erro</h2>".mysqli_error($conn);
			}

			//Поновимо дані таблиці address
			$sql2 = "UPDATE address SET  `number_home`='".$_POST["number_home"]."', `street`='".$_POST["street"]."', `town_villige`='".$_POST["town_villige"]."', `country`='".$_POST["country"]."' WHERE id=".$user_data["address_id"];
			  
		    if(mysqli_query($conn, $sql2)){
			echo "<h2>address update</h2>";
			}else{
				echo "<h2>Erro</h2>".mysqli_error($conn);
			}

			//поновлюємо дані про user за його $_POST["user_id"] (або $_COOKIE["user_id"]) 
  			$sql3="UPDATE user SET  `first_name`='".$_POST["first_name"]."', `last_name`='".$_POST["last_name"]."', `email`='".$_POST["email"]."', `birthday`='".$_POST["birthday"]."', `phone_number`='".$_POST["phone_number"]."', `password`='".$_POST["password"]."' WHERE `id`=" .$_POST["user_id"] ;
        	
        	if(mysqli_query($conn, $sql3)){
				echo "<h2>vehicle update</h2>";
				header("Location: /cabinet/settings.php");
				}else{
					echo "<h2>Erro</h2>".mysqli_error($conn);
				}
			
		
}
?>
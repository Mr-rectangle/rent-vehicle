<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
include 'header.php';

$sql_vehicle = "SELECT * FROM vehicle WHERE id =" . $_GET['id'];
$result_vehicle = $conn->query($sql_vehicle);
$product = mysqli_fetch_assoc($result_vehicle);

$sql_user = "SELECT * FROM `user` WHERE `id` = ".$product['owner_id']." ORDER BY `last_name` ASC";
$result_user = $conn->query($sql_user);
$user = mysqli_fetch_assoc($result_user);

$sql_model = "SELECT * FROM `model` WHERE `id` = ".$product['model_id']."";
$result_model = $conn->query($sql_model);
$model = mysqli_fetch_assoc($result_model);



if (isset($_GET['submit'])) {
  if(isset($_COOKIE['user_id'])){
    $user_id=$_COOKIE['user_id'];

   
    $sqlz = "INSERT INTO `rent` (`id`, `is_delete`, `user_id`, `vehicle_id`, `date_from`, `date_to`, `payment_received`, `rent_status_id`, `created_date`, `additional_inf`) VALUES (NULL, '0', '".$user_id."', '".$_GET['id']."', '".$_GET['date_from']."', '".$_GET['date_to']."', '0', '1', current_timestamp(), '".$_GET['additional_inf']."')";    
    if ($conn->query($sqlz)) {
      // виводимо повідомлення 
      // echo "Користувача додано";
      header("location: /cabinet/main.php");
    }

  }else
  {
    header("location: /authorization.php");  
  }  
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="../assets/css/style_product.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />

  </head>

  <body>
  	<br/>
  	<br/> 

  	<div id="cssmenu">  
	    <ul>
	        <li class="active"><a href="#">Produckt</a></li>
	        	        
	        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
	    </ul>
	</div>  


    <main class="container">

      
      <div class="left-column">
      	<img src="<?php echo "../assets/images/vehicle_img/".$product["photo"];?>">
      </div>

      <!-- Right Column -->

      <div class="right-column " style="margin-top: 0px; margin-bottom: 0px;">

        <!-- Product Description -->
        <div class="product-description">
          <p>Власник Т/З - <?php echo $user['first_name']; ?>   <?php echo $user['last_name']; ?>
          </p>
          <p> № Телефону - 
            <?php 
            if(isset($_COOKIE['user_id'])){
            echo $user['phone_number']; 
          }else{
            echo "інформація доступна зареєстрованим користувачам";
          }
            ?>
          </p>
          <h4><a href="#">Показати всі Т/З власника</a></h4>
          <h1><?php echo $model['name']; ?></h1>
          <p>Рік виготовлення - <?php echo $product['year']; ?></p>
          <p>Пробіг - <?php echo $product['current_km']; ?> Км.</p>
          <p>Обєм двигуна - <?php echo $product['engine_size']; ?> См3.</p>
          <p>Державний реєстраційний номер - <?php echo $product['reg_number']; ?></p>
        </div>

        <!-- Product Configuration -->
        <form class="forms_form" action="product.php" >
        <div class="product-configuration">

          <!-- Cable Configuration -->
          <!-- Додпткова інформація -->
          <div class="cable-config">
            <p><?php echo $product['additional_inf']; ?></p>
          </div>
          
            <div class="cable-config">           
              <span>                
                <fieldset class="forms_fieldset">
                 <div class="forms_field">
                    <p>Замовити з - <input type="date"  name="date_from" placeholder="E-mail" class="forms_field-input" required />
                      </p>
                  </div>
                  <div class="forms_field">
                    <!-- <input type="date" class="form-control"> -->
                    <p>Необхідно повернути - <input type="date" name="date_to" placeholder="Дата народження" class="forms_field-input" required /> </p>
                  </div>
                  <p>Поле для додаткової інформації:</p>
                  <textarea type="text" class="form-control" name="additional_inf" style="margin-top: 0px; margin-bottom: 0px; height: 40px;"> 
                  </textarea>
                  </fieldset>
                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET["id"]; ?>"/>
              </span>                       
            </div>
         
          <div class="forms_buttons">
            <h2><?php echo $product['daily_hire_rate']; ?> грн.
             <button name="submit" value="1" type="submit" class="btn btn-primary">Замовити</button>
            </h2> 
          </div>
           
        </div>
        </form>
        <!-- Product Pricing -->
        

      </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="../assets/js/script.js" charset="utf-8"></script>
  </body>
</html>



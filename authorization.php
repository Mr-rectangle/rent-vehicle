<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*=======================авторизація===========================*/
// перевіряємо чи непусті наші поля введення name email та password
if (  
  isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])
  && $_POST["name"] != "" &&  $_POST["email"] != "" && $_POST["password"] != "") {
  //якщо все гаразд тоді формуємо sql запит пошуку для перевірки чи існує такий користувач 
 $sql = "SELECT * FROM `user` WHERE `first_name` LIKE '" . $_POST["name"] . "' AND `email` LIKE '" . $_POST["email"] . "' AND `password` LIKE '".$_POST["password"]."' ORDER BY `email` ASC"; 
  // $sql = "SELECT * FROM user WHERE email LIKE '" . $_POST["email"] . "' AND `password` LIKE '".$_POST["password"]."'";
  // виконуємо запит до бази даних
  $result = mysqli_query($conn, $sql);
  // повертає кількість рядів в функціїї
  $col_sovpadeniy = mysqli_num_rows($result);
   // var_dump($col_sovpadeniy);
   // die();s   
  if ($col_sovpadeniy==1) {
    // повертає результат в якості асоціативного масиву
    $user = mysqli_fetch_assoc($result);
    //cтворюємо куки для зберігання даних користувача
    setcookie("user_id", $user["id"], time()+60*60*24);
    
    // var_dump($_COOKIE["user_id"]);
    // die(); 
     header("location: /");
  }
  else{
    // echo "<h2> Невірно введені логін або пароль </h2>";
    $no = 1;
  }
}
/*=============================================================*/
/*========================реєстрація===========================*/
if (
  isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["emailr"]) && isset($_POST["birthday"]) && isset($_POST["number_home"]) && isset($_POST["passwordr"]))
  {
  //якщо все гаразд тоді формуємо sql запит пошуку для перевірки чи існує такий користувач  
  $sql = "SELECT * FROM `user` WHERE `first_name` LIKE '" . $_POST["first_name"] . "' AND `email` LIKE '" . $_POST["emailr"] . "' AND `password` LIKE '".$_POST["passwordr"]."' ORDER BY `email` ASC";
  $result = mysqli_query($conn, $sql);//виконуємо запит до БД.
  $col_sovpadeniy = mysqli_num_rows($result); //кількість збігів
//якщо користувача з такими даними неіснує тоді можна його добавити до нашої БД 
    if ($col_sovpadeniy==0) {
      //формуємо sql запит для додавання number_home в таблицю address нашого користувача до БД 
     $sql = "INSERT INTO `address` () VALUES ()";
     $conn->query($sql);//виконуємо запит до БД.
     // дізнаємося id останньго вставленого рядка в таблицю
     $sql = "SELECT id FROM address ORDER BY id DESC LIMIT 1";
     $result=$conn->query($sql);
     $id = mysqli_fetch_assoc($result);  
     // var_dump($id);
     // die();
     //формуємо sql запит для додавання id в таблицю corporation нашого користувача до БД
     $sql = "INSERT INTO `corporation` (`address_id`) VALUES ('".$id["id"]."')";
     $conn->query($sql);//виконуємо запит до БД.

     $sql = "SELECT * FROM `corporation` WHERE `address_id` = ".$id["id"]."";
     $result=$conn->query($sql);
     $corporation = mysqli_fetch_assoc($result);

     $sql = "INSERT INTO `user` (`first_name`, `last_name`, `email`, `birthday`, `phone_number`, `corporation_id`, `password`) VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."', '".$_POST["emailr"]."', '".$_POST["birthday"]."', '".$_POST["number_home"]."', '".$corporation["id"]."', '".$_POST["passwordr"]."')";
     if ($conn->query($sql)) {
      // виводимо повідомлення 
      // echo "Користувача додано";
      $log = 1;
    }     
  }
  else{
    // echo "<h2> Кориснувач з такими даними вже існує перейдіть на сторінку авторизації   </h2>";
    $log = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Autorization</title>
  
      <link rel="stylesheet" href="assets/css/style.css">

  
</head>

<body>
  <!--
  This was created based on the Dribble shot by Deepak Yadav that you can find at https://goo.gl/XRALsw
  I am @hurickkrugner on Twitter or @hk95 on GitHub. Feel free to message me anytime.
-->

<section class="user">
  <div class="user_options-container">
    <div class="user_options-text">
      <div class="user_options-unregistered">
        <?php 
        if (isset($no) && $no==1) {
          ?>
          <h2 class="user_unregistered-title1"> Зареєструйтеся</h2>
          <?php
        }else{
        ?>
          <h2 class="user_unregistered-title">Ще не зареєстровані?</h2>
        <?php
      }
         ?>        
        <p class="user_unregistered-text">Можете зробити це прямо зараз!</p>
        <button class="user_unregistered-signup" id="signup-button">Зареєструватися</button>
      </div>

      <div class="user_options-registered">
        <?php
        if (isset($log) && $log==1){
          ?>
          <h2 class="user_registered-title">Вам необхідно Залогінитися?</h2>
          <?php
        }else{
          ?>
          <h2 class="user_registered-title">Вже маєте аккаунт?</h2>
          <?php
        }
        ?>        
        <button class="user_registered-login" id="login-button">Залогінитися</button>
      </div>
    </div>
    
    <div class="user_options-forms" id="user_options-forms">
      <div class="user_forms-login">
        <h2 class="forms_title">Раді вас бачити!</h2>
        <form class="forms_form" action="authorization.php" method="POST">
          <fieldset class="forms_fieldset">
            <div class="forms_field">
              <input type="text" name="name" placeholder="Ім'я" class="forms_field-input" required autofocus />
            </div>
            <div class="forms_field">
              <input type="text" name="email"  placeholder="E-mail" class="forms_field-input" required autofocus />
            </div>
            <div class="forms_field">
              <input type="password" name="password" placeholder="Пароль" class="forms_field-input" required />
            </div>
          </fieldset>
          <div class="forms_buttons">
            <input type="submit" value="Увійти" class="forms_buttons-action">
          </div>
        </form>
      </div>
      <div class="user_forms-signup">
        <form class="forms_form" action="authorization.php" method="POST">
          <fieldset class="forms_fieldset">
            <div class="forms_field">
              <input type="text" name="first_name" placeholder="Ім'я" class="forms_field-input" required />
            </div>
            <div class="forms_field">
              <input type="text" name="last_name" placeholder="Прізвище" class="forms_field-input" required />
            </div>
            <div class="forms_field">
              <input type="text"  name="emailr" placeholder="E-mail" class="forms_field-input" required />
            </div>
            <div class="forms_field">
              <!-- <input type="date" class="form-control"> -->
              <input type="date" name="birthday" placeholder="Дата народження" class="forms_field-input" required />
            </div>
            <div class="forms_field">
              <input type="text" name="number_home" placeholder="Номер телефону" class="forms_field-input" required />
            </div>
            <div class="forms_field">
              <input type="password" name="passwordr" placeholder="Пароль" class="forms_field-input" required />
            </div>
          </fieldset>
          <div class="forms_buttons">
            <input type="submit" value="Зареєструватися" class="forms_buttons-action">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
  
    <script src="assets/js/index.js"></script>

</body>
</html>

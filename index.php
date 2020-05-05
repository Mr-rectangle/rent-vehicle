<?php
include 'configs/db.php';
include 'parts/header.php';
include 'parts/navigation.php';
?>


<div id="main-content">


<div id="templatemo">

	<?php
	if (isset($_COOKIE['user_id'])) {
		?>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    
			    <form class="form-inline my-2 my-lg-0">
			      <input class="form-control mr-sm-2" type="search" placeholder="Пошук" aria-label="Search">
			      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Пошук</button>
			    </form>

			    <ul class="navbar-nav mr-auto">
			     
			        <a class="btn btn-outline-primary my-2 my-sm-0" href="cabinet/main.php" type="submit">Перейти до кабінету</a>
			        
			        
			     
			    </ul>
			  </div>
			</nav>
		<?php
	} else {
	?>
	<div class="main-slider">
  <div class="flexslider">
   <ul class="slides">
            
    <li>
     <div class="slider-caption">
      <h2>KRAYINA</h2>
      <p>Навігаційна панель зліва допоможе вам швидше знайти необхідну послугу</p>
     </div>
     <img src="assets/images/slide1.jpg" alt="Slide 1">
    </li>
                
    <li>
     <div class="slider-caption">
      <h2>KRAYINA</h2>
      <p>Щоб додавати свої послуги, необхідно зареєструватися та авторизуватися</p>
     </div>
     <img src="assets/images/slide2.jpg" alt="Slide 2">
    </li>
                
                <li>
     <div class="slider-caption">
      <h2>KRAYINA</h2>
      <p>Визавжди можете переглянути інформацію про власника</p>
     </div>
     <img src="assets/images/slide3.jpg" alt="Slide 3">
    </li>
                
   </ul>
  </div>
 </div>
 <?php
 }
 ?>
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="welcome-text">
     <h2>Welcome to Krayina mozlivostey</h2>
     <p>Наш сервіс допоможе вам легко знайти необхідну вам машину, та орендувати її на необхідний час, допомогти здати свою машину в аренду та контролювати її статус.</p>
    </div>
   </div>
  </div>
 </div>
</div> <!-- /#sTop -->

<div class="container-fluid">

	<?php

	$sql_cat = "SELECT * FROM vehicle_category";
	$result_cat = $conn->query($sql_cat);
	while ($main_cat = mysqli_fetch_assoc($result_cat)) {
		include 'parts/category-card.php';
	}
	?>
	

	<?php
	$sql = "SELECT * FROM vehicle_category";
	$result = $conn->query($sql);
	while ($cat = mysqli_fetch_assoc($result)) {
		include 'parts/category.php';
	}
	?>
	
	

	<div id="contact" class="section-content">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Зв'яжіться з нами</h2>
				</div> <!-- /.section-title -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
		<div class="row">
			<div class="col-md-12">
				<div class="map-holder">
					<div class="google-map-canvas" id="map-canvas">
            		</div>
				</div> <!-- /.map-holder -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
		<div class="row contact-form">
			<div class="col-md-4">
				<label for="name-id" class="required">Name:</label>
				<input name="name-id" type="text" id="name-id" maxlength="40">
			</div> <!-- /.col-md-4 -->
			<div class="col-md-4">
				<label for="email-id" class="required">Email:</label>
				<input name="email-id" type="text" id="email-id" maxlength="40">
			</div> <!-- /.col-md-4 -->
			<div class="col-md-4">
				<label for="subject-id">Subject:</label>
				<input name="subject-id" type="text" id="subject-id" maxlength="60">
			</div> <!-- /.col-md-4 -->
			<div class="col-md-12">
				<label for="message-id" class="required">Message:</label>
				<textarea name="message-id" id="message-id" rows="6"></textarea>
			</div> <!-- /.col-md-12 -->
			<div class="col-md-12">
				<div class="submit-btn">
					<a href="#" class="largeButton contactBgColor">Send Message</a>
				</div> <!-- /.submit-btn -->
			</div> <!-- /.col-md-12 -->
		</div>
	</div> <!-- /#contact -->
	
</div> <!-- /.container-fluid -->




<?php
include 'parts/footer.php';
?>	
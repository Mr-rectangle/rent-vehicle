<div id="main-sidebar" class="hidden-xs hidden-sm">
	<div class="logo">
		<a href="#"><h1>Krayina</h1></a>
        <?php
        if (isset($_COOKIE['user_id'])) {
            $sql = "SELECT * FROM user WHERE id=" . $_COOKIE['user_id'];
            $result_user = $conn->query($sql);
            $user = mysqli_fetch_assoc($result_user);
        ?>
        <a href="#" class="largeButton homeBgColor"><?=$user['first_name'] ?></a>
        <a class="btn btn-outline-danger my-2 my-sm-0" href="parts/dellk.php" type="submit">Вийти з аккаунту</a>
        <?php    
        } else {
        ?>
		<a href="../authorization.php" class="largeButton homeBgColor">Увійти</a>
        <?php
        }
        ?>
	</div> <!-- /.logo -->

	<div class="navigation">
        <ul class="main-menu">
            <li class="home"><a href="#templatemo">Головна</a></li>

            <?php
            $sql_nav = "SELECT * FROM vehicle_category";
            $result_nav = $conn->query($sql_nav);

            while ($nav = mysqli_fetch_assoc($result_nav)) {
            	?>
            	<li class="home"><a href="#about<?=$nav['id'] ?>"><?=$nav['name'] ?></a></li>
            	<?php
            }
            ?>

            

            <li class="home"><a href="#contact">Зв'яжіться з нами</a></li>
            <br/>
            <br/>
            <?php
            if (isset($_COOKIE['user_id'])) {
                ?>
                <li class="home"><a href="http://rent-vehicle.local/">Вийти◄╝</a></li>
                <?php
            }
            ?>


        </ul>
	</div> <!-- /.navigation -->

</div> <!-- /#main-sidebar -->
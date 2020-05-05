<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/nav.php';

                       
    if (isset($_COOKIE["user_id"])) {
        //вибір інформації про користувача із таблиці user для відображення у формі для редагування 
        $sql="SELECT * FROM user WHERE id='".$_COOKIE["user_id"]."' AND is_delete=FALSE" ;
        $result=$conn->query($sql);
        $user=mysqli_fetch_assoc($result);
    
        
      
        
        
?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Налаштування профілю</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="main.php">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Налаштування</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                 <form  action="modules/user/edit_user.php" class="form-horizontal form-material" method="POST" enctype="multipart/form-data">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                     <?php 
                        //вибір інформації про корпорацію із таблиці corporation, address для відображення у формі для редагування 
                        $sql1="SELECT * FROM corporation, address WHERE corporation.id=".$user['corporation_id']." AND corporation.address_id=address.id" ;
                        $result1=$conn->query($sql1);
                        $data=mysqli_fetch_assoc($result1);
                        ?>
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                    
                                    <img src="<?php
                                            if ( $data['logo']==''){
                                                echo "/assets/images/logo_img/"."logo_icon.png"; 
                                            }
                                            else{
                                                echo "/assets/images/logo_img/".$data['logo'];    
                                            }
                                        
                                        
                                         ?>" width="150" />
                                     <!-- приховане поле -->
                                     <h3 class="card-title m-t-10"><?php echo $user["first_name"]." ".$user["last_name"];  ?></h3>
                                     <input type="hidden" name=user_id value="<?php echo $user["id"]; ?>">
                                     <br>
                                <input type="hidden"  name="current_file" placeholder="завантажте фото" value='<?php echo $data['logo']; ?>'>

                                <input type="file" name="file" />    
                                
                                </center>

                            </div>
                            <div>
                    </div>

                       </div>
                    </div>
                    
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                                       
                                    <div class="form-group">
                                        <label class="col-md-12">Прізвище</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name='last_name' value="<?php echo $user['last_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Ім'я</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name='first_name' value="<?php echo $user['first_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Дата народження</label>
                                        <div class="col-md-12">
                                            <input type="data" class="form-control form-control-line" name='birthday' value="<?php echo $user['birthday']; ?>">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="email" id="example-email" value="<?php echo $user['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" class="form-control form-control-line" value="<?php echo $user['password']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name=phone_number class="form-control form-control-line" value="<?php echo $user['phone_number']; ?>">
                                        </div>
                                    </div>
                                  <h4>Назва компанії</h4>
                            <div class="form-group">
                                <div class="col-md-12">
                                     <input type="text" class="form-control form-control-line" placeholder="home" name='name' value="<?php echo $data['name']; ?>">
                                     </div>
                            </div>
                            <h4>Адреса компанії</h4>
                            <div class="form-group">
                                        <label class="col-md-12">Країна</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" placeholder="країна" name='country' value="<?php echo $data['country']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Місто/Село</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" placeholder="місто/село" name='town_villige' value="<?php echo $data['town_villige']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Вулиця</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" placeholder="вулиця" name="street"  value="<?php echo $data['street']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Номер будинку/Номер квартири</label>
                                        <div class="col-md-12">
                                            <input type="text" name="number_home" class="form-control form-control-line" placeholder="номер будинку/квартири" value="<?php echo $data['number_home']; ?>">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="save_user" class="btn btn-primary">Зберегти зміни</button>
                                        </div>
                                    </div>

                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <!-- Row -->
                                 
                </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->

<?php 
}else{
header("Location:/authorization.php");
}
?>
          <!-- ============================================================== -->
<?php

    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
 ?>
<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/nav.php';

                       
    if (isset($_COOKIE["user_id"])) {
        $user_id=$_COOKIE["user_id"];
        //вибір інформації про користувача із таблиць user, corporation, address для відображення у профілі 
        $sql="SELECT * FROM user, corporation, address WHERE user.id=".$user_id." AND user.is_delete=FALSE AND user.corporation_id=corporation.id AND corporation.address_id=address.id" ;
        $result=$conn->query($sql);
        $user_data=mysqli_fetch_assoc($result);
        
        
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
                        <h4 class="page-title">Профіль</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="main.php">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Профіль</li>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->

                    <div class="col-lg-6 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                    <img src="<?php
                                            if ($user_data['logo']==null){
                                                echo "/assets/images/logo_img/"."logo_icon.png"; 
                                            }
                                            else{
                                                echo "/assets/images/logo_img/".$user_data['logo'];    
                                            }
                                        
                                         ?>" width="150" />
                                     <!-- приховане поле -->
                                     <h3 class="card-title m-t-10"><?php echo $user_data["first_name"]." ".$user_data["last_name"];  ?></h3>
                               
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> 
                                      <small class="text-muted"> Назва компанії </small>
                                     <h6><?php 
                                        if($user_data['name']==''){
                                                echo "Фізична особа"; 
                                        }else{
                                            echo $user_data['name']; 
                                            
                                        }
                                        ?>
                                    </h6>
                            
                                <small class="text-muted">Email адреса </small>
                                <h6>
                                <?php
                                 if($user_data['email']==''){
                                        echo "_______________";
                                    } else{
                                        echo $user_data['email']; 
                                    }
                                 ?>
                                </h6> 
                                
                                <small class="text-muted p-t-30 db">Телефон</small>
                                <h6><?php 
                                   if($user_data['phone_number']==''){
                                       echo "_______________";
                                      } else{
                                       echo $user_data['phone_number'];
                                    }
                                 ?></h6>
                                <small class="text-muted p-t-30 db">Адреса</small>

                                <h6>  <?php echo "країна: ";
                                        if($user_data['country']==''){
                                                echo "_______________";
                                         }
                                         else {
                                                echo $user_data['country'];
                                        }
                                        ?>
                                 </h6>


                                <h6>  <?php echo "місто/село: ";
                                        if($user_data['town_villige']==''){
                                                echo "_______________";
                                         }
                                         else {
                                                echo $user_data['town_villige'];
                                        }
                                        ?>
                                 </h6>
                                 <h6> <?php 
                                        if($user_data['street']=='' || $user_data['number_home']==''){
                                                echo "вул. ___ , буд./кв. ___ ";
                                         }else{
                                                echo "вул.".$user_data['street'].", буд./кв.".$user_data['number_home']; 
                                        }
                                    ?>                                    
                                </h6>
                                <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div> <small class="text-muted p-t-30 db">Профіль у соціальних мережах</small>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                            </div>


                        </div>
                                                                  <!-- Посилання для редагування -->
                                            <center><div class="btn-group" role="group" >
                                                <hr>
                                                <br>
                                              <a  href="settings.php?user_id=<?php echo $user_id; ?>">Редагувати дані профілю </a>
                                                                                           
                                            </div>
                                        </center>

                    </div>

                    <!-- Column -->

                </div>
                <!-- Row -->
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
<?php  }
else{
header("Location:/authorization.php");
} 
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
 ?>
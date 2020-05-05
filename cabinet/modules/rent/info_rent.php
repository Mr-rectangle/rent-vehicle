<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/nav.php';
    
          //кількість днів між датами
        function countDaysBetweenDates($d1, $d2)
        {   

            //перетворення текстового формату timestamp
            $d1_ts = strtotime($d1);
            $d2_ts = strtotime($d2);

            // Кількість секунд
            // щоб не перевіряти, яка дата раніше, яка пізніше 
            $seconds = abs($d1_ts - $d2_ts);

            // Кількість днів заокруглюємо в меншу сторону,
            // щоб взанти точну кількість минулих днів
            // 86400 - кількість секунд в одній добі  (60 * 60 * 24)
            return floor($seconds / 86400);
        }

    if (isset($_COOKIE["user_id"])&&isset($_GET["id"])) {
      $rent_id=$_GET["id"];
            //вибір інформації про vehicle із таблиці vehicle для відображення у формі для редагування 
        $sql="SELECT
                   rent.id as rent_id,
                   rent.user_id as user_id,
                   rent.vehicle_id as vehicle_id,
                   rent.date_from as date_from,
                   rent.date_to as date_to,
                   rent.payment_received as payment_received,
                   rent.additional_inf as additional_inf,
                   rent_status.id as rent_status_id,
                   rent_status.name as rent_status_name 
                FROM
                   rent,
                   rent_status
                       WHERE
                   rent.id=".$rent_id." 
                   AND rent.rent_status_id = rent_status.id";
                   
        $result=$conn->query($sql);
        $rent_data=mysqli_fetch_assoc($result);

        //повна інформація про vehicle
        $sql1 = "SELECT 
            vehicle.id as id,
            vehicle.reg_number as reg_number,
            vehicle.current_km as current_km,
            vehicle.year as year,
            vehicle.engine_size as engine_size,
            vehicle.daily_hire_rate as daily_hire_rate,
            vehicle.vehicle_category_id as vehicle_category_id,
            vehicle.model_id as model_id,
            vehicle.owner_id as owner_id,
            vehicle.created_date as created_date,
            vehicle.employee as employee,
            vehicle.additional_inf as additional_inf,
            vehicle.location as location,
            vehicle.photo as photo,
            vehicle_category.name as vehicle_category_name,
            vehicle_category.description as vehicle_category_description ,          
           vehicle_category.name as model_name
             FROM vehicle, vehicle_category, model  WHERE 
            vehicle.id='".$rent_data["vehicle_id"]."' AND vehicle.is_delete=FALSE AND vehicle.vehicle_category_id=vehicle_category.id  AND vehicle.model_id=model.id";
        $result1=$conn->query($sql1);
        $vehicle_data=mysqli_fetch_assoc($result1);
          
        // повна інформація про користувача, який орендував транспортний засіб -->
           $sql2 = "SELECT * FROM user, corporation, address  WHERE user.id='".$rent_data['user_id']."' AND user.is_delete=FALSE";
           $result2=$conn->query($sql2);
          $user_data=mysqli_fetch_assoc($result2);
                                            
       
        
?>

       <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"><?php echo "Замовлення оренди №".$rent_id; ?></h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/cabinet">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="/cabinet/autopark.php">Мій автопарк</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo "Замовлення оренди №".$rent_id; ?></li>
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
             
                <!-- Row -->
                <div class="row">
                                      <!-- Column -->

                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                  <h1> Орендавець </h1>
                                     <img src="<?php
                                            if ($user_data['logo']!=null){
                                                echo "/assets/images/logo_img/"."logo_icon.png"; 
                                            }
                                            else{
                                                echo "/assets/images/logo_img/".$user_data['logo'];    
                                            }
                                        
                                         ?>" width="100" />
                                     
                                    <h3 class="card-title m-t-10"><?php echo $user_data["first_name"]." ".$user_data["last_name"];  ?></h3>
                               
                                </center>
                            </div>
                         
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
                            </div>

                        </div>
                    </div>
                            
                  <!-- Column -->
                     <div class="col-lg-8 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                    <img src="<?php
                                            if ($vehicle_data['photo']==null){
                                                echo "/assets/images/vehicle_img/"."vehicle_icon.png"; 
                                            }
                                            else{
                                                echo "/assets/images/vehicle_img/".$vehicle_data['photo'];    
                                            }
                                        
                                         ?>" width="150" />
                                         <h4><?php echo $vehicle_data['model_name']; ?></h4>
                                     <p>Державний реєстраційний номер - <?php echo $vehicle_data['reg_number']; ?></p>
                               
                                </center>

                          <p>Рік виготовлення - <?php echo $vehicle_data['year']; ?></p>
                          <p>Пробіг - <?php echo $vehicle_data['current_km']; ?> Км.</p>
                          <p>Об'єм двигуна - <?php echo $vehicle_data['engine_size']; ?> См3.</p>
                          <p>Ціна оренди (за добу) - <?php echo $vehicle_data['daily_hire_rate']; ?></p>  
                          <center> <h4> СТАТУС ЗАМВОЛЕННЯ</h4></center>
                           <form  action="edit.php" class="form-horizontal form-material" method="POST" >
                          <div>
                              <table>
                                                        
                                <tr>
                                   <tr>
                                      <td class="txt-oflo" COLSPAN="2"> ДАТА ПОЧАТКУ ОРЕНДИ: </td> 
                                      <td class="txt-oflo">
                                            <?php
                                                 $date = date_create($rent_data["date_from"]);
                                                echo date_format($date, 'd/m/Y');
                                              ?>
                                      </td>
                                                  
                                    </tr>
                                     <tr> 
                                          <td class="txt-oflo" COLSPAN="2"> ДАТА ЗАВЕРШЕННЯ ОРЕНДИ: </td>
                                           <td class="txt-oflo">
                                                <?php 
                                                    $date = date_create($rent_data["date_to"]);
                                                       echo date_format($date, 'd/m/Y');
                                                ?>
                                          </td>
                                    </tr>
                                    </tr>
                                      <tr>
                                        <td class="txt-oflo" COLSPAN="2"> КІЛЬКІСТЬ ДНІВ: </td>
                                        <td>
                                             <?php echo countDaysBetweenDates($rent_data["date_from"],$rent_data["date_to"]);
                                           ?> 
                                        </td>
                                      </tr>
                                            <td class="txt-oflo" COLSPAN="2"> ЗАГАЛЬНА СУМА ОРЕНДИ: </td>
                                        <td>
                                              <span > <?php echo $vehicle_data["daily_hire_rate"]* countDaysBetweenDates($rent_data["date_from"],$rent_data["date_to"]);
                                            echo " грн" ?></span> 
                                        </td>
                                        
                                      </tr>
                                      <tr>
                                        <td COLSPAN="3" align="center"><b>ЗМІНИТИ ДАНІ ПРО СТАТУС ОРЕНДИ</b></td>
                                      </tr>
                                      <tr>
                                                 <!-- назва статусу -->
                                    <td class="txt-oflo">CТАТУС ОРЕНДИ: </td>
                                     <td class="txt-oflo">
                                      <?php 
                                                //отримання id статусу поточного замовлення
                                               
                                                $rent_st=mb_strtoupper($rent_data["rent_status_name"]);
                                                switch($rent_data["rent_status_id"]){
                                                  case '1':
                                                     echo  "<span class='label label-danger label-rounded'>".$rent_st."</span>";
                                                     break;
                                                 case '2':
                                                     echo  "<span class='label label-info label-rounded'>".$rent_st."</span>";
                                                     break;
                                                 case '3':
                                                        echo  "<span class='label label-success label-rounded'>".$rent_st." </span>";
                                                        break;
                                                    }
                                            ?>
                                          </td>
                                       <td>   
                                       <div class="form-control">
                                        <select name="rent_status_id" class="form-control">
                                           <option value="<?php echo $rent_data['rent_status_id']; ?>" selected>  Не вибрано</option>
                                     <?php 
                                        $sql1 = "SELECT * FROM rent_status";
                                        $result1=$conn->query($sql1);
                                        while($row1=mysqli_fetch_assoc($result1)){
                                            echo "<option value='".$row1['id']."' >". $row1['name']." ".$row1['description']."</option>";
                                        }

                                                                       
                                    ?>

                                </select>
                                    </div>
                                    </td>     
                                  </tr>
                                       <tr>
                                            <td class="txt-oflo">  СТАТУС ОПЛАТИ: </td>
                                            <td class="txt-oflo">
                                             <?php 
                                            if($rent_data["payment_received"]){
                                                 echo  "<span class='label label-success label-rounded'>ОПЛАЧЕНО</span>";
                                            
                                            }else
                                            {  
                                                  echo  "<span class='label label-danger label-rounded'>НЕ&nbsp;ОПЛАЧЕНО </span>";
                                            } 
                                            ?>
                                           </td>
                                            <td>
                                             <div class="form-group">
                                <div class="custom-control custom-checkbox">   
                                  <br>
                                                <label  for="customCheck3"> оплату виконано</label>
                                               <?php 
                                    //Якщо є службовець для обслуговування транспорту
                                        if ($rent_data['payment_received']==1){
                                            echo "<input type='checkbox' id='customCheck3'  name='payment_received'  value='1' checked>";
                                            //за замовчуванням, якщо буде uncheked передасться значення із 0
                                            echo "<input type='hidden' id='customCheck3'  name='payment_received'  value='0'>";
                                        }else{
                                            echo "<input type='hidden' id='customCheck3'  name='payment_received'  value='0' checked>";
                                            //за замовчуванням, якщо буде uncheked передасться значення із 1
                                            echo "<input type='checkbox' id='customCheck3'  name='payment_received'   value='1'>";
                                            
                                        }
                                        
                                       ?> 
                                   
                                    </div>
                                  </div>
                                    </td>     
                                                
                                        </tr>




                                </table>
                                <br>
                                <input type="hidden" name="rent_id" value="<?php echo $rent_data['rent_id']?>">
                                   <center><button type="submit" name="save_rent" class="btn btn-primary">Зберегти зміни</button></center>
                           </div>
                         </form>
 


                          
                       </div>
                     </div>
                           

                    </div>

                  <!-- Посилання для редагування -->
                   

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
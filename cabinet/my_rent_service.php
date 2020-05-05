<?php
    //почистимо всі cookie
    // setcookie("basket","",0,"/");
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
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

    //чи залогований користувач
    if(isset($_COOKIE['user_id'])){
       $user_id=$_COOKIE['user_id'];



     //якщо застосовано фільтр
       if(isset($_GET["date_from"])&&$_GET["date_from"]!=null){
        $date_from=$_GET["date_from"];
               
        if(isset($_GET["date_to"])&&$_GET["date_to"]!=null){
            $date_to=$_GET["date_to"];
           
        }
        else{
            $date_to=date("dd.mm.YYYY");
        }
        //вибірка даних про орендовані у користувача транспортні засоби

        $sql="SELECT
                   rent.id as id_rent,
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
                   rent_status,
                   vehicle

                WHERE
                   rent.is_delete = FALSE 
                   AND rent.rent_status_id = rent_status.id
                   AND vehicle.id= rent.vehicle_id 
                   AND vehicle.owner_id=".$user_id." 
                   AND rent.date_from >='".$date_from."'  
                   AND rent.date_to <='".$date_to."'";
        }else{
                 //вибірка даних про орендовані у користувача транспортні засоби
        $sql="SELECT
                   rent.id as id_rent,
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
                   rent_status,
                   vehicle

                WHERE
                   rent.is_delete = FALSE 
                   AND rent.rent_status_id = rent_status.id
                   AND vehicle.id= rent.vehicle_id AND vehicle.owner_id=".$user_id;
       } 
        
                                              
       
                                
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
                        <h4 class="page-title">МІй сервіс</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Мій сервіс</li>
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
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card flex-fill">
                            <div class="card-body">
                                <h4 class="card-title">Інформація про оренду моїх транспортних засобів</h4>
                                <div>
                                    <div style="width: fit-content ;  float: left;"> 
                                    <!-- Форма пошуку , функція для обробки  в  /cabinet/dist/js/cabint.js  -->
                                    <form  action="my_rent_service.php" metod="GET" id="find-data">
                                        <label for="party">Пошук від </label>
                                        <input type="date" id="party" name="date_from" min="2018-04-01" value="<?php echo $_GET['date_from'];?>">
                                        <label for="party"> до </label>
                                        <input type="date" id="party" name="date_to" min="2020-04-01" value="<?php echo $_GET['date_to'];?>">
                                        <button  type="submit" width='10px'> 
                                               <i class="mdi mdi-magnify font-14 mr-1"></i>
                                        </button>
                                        <?php

                                        if(isset($_GET["date_from"])&&isset($_GET["date_to"])){
                                            unset($_GET['date_from']);
                                            unset($_GET['date_to']);
                                       ?>
                                         <a href="my_rent_service.php"> Скинути </a>
                                              <?php
                                         }
                                         ?>
                                       </form> 
                                       </div> 
                                       <?php
                                           $result=$conn->query($sql);
                                           $suma=0;
                                                                            
                                            while($rent_data=mysqli_fetch_assoc($result)){
                                                $sql1 = "SELECT * FROM vehicle WHERE id='".$rent_data["vehicle_id"]."'";
                                            
                                                $result1=$conn->query($sql1);
                                                $vehicle_data=mysqli_fetch_assoc($result1);

                                                $suma=$suma+$vehicle_data["daily_hire_rate"]*countDaysBetweenDates($rent_data["date_from"],$rent_data["date_to"]);
                                            }
                                       ?>
                                       <span style="display: block; float: right;"> <?php echo "<h5 >Дохід сервісу: <b>". $suma." грн"."</b></h5>" ?></span> 
                                                                            

                                    
                                  </div>

                            </div>
                            <div class="table-responsive" id="list-order">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th class="d-none d-xl-table-cell">ТРАНСПОРТНИЙ ЗАСІБ</th>
                                            <th class="d-none d-xl-table-cell">ОРЕНДАР</th>
                                            <th class="d-none d-xl-table-cell">СТАТУС ОРЕНДИ</th>
                                            <th class="d-none d-xl-table-cell">ДАТА ПОЧАТКУ</th>
                                            <th class="d-none d-xl-table-cell">ДАТА ЗАВЕРШЕННЯ</th>
                                            <th class="d-none d-xl-table-cell">ОРЕНДНА ПЛАТА</th>
                                             <th class="d-none d-xl-table-cell">СУМА</th>
                                            <th class="d-none d-xl-table-cell">СТАТУС ОПЛАТИ</th>
                                           <th class="d-none d-xl-table-cell">ОПЕРАЦІЇ</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php

                                            $result=$conn->query($sql);
                                            
                                             while($rent_data=mysqli_fetch_assoc($result)){
                                               
                                                //інформація про vehicle
                                                 $sql1 = "SELECT * FROM vehicle, vehicle_category,model  WHERE 
                                                    vehicle.id='".$rent_data["vehicle_id"]."' AND vehicle.owner_id='".$user_id."' AND vehicle.is_delete=FALSE AND vehicle.vehicle_category_id=vehicle_category.id  AND vehicle.model_id=model.id";
                                            
                                                $result1=$conn->query($sql1);
                                                $vehicle_data=mysqli_fetch_assoc($result1);
                                                if($vehicle_data!=null){
                                                                                               
                                            ?>
                                           
                                        <tr>    
                                             <td class="txt-oflo"> 
                                                <!-- інформація про орендований транспорт -->
                                                <?php echo $vehicle_data["reg_number"];
                                                    echo "<br>".$vehicle_data['name']; ?>
                                                    
                                                        
                                             </td>               
                                            <td class="txt-oflo">
                                                    <!-- інформація про власника -->
                                                <?php
                                                $sql2 = "SELECT * FROM user  WHERE id='".$rent_data['user_id']."' AND is_delete=FALSE";
                                                $result2=$conn->query($sql2);
                                                $user_data=mysqli_fetch_assoc($result2);
                                                
                                                echo "<a href='#'>".$user_data['last_name']." ".$user_data['first_name']."</a>";

                                                 echo  "<br><span><i> e-mail: ".$user_data['email']."</i></span><br><span><i>phone: ".$user_data['phone_number']."</i></span>";

                                                ?>
                                            
                                            </td>
                                            <td class="txt-oflo">
                                              <!-- назва статусу -->
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
                                            <td class="txt-oflo"> 
                                            <?php
                                                 $date = date_create($rent_data["date_from"]);
                                                echo date_format($date, 'd/m/Y');
                                              ?>
                                                  
                                              </td>

                                            <td class="txt-oflo"> 
                                                <?php 
                                                $date = date_create($rent_data["date_to"]);
                                                echo date_format($date, 'd/m/Y');
                                                ?>
                                            </td>

                                             <td><span class="font-medium"><?php echo $vehicle_data["daily_hire_rate"]." грн"; ?></span>
                                             </td>

                                            <td><span > <?php echo $vehicle_data["daily_hire_rate"]*countDaysBetweenDates($rent_data["date_from"],$rent_data["date_to"]);
                                            echo " грн" ?></span> 
                                            </td>

                                            <td>
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
                                            <!-- комірка із значеннями редагування -->
                                  <!--           <div class="btn-group" role="group" >
                                              <a  href="modules/autopark/edit.php?id=<?php echo $row['id'] ?>"><i class="m-r-10 mdi mdi-grease-pencil"></i> </a> -->
                                           <a  href="modules/rent/info_rent.php?id=<?php echo $rent_data['id_rent'] ?>">
                                            <i class="m-r-10 mdi mdi-information"></i>
                                          </a>
                                            <?php 
                                            //vehicle_status лише із значенням виконано ы оплачено, можна видаляти
                                             
                                            if($rent_data['rent_status_id']==3&&$rent_data['payment_received']==true){  
                                            ?>           
                                              <a  href="modules/rent/delete_rent_service.php?id=<?php echo $rent_data['id_rent'] ?>">
                                                    <i class="m-r-10 mdi mdi-bitbucket"></i>
                                              </a>

                                              <?php }else{
                                                ?> 
                                                    <i class="m-r-10 mdi mdi-bitbucket"></i>
                                              
                                              <?php
                                                  }

                                               ?>
                                              </div>
                                            </div>

                                        </td>

                                        </tr>
                                       <?php 
                                   }
                                   } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
  

<?php  }
    else{
    header("Location:/authorization.php");
    } 
?>
<?php
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
 ?>
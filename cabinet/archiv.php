<?php
    //почистимо всі cookie
    // setcookie("rent","",0,"/");
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
    //змінна для визначення активної сторінки
    $page ='archiv';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/nav.php';


    if(isset($_GET["reset"])){   
        $sql="UPDATE vehicle SET is_delete=FALSE WHERE id=".$_GET["vehicle_id"];
        //відновлення даних в таблиці vehicle
        if(mysqli_query($conn, $sql)){
            echo "<h2>Vehicle reset</h2>";
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }
        //відновлення даних в таблиці rent із даними про оренду поточного транспортного засобу
        $sql1="UPDATE rent SET is_delete=TRUE WHERE vehivle_id=".$_GET["vehicle_id"];
       
        if(mysqli_query($conn, $sql1)){
            echo "<h2>Vehicle reset</h2>";
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }
    
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
                        <h4 class="page-title">Архів транспортних засобів</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Архів</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->


<div class="container-fluid">
     <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                      <div class="card-body table-full-width table-responsive">
                    <table class="table">
                        <thead  class="thead-light" >
                            <th align="center">ID</th>
                            <th align="center">Фото</th>
                            <th>Реєстраційний номер машини</th>
                            <th>Модель</th>
                            <th>Пробіг <p>(в км)</p></th>
                            <th>Розмір двигуна</th>
                            <th>Орендна ставка <p> (грн. за добу)</p></th>
                            <th>Статус</th>
                            <!-- <th>Кількість разів в оренді</th> -->
                            <th>Операції</th>
                            
                        </thead>
                        <tbody>
                            <!-- вибірка даних із таблиць vehicle авторизованого користувача -->
                            <?php 
                            if(isset($_COOKIE['user_id'])){
                                $user_id=$_COOKIE['user_id'];
                                $sql = "SELECT * FROM vehicle WHERE owner_id='".$user_id."' AND is_delete=TRUE";
                                $result=$conn->query($sql);
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td> <?php echo $row['id'] ?></td>
                                        <td>
                                             <?php
                                    if($row['photo']!='')
                                    {
                                        $vehicle_photo=$row['photo'];
                                    }
                                     else {
                                        $vehicle_photo="vehicle_icon.png";
                                     }
                                     
                                    $path="/assets/images/vehicle_img/".$vehicle_photo;
                               
                                ?>
                             
                                <img src="<?php echo $path ;?>" class="rounded" width='100' higth='100'>
                             

                                        </td>
                                        <td><?php echo $row['reg_number'] ?></td>
                                        <td><?php 
                                        $sql1 = "SELECT * FROM vehicle_category WHERE id='".$row['vehicle_category_id']."'";
                                        $result1=$conn->query($sql1);
                                        $row1=mysqli_fetch_assoc($result1);
                                        echo $row1['name'] ;
                                        echo "<br> <i>".$row1['description']."</i>";
                                        ?>
                                        
                                        </td>
                                        <td><?php echo $row['current_km'] ?></td>
                                        <td><?php echo $row['engine_size'] ?></td>
                                        <td><?php echo $row['daily_hire_rate'] ?></td>
                                        <td>
                                        <?php 
                                        // отримання назви статусу та його значення за відповідним id із vehicle власника кабінету
                                            $sql2 = "SELECT id, rent_status_id FROM rent WHERE vehicle_id='".$row['id']."' ORDER BY id DESC LIMIT 1"; 
;
                                            $result2=$conn->query($sql2);
                                            $row2=mysqli_fetch_assoc($result2);
                                            // echo $row2;
                                            if($row2==null){
                                                echo "в гаражі";}
                                            else{
                                                $sql3 = "SELECT * FROM rent_status WHERE id='".$row2['rent_status_id']."'";
                                                $result3=$conn->query($sql3);
                                                $row3=mysqli_fetch_assoc($result3);
                                                echo $row3['name'] ;                                   
                                                echo "<br> <i>".$row3['description']."</i>";
                                            }
                                        ?>
                                        
                                        </td>

                                        <td>
                                            <!-- комірка із значеннями редагування -->
                                            <form  action='' method="GET">
                                                <input type="hidden" name="vehicle_id" value="<?php echo $row['id']; ?>">
                                               <button type="submit" name ="reset" class="btn btn-info btn-fill pull-right">Відновити</button>
                                              
                                            </form>

                                        </td>
                                        
                                    </tr>
                               <?php
                                  }
                                  
                               ?>

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
<?php  }
else{
    header("Location:/authorization.php");
} 
?>
<?php
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
 ?>
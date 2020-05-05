<?php
    //почистимо всі cookie
    // setcookie("rent","",0,"/");
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
    //змінна для визначення активної сторінки
    $page ='home';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/header.php';
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/nav.php';
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
                        <h4 class="page-title">Мій автопарк</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">МІй автопарк</li>
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
                <div class="card-header ">
                   <h4 class="card-title">               
                        <div class="btn-group" role="group" >
                            <a  href="modules/autopark/add.php" type="button" class="btn btn-primary">Додати новий транспортний засіб</a>
                        </div>
                    </h4>
                    <p class="card-category">
                        
                    </p>
                </div>


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
                                $sql = "SELECT * FROM vehicle WHERE owner_id='".$user_id."' AND is_delete=FALSE ";
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
                                                echo "в гаражі";
                                                echo "<p><i> Ще не було в експлуатації на сервісі </i> </p>";
                                                }
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
                                            <div class="btn-group" role="group" >
                                              <a  href="modules/autopark/edit.php?id=<?php echo $row['id'] ?>"><i class="m-r-10 mdi mdi-grease-pencil"></i> </a>
                                            <?php 
                                            //vehicle_status за номеном 3 (виконане замовлення)
                                            //якщо ще не було в оренді чи статус замовлення виконано, то можна видаляти в архів  транспортний засіб (кнопка видалення стає активною)
                                            if($row3['id']==3||$row2==null){  
                                            ?>           
                                              <a  href="modules/autopark/delete.php?id=<?php echo $row['id'] ?>">
                                               <!-- type="button" class="btn btn-secondary"> -->
                                                    <i class="m-r-10 mdi mdi-bitbucket"></i>
                                              </a>

                                              <?php }else{
                                                ?>
                                                    <i class="m-r-10 mdi mdi-bitbucket"></i>
                                              </a>
                                              <?php
                                                  }

                                               ?>
                                              </div>
                                            </div>

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

<?php  }
else{
header("Location:/authorization.php");
} 
?>
                <!-- ============================================================== -->
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

<?php
   
    include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
 ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Rent</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rent</li>
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
        <div class="col-12">
            <div class="card">                            
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Імя</th>
                                <th scope="col">Т/З</th>
                                <th scope="col">Дата_поч</th>                                
                                <th scope="col">Дата_зак</th>
                                <th scope="col">Ставка</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Дата створення:</th>
                                <th scope="col">Опції</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $sql= "SELECT * FROM `rent` WHERE `is_delete` = 0 ORDER BY `additional_inf` ASC";
                            $result = $conn->query($sql);
                            $col_users = mysqli_num_rows($result);
                            $i = 0;
                            while ($i < $col_users) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>

                                <td>
                                    <?php
                                    $sqln = "SELECT * FROM `user` WHERE `id` = ".$row['user_id']." ORDER BY `password` DESC";
                                    $resultn = $conn->query($sqln);
                                    $name = mysqli_fetch_assoc($resultn);
                                     echo $name['first_name'];
                                     ?>
                                    </br>
                                    <?php
                                     echo $name['last_name'];
                                    ?>

                                </td>
                                <td>
                                    <?php                                    
                                    $sqlv = "SELECT * FROM `vehicle` WHERE `id` = ".$row['vehicle_id']." ORDER BY `current_km` ASC";
                                    $resultv = $conn->query($sqlv);
                                    $vehicle = mysqli_fetch_assoc($resultv);
                                     echo $vehicle['reg_number']; 
                                    ?>      
                                </td>
                                <td><?php echo $row['date_from']; ?></td>                                
                                <td><?php echo $row['date_to']; ?></td>
                                <td>                                    
                                    <?php
                                    if ($row['payment_received']==0) {
                                        echo "очікується";
                                    }else{
                                        echo "проплачено";
                                    }                                     
                                    ?>                                                         
                                </td>
                                <td>                                 
                                    <?php
                                        $sqls= "SELECT * FROM `rent_status` WHERE `id` = ".$row['rent_status_id']."";
                                        $results = $conn->query($sqls);
                                        $status = mysqli_fetch_assoc($results);
                                        echo $status['name'];
                                    ?>               
                                </td>
                                <td><?php echo $row['created_date']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                              
                                    
                              
                                     <a href="modules/delete/delete_rent.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Delete</a>
                              
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $i=$i+1;
                            }  
                            ?>                                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>
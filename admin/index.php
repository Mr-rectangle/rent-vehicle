<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Користувачі</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Домашня</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">користувачі</li>
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
                                <th scope="col">Прізвище</th>
                                <th scope="col">Пошта</th>                                
                                <th scope="col">Телефон</th>
                                <th scope="col">Замовлення</br></th>
                                <th scope="col">Послуги</br></th>
                                <th scope="col">Опції</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql= "SELECT * FROM `user` WHERE `is_delete` = 0 ORDER BY `password` DESC";
                            $result = $conn->query($sql);
                            $col_users = mysqli_num_rows($result);
                            $i = 0;
                            while ($i < $col_users) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>                                
                                <td><?php echo $row['phone_number']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                     <a href="modules/edit/order_user.php?id=<?php echo $row['id']; ?>">
                                        <?php
                                        $sqli=  "SELECT * FROM `rent` WHERE `is_delete` = 0 AND `user_id` = ".$row['id']."";
                                        $res = $conn->query($sqli);
                                            $col_rent = mysqli_num_rows($res);  
                                        ?>
                                        <?php echo $col_rent; ?>
                                     </a>
                                    </div>
                                </td>
                                <td>
                                    
                                     <a href="modules/edit/services_user.php?id=<?php echo $row['id']; ?>" >
                                        <?php
                                            $sqlk= "SELECT * FROM `vehicle` WHERE `is_delete` = 0 AND `owner_id` = ".$row['id']." ORDER BY `current_km` ASC";
                                            $resk = $conn->query($sqlk);
                                            $col_vehiccle = mysqli_num_rows($resk);
                                        ?>
                                        <?php echo $col_vehiccle; ?>
                                     </a>
                                    
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                              
                                    
                              
                                     <a href="modules/delete/delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Delete</a>
                              
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
    
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-2 align-self-center">
                <h4 class="page-title">Категорії</h4>                
            </div>
            <div class="col-2 align-self-center">                
                <a href="add_categorys.php" class="btn btn-secondary">Add</a>
            </div>

            <div class="col-8 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Домашня</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Категорії</li>
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
                                <th scope="col">Назва</th>
                                <th scope="col">Опис</th>
                                <th scope="col">Фото</th>
                                <th scope="col">Опції</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql= "SELECT * FROM `vehicle_category` ORDER BY `photo` ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['photo']; ?></td>                                
                               <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                              
                                    <a href="edit_categorys.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                              
                                     <a href="modules/delete/delete_categorys.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Delete</a>
                              
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
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>
    
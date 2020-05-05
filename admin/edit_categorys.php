<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';
?>
<?php
if (isset($_GET['submit'])) {
    
  $sql = "UPDATE `vehicle_category` SET `name` = '".$_GET["name"]."', `description` = '".$_GET["description"]."', `photo` = '".$_GET["photo"]."' WHERE `vehicle_category`.`id` = ".$_GET["id"].";";

  $conn->query($sql);

  header("location: /");

}

$sql="SELECT * FROM `vehicle_category` WHERE `id` = ".$_GET["id"]." ORDER BY `photo` ASC";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Редагувати</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Домашня</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="categorys.php">Категорії</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Додати категорію</li>
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
                    <form class="forms_form" action="modules/edit/edit_categorys.php" method="GET">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Назва</th>
                                    <th scope="col">Опис</th>
                                    <th scope="col">Фото</th>
                                    <th scope="col">Опції</th>
                                </tr>
                            </thead>
                            <tbody>                            
                                <tr>
                                    <th scope="row">
                                        <div class="forms_field">
                                        <input type="text" name="name" placeholder="<?php echo $row["name"]; ?>"  class="forms_field-input" required autofocus />
                                        </div>
                                    </th>
                                    <td>
                                        <div class="forms_field">
                                        <input type="text" name="description" placeholder="<?php echo $row["description"]; ?>"  class="forms_field-input" required autofocus />
                                        </div></td>
                                    <td>
                                        <div class="forms_field">
                                        <input type="text" name="photo" placeholder="<?php echo $row["photo"]; ?>"  class="forms_field-input" required autofocus />
                                        </div>

                                    </td>
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $_GET["id"]; ?>">
                                    <td>
                                         <button name="submit" value="1" type="submit" class="btn btn-success btn-fill pull-right">Save</button>
                                    </td>
                                </tr>                                                                
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/footer.php';
?>
    
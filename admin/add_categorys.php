<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

include $_SERVER['DOCUMENT_ROOT'] . '/admin/parts/header.php';

?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Додати категорію</h4>
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
                    <form class="forms_form" action="modules/add/add_categorys.php" method="GET">
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
                                        <input type="text" name="name"   class="forms_field-input" required autofocus />
                                        </div>
                                    </th>
                                    <td>
                                        <div class="forms_field">
                                        <input type="text" name="description"   class="forms_field-input" required autofocus />
                                        </div></td>
                                    <td>
                                        <div class="forms_field">
                                        <input type="text" name="photo"   class="forms_field-input" required autofocus />
                                        </div>

                                    </td>
                                    <td>
                                         <button name="submit" value="1" type="submit" class="btn btn-secondary">Save</button>
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
    
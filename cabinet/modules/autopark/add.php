<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //підключення файлу конфігурації
    include $_SERVER['DOCUMENT_ROOT'].'/configs/configs.php';
   
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
                                        <a href="/cabinet">Кабінет</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="/cabinet/autopark.php">Мій автопарк</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Додавання транспортного засобу</li>
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Додати інформацію про новий транспортний засіб</h4>
                </div>
                <div class="card-body">

<!-- 
                  <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Default Forms</h4>
                            <h5 class="card-subtitle"> All bootstrap element classies </h5>
                            <form class="form-horizontal m-t-30"> -->
                

                    <form id="form"  action="add_vehicle.php"   method="POST" >
                    <!-- enctype="multipart/form-data"                                                      -->


                        <div class="form-group row p-t-20">
                        
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label>Реєстраційний номер </label>
                                <input type="text" class="form-control" name="reg_number" placeholder="реєстраційний номер">
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Пробіг (км) </label>                                    
                                <input type="text" class="form-control" placeholder="пробіг в км" name="current_km">
                            </div>

                            <div class="form-group">
                                <label>Рік випуску</label>                                    
                                <input type="text" class="form-control" placeholder="рік випуску" name="year">
                            </div>

                            <div class="form-group">
                                <label>Розмір двигуна</label>                                  
                                <input type="text" class="form-control" placeholder="розмір двигуна" name="engine_size" >
                            </div>

                            <div class="form-group">
                                <label>Орендна ставка (за добу) </label>
                                <input type="text" class="form-control" name="daily_hire_rate" placeholder="варітсть за добу" >
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <?php
                                    $vehicle_photo="vehicle_icon.png";
                                    $path="/assets/images/vehicle_img/".$vehicle_photo;
                                    
                                ?>
                             <label for="current_file">
                                <img src="<?php echo $path ;?>" class="rounded-circle" width='50'>
                             </label>
                              <input type="file" name="file" value="" />
                            </div>

                            <div class="form-group">
                                <label> Категорія транспортного засобу </label>
                                <div class="form-control">
                                    <select name="vehicle_category_id" class="form-control">
                                        <option value=0>  Не вибрано</option>
                                     <?php 
                                        $sql1 = "SELECT * FROM vehicle_category";
                                        $result1=$conn->query($sql1);
                                        while($row1=mysqli_fetch_assoc($result1)){
                                            echo "<option value='".$row1['id']."' >". $row1['name']. "</option>";
                                        }
                                                                       
                                    ?>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>Модель</label>
                                <input type="text" class="form-control" name="model_name" placeholder="модель">
                            </div>

                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <label  for="customCheck3">Працівник для керування транспортним засобом</label>
                                    
                                    <?php 
                                       
                                    //Якщо є службовець для обслуговування транспорту
                                       echo "<input type='hidden' id='customCheck3'  name='employee'  value='0' checked>";
                                    //за замовчуванням, якщо буде uncheked передасться значення із 1
                                      echo "<input type='checkbox' id='customCheck3'  name='employee' value='1'>";
                                    
                                        
                                       ?> 
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Локація</label>
                                <input type="text" class="form-control" name="location" placeholder="локація">
                            </div>

                            <div class="form-group">
                                <label>Додаткова інформація про транспортний засіб</label>
                                <textarea type="text" class="form-control" name="additional_inf"> 
                                    
                                </textarea>
                            </div>
                        </div>
                    </div>

     
                        <button type="submit" name ="add_vehicle" class="btn btn-info btn-fill pull-right">Додати</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/cabinet/parts/footer.php';
?>   
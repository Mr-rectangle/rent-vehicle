<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //змінна для визначення активної сторінки

/*
===================================
Додавання товару в БД 
*/
    
    if(isset($_GET["id"]))
    {     //видалення  даних і перенесення в аріхів даних про транспортний засіб
        $sql="UPDATE vehicle SET is_delete=TRUE WHERE id=".$_GET['id'];
        
        if(mysqli_query($conn, $sql)){
            echo "<h2>Product add</h2>";
            header("Location: /cabinet/autopark.php");
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }
        //видалення даних  в таблиці rent із даними про оренду поточного транспортного засобу і перенесення до архіву
        $sql1="UPDATE rent SET is_delete=TRUE WHERE vehivle_id=".$_GET["vehicle_id"];
       
        if(mysqli_query($conn, $sql1)){
            echo "<h2>Vehicle reset</h2>";
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }
    
    
    }

    

?>
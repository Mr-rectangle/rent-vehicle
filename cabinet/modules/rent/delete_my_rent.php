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
        $sql="DELETE FROM rent WHERE id=".$_GET['id'];
       var_dump($_GET['id']);
        if(mysqli_query($conn, $sql)){
            echo "<h2>Product add</h2>";
            header("Location: /cabinet/main.php");
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }

    
    
    }

    

?>
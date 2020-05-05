<?php
    //підключення до бази даних
    include $_SERVER['DOCUMENT_ROOT'].'/configs/db.php';
    //змінна для визначення активної сторінки

/*
===================================
Додавання товару в БД 
*/
    
    if(isset($_GET["id"]))
    {     //видалення  даних про архыв (потрібно ще напевне архів записів)
        $sql="UPDATE rent SET is_delete=TRUE WHERE id=".$_GET['id'];
        
        if(mysqli_query($conn, $sql)){
            echo "<h2>Delete rent</h2>";
            header("Location: /cabinet/my_rent_service.php");
        }else{
            echo "<h2>Erro</h2>".mysqli_error($conn);
        }

    
    
    }

    

?>
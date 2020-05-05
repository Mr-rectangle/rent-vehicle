<div class="flip">
    <div class="front" style="background-image: url('<?="../assets/images/vehicle_img/".$product['photo'] ?>')">
        <?php
        $sql_model = "SELECT * FROM model WHERE id =" . $product['model_id'];
        $result_model = $conn->query($sql_model);
        $model = mysqli_fetch_assoc($result_model);
        ?>	
        <h1 class="text-shadow"><?=$model['name'] ?></hi>
        <br/>
        <?php
        if ($product['employee'] != 0) {
          ?>
          <div id="not-exist"><h2 style="background: red">Нема в наявностi</h2></div>
          <?php
        }
        ?>
    </div>
    <div class="back">
       <h2><?=$product['daily_hire_rate']?>$/доба</h2>
       <h4><?=$product['additional_inf'] ?></h4>
       <a href="parts/product.php?id=<?=$product['id'] ?>" class="largeButton portfolioBgColor">Подробиці</a>
    </div>
</div>
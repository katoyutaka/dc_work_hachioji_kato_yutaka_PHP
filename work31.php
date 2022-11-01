<?php 
    $dsn = 'mysql:host=mysql34.conoha.ne.jp;dbname=bcdhm_hoj_pf0001';
    $login_user = 'bcdhm_hoj_pf0001'; 
    $password = 'Au3#DZ~G'; 
 ?>

<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK31</title>
    </head>
    <body>
        <?php 
        try{
            // データベースへ接続
            $db=new PDO($dsn,$login_user,$password);
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
        //SELECT文の実行
        $sql = "SELECT product_id,product_name,price,category_name FROM product JOIN category ON product.category_id = category.category_id WHERE product.category_id =1;";
        if ($result = $db->query($sql)) {
            // 連想配列を取得
            while ($row = $result->fetch()) {
                echo $row["product_id"].$row["product_name"] . $row["price"] .  $row["category_name"] . "<br>";
            }
        }
        ?>
    </body>
</html>
<?php 
    $host = 'mysql34.conoha.ne.jp'; 
    $login_user = 'bcdhm_hoj_pf0001'; 
    $password = 'Au3#DZ~G';   
    $database = 'bcdhm_hoj_pf0001';   
    $error_msg = [];
    $product_name;
    $price;
    $price_val;
    
 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK29</title>
</head>

<body>
<?php
$db = new mysqli($host,$login_user, $password, $database);

if($db->connect_error){
    echo $db->connect_error;
    exit();
}else{

  $db->set_charset("utf8");
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['price'])) {
$price = $_POST['price'];
}
 

$db->begin_transaction();

$insert = 'INSERT INTO product(product_id,product_code,product_name,price,category_id) VALUES(21,1021,"エシャロット",200,1);';
if($result=$db->query($insert)){
$row= $db->affected_rows;
}else{
$error_msg[] = 'insert実行エラー [実行SQL]'.$insert;
            }
if (count($error_msg) == 0) {
echo $row.'件更新しました。'; 
$db->commit();	
}else{
echo '挿入が失敗しました。'; 
$db->rollback();	
            }
}

$select = "SELECT product_name, price FROM product WHERE product_id = 1;";
        if ($result = $db->query($select)) {
            // 連想配列を取得
            while ($row = $result->fetch_assoc()) {
                $product_name = $row["product_name"];
                $price = $row["price"];
            }
            // 結果セットを閉じる
            $result->close();
        }
        if($price == 150) {
            $price_val = 130;
        } else {
            $price_val = 150;
        }

        $db->close();		// 接続を閉じる
?>

    <form method="post">
        <p>エシャロット</p>
        <input type="submit" value="挿入ボタン">
    </form>
</body>
</html>
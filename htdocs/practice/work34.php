<?php 
    $dsn = 'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp';
    $login_user = 'bcdhm_hoj_pf0001'; 
    $password = 'Au3#DZ~G'; 
 ?>

 
<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK34</title>
    </head>
    <body>
        <?php 
        try{
            // データベースへ接続
            $db=new PDO($dsn,$login_user,$password);
            //PDOのエラー時にPDOExceptionが発生するように設定
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $db->beginTransaction();	// トランザクション開始

            //クエリを生成する
            $sql = "SELECT product_name, price FROM product WHERE product_id = ?";

            //prepareメソッドによるクエリの実行準備をする
            $stmt = $db -> prepare($sql);

            //値をバインドする
            $stmt -> bindValue(1, "9");
            

            

            //クエリのの実行
            $stmt->execute();

            $result=$stmt->fetch();
            // print_r ($result);
            print $result["product_name"].$result["price"];
            $db->commit();		// 正常に終了したらコミット
        } catch (PDOException $e){
            echo $e->getMessage();
            $db->rollBack();  		// エラーが起きたらロールバック
        }
        ?>
    </body>
</html>
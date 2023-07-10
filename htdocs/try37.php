<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY37</title>
</head>
<body>
    <?php 
        // データベースへ接続
        $db = new mysqli('mysql34.conoha.ne.jp', 'bcdhm_hoj_pf0001', 'Au3#DZ~G', 'bcdhm_hoj_pf0001');
        if ($db->connect_error){
            echo $db->connect_error;
            exit();
        }else{
            print("データベースへの接続に成功しました。");
        }
        $db->close();		// 接続を閉じる
    ?>
</body>
</html>
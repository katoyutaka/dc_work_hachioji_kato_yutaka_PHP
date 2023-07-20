<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY50</title>
</head>
<body>
    <?php 
        //グローバル変数
        $global_variable = "グローバル変数";

        function set_local_variable(){
            $local_variable ="ローカル変数";
            echo "<p>関数内のローカル変数：".$local_variable."</p>";
            
         // global変数は「global 変数名」で一旦呼び出してから使用する。
            global $global_variable;

            echo "<p>関数内のグローバル変数：".  $global_variable."</p>";
        }

        echo set_local_variable();
        
        echo "<p>関数外のグローバル変数：".$global_variable."</p>";
        echo "<p>関数外のローカル変数：".$local_variable."</p>";
    ?>
</body>
</html>
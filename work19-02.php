<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK19</title>
</head>
<body>
    <!-- getだとtxtファイルに送信できたが、postだとエラーになった。 -->
            <form method="get">
                タイトル
                <br>
                <input type="text" name="title_form">
                <br>
                書き込み内容
                <br>
                <input type="text" name="input_form">
                <br>
                <br>
                <input type="submit" value="送信">

            </form>

   

            <?php 
                    $fp = fopen("work19_write.txt","a");
                    fwrite($fp,$_GET["title_form"]);
                    fwrite($fp,$_GET["input_form"]."\n");
                    fclose($fp);
            ?>

            <?php 
                    $fp = fopen("work19_write.txt","r");
                    while($line = fgets($fp)){
                        print $line.":"."<br>";
                    }
                    fclose($fp);
            ?>
         
</body>
</html>
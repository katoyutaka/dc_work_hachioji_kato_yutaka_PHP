


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK19</title>
</head>
<body>
            <form method="post">
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
                // ifのところはisset($_POST["title_form"])でもいいかも
                if(!$_POST["title_form"]==""){

                // ifのところはisset($_POST["input_form"])でもいいかも
                    if(!$_POST["input_form"]==""){

                        // エスケープ処理した（XSSの攻撃を阻止するやつ）postデータ受信表示
                        ?><ul>
                               <il><?php print htmlspecialchars($_POST["title_form"],ENT_QUOTES,"UTF-8")." : ".htmlspecialchars($_POST["input_form"],ENT_QUOTES,"UTF-8");?></il>
                          </ul>

                    <?php }else{ 
                        print "入力情報が不足しています";
                    }
                }else{
                    print "入力情報が不足しています";
                }
              
            ?>
         
</body>
</html>
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
                    
                    // エスケープ処理した（XSSの攻撃を阻止するやつ）もつけて書きこみ。
                    fwrite($fp,htmlspecialchars($_GET["title_form"],ENT_QUOTES,"UTF-8")."\t");
                    fwrite($fp,htmlspecialchars($_GET["input_form"],ENT_QUOTES,"UTF-8")."\n");
                    fclose($fp);
            ?>



            <?php
                // ifのところはisset($_GET["title_form"])でもいいかも
                if(!$_GET["title_form"]==""){

                    // ifのところはisset($_GET["input_form"])でもいいかも

                        if(!$_GET["input_form"]==""){

                            
                    //  読み込んだ文を「〇：△」と表示させるため、一文をexplodeで分ける。
                    // 分けたものをvar_dumpで調べるとarrayになっていたので、インデックス指定してそれぞれの単語を取り出す。

                            $fp = fopen("work19_write.txt","r");
                            while($line = fgets($fp)){
                                $lines = explode("\t",$line);
                                print $lines[0]." : ".$lines[1]."<br>";
                            }
                            fclose($fp);
                    
                        
                        }else{ 
                            print "入力情報が不足しています";
                        }
                    }else{
                        print "入力情報が不足しています";
                    }

            ?>
                                  

         
</body>
</html>
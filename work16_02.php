<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK16_02</title>
    </head>

    <body>
        <div>フォームに入力した内容を表示する。</div>
            <?php
                if(isset($_GET["name_box"])){
                    print "テキストボックスの入力した内容：".htmlspecialchars($_GET["name_box"],ENT_QUOTES,"UTF-8");
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select01[]"],ENT_QUOTES,"UTF-8");
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select02[]"],ENT_QUOTES,"UTF-8");
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select03[]"],ENT_QUOTES,"UTF-8");
                } else {
                    print "入力されていません";
                }
            ?>
    
    </body>
</html>
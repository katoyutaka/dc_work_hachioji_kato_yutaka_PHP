<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK16_02</title>
    </head>

    <body>
        <div>フォームに入力した内容を表示する。</div>
            <?php
                    print "テキストボックスの入力した内容：".htmlspecialchars($_GET["name_box"],ENT_QUOTES,"UTF-8");
                    print "<br>";
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select"][0],ENT_QUOTES,"UTF-8");
                    print "<br>";
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select"][1],ENT_QUOTES,"UTF-8");
                    print "<br>";
                    print "チェックボックスのボックスの入力した内容：".htmlspecialchars($_GET["select"][2],ENT_QUOTES,"UTF-8");
                    print_r ($_GET["select"]);
            ?>
    
    </body>
</html>
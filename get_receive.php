<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TRY20_2</title>
    </head>



    <body>
        <div>入力内容の取得</div>
        <?php
            if( isset( $_GET['display_text'] ) && $_GET['display_text'] != "") {
                print '入力した内容： ' . $_GET['display_text'];
            } else {
                print '入力されていません';
            }
        ?>
    </body>



</html>
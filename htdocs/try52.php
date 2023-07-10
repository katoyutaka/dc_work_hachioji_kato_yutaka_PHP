<?php setcookie('username',  'login_user',time()+60*60*24); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY52</title>
</head>
<body>
    <?php 
        if(isset($_COOKIE['username'])) {
            echo $_COOKIE['username'];
        } else {
            echo 'Cookieのデータがありません。';
        }
    ?>
</body>
</html>
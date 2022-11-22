<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>TRY54</title>
</head>
<body>
    <?php
        var_dump($_SESSION);

    

        $_SESSION['id'] = 1;
        $_SESSION['username'] = 'login_user';
        $_SESSION['year'] = date("Y");
        var_dump($_SESSION);

        unset($_SESSION['username']); 
        var_dump($_SESSION);
    ?>
</body>
</html>
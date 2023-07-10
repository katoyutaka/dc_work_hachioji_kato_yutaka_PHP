<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>TRY53</title>
</head>



<body>
    <?php
        //cookieに値がある場合、変数に格納する
        if (isset($_COOKIE['cookie_confirmation']) === TRUE) {
            $cookie_confirmation = "checked";
        } else {
            $cookie_confirmation = "";
        }
        if (isset($_COOKIE['login_id']) === TRUE) {
            $login_id = $_COOKIE['login_id'];
        } else {
            $login_id = '';
        }
    ?>
   <form action="home.php" method="post">
       <label for="login_id">ログインID</label><input type="text" id="login_id" name="login_id" value="<?php echo $login_id; ?>"><br>
       <input type="checkbox" name="cookie_confirmation" value="checked" <?php print $cookie_confirmation;?>>次回からログインIDの入力を省略する<br>
       <input type="submit" value="ログイン">
   </form>
</body>



</html>
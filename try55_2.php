

<!-- ログアウトした場合（つまりセッションを切る時） -->

<?php





    if(isset($_POST["logout"])){
        $session = session_name();
        $_SESSION=[];
    }



    

















    if(isset($_COOKIE["cookie_confirmation"])){
        $_cookie_confirmation = $_COOKIE["cookie_confirmation"];
    } else {
        $_cookie_confirmation = "";
    }

    if(isset($_COOKIE["login_id"])){
        $login_id = $_COOKIE["login_id"];
    } else {
        $login_id ="";
    }
?>





<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TRY55_2</title>
</head>
<body>
    <form method="post" action="top_2.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id; ?>"><br>
        <input type="checkbox" name="cookie_confirmation" value="checked"<?php print $cookie_confirmation; ?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">

    </form>




</body>
</html>

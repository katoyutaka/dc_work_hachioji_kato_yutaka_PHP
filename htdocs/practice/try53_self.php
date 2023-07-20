<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <title>TRY53_SELF</title>
</head>
<body>

<?php
// <!-- ➃ -->
// <!-- cookie機能がセット（setcookie）があれば「$cookie_confirmation」の変数にcookieでゲットした値を格納する。入力されなかったら、「$cookie_confirmation」の変数は空欄。 -->
if(isset($_COOKIE["cookie_confirmation"]) === TRUE){
    $cookie_confirmation = "checked";
} else {
    $cookie_confirmation = "";
}
// <!-- cookie機能がセット（setcookie）があれば「$login_id」の変数にcookieでゲットした値を格納する。入力されなかったら、「$login_id」の変数は空欄。 -->
if(isset($_COOKIE["login_id"]) === TRUE){
    $login_id = $_COOKIE["login_id"];
} else {
    $login_id = "";
}




?>
<!-- ➀ -->
<!-- ➄ もしcookie機能があるならば変数$login_idや$cookie_confirmationは出力して、機能ないなら空欄が出力される。 -->
<!-- 「value="php print $login_id ?>」と「value="cookie_check" php print $cookie_confirmation ?>」のためにこれらのコードを書いているようなもの。 -->


    <form method="post" action="home_self.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id; ?> "><br>
        <input type="checkbox" name="cookie_confirmation" value="checked" <?php print $cookie_confirmation; ?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>
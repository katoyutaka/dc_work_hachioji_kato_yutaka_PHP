
<?php
    session_start();

    if($_flag_a=="on"){
        print "セッション中です";
    }
 
    if(isset($_POST["logout"])){

        $session = session_name();
        $_SESSION = [];

        if (isset($_COOKIE[$session])) {

            setcookie($session, '', time() - 30, '/');
            print "<p>ログアウトされました。</p>";
        }
    } else {
        if (isset($_SESSION['login_id'])) {
            header('Location: work38_2.php');
            exit();
        }
    }

?>


<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <title>WORK38_1</title>
</head>
<body>

    <form method="post" action="work38_2.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id; ?>"><br>
        <label>パスワード</label><input type="text" name="password_id" value="<?php print $password_id; ?>"><br>
        <input type="checkbox" name="cookie_confirmation" value="checked" <?php print $cookie_confirmation; ?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>

<?php
    session_start();
    $_SESSION['err_flg'] = FALSE;


    if ($_SESSION['err_flg'] === TRUE) {
        echo "<p>ログインが失敗しました:正しいログインID（半角英数字）を入力してください。</p>";
    }

    // $_SESSION['err_flg'] = FALSE;

    //ログアウト処理がされた場合
    if (isset($_POST["logout"])) {

        $_SESSION = [];
        $session = session_name();
        setcookie($session, '', time() - 30, '/');
        $message = "<p>ログアウトされました。</p>";

    } else {
        if ($_SESSION['err_flg'] = FALSE){
            header('Location:work38_2.php');
            exit();
        }
    }


    // <!-- ➃ -->
    // <!-- cookie機能がセット（setcookie）があれば「$cookie_confirmation」の変数にcookieでゲットした値を格納する。入力されなかったら、「$cookie_confirmation」の変数は空欄。 --
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

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <title>WORK38_1</title>
</head>
<body>
<?php
    if (isset($message)) {
        echo $message;
    }  

?>


    <form method="post" action="work38_2.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id;?>"><br>
        <label>パスワード</label><input type="password" name="password_id" value="<?php print $password_id;?>"><br>
        <input type="checkbox" name="cookie_confirmation" value="checked"<?php print $cookie_confirmation;?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>
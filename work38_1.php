<!-- この課題は入力したIDとパスワードがSQLのデータベースと一致したらログインできて画面が「ログイン（擬似的）が完了しました」に遷移。 -->
<!-- 不一致や未入力ならばログインできないようにする。かつ、cookie機能を付ける。つまり２つ課題がある。 -->
<!-- 可能ならば（余力があれば）、初期にidとパスワードをSQLに登録させる「新規登録」の部分も追加したい。 -->

<?php
    session_start();
    if(isset($_POST["logout"])){

        $session = session_name();
        $_SESSION = [];

        if (isset($_COOKIE[$session])) {
            // sessionに関連する設定を取得
            // $paramsの部分は不要では？
            // $params = session_get_cookie_params();

            // cookie削除
            setcookie($session, '', time() - 30, '/');
            print "<p>ログアウトされました。</p>";
        }
    } else {
        // ログイン中のユーザーであるかを確認する
        if (isset($_SESSION['login_id'])) {
            // ログイン中である場合は、top.phpにリダイレクト（転送）する
            header('Location: work38_2.php');
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

    <form method="post" action="work38_2.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id; ?> "><br>
        <label>パスワード</label><input type="text" name="password_id" value="<?php print $password_id; ?> "><br>
        <input type="checkbox" name="cookie_confirmation" value="checked" <?php print $cookie_confirmation; ?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>

<?php

    session_start();

    $validation_error = [];
    

    if ($_SESSION['err_flg']) {
        echo "<p>ログインが失敗しました:正しいログインID（半角英数字）を入力してください。</p>";
    }

    $_SESSION['err_flg'] = False;

    //ログアウト処理がされた場合
    if (isset($_POST["logout"])) {

        // セッション名を取得する
        $session = session_name();
        // セッション変数を削除
        $_SESSION = [];

        // セッションID（ユーザ側のCookieに保存されている）を削除
        if (isset($_COOKIE[$session])) {
       

            // cookie削除
            setcookie($session, '', time() - 30, '/');
            $message = "<p>ログアウトされました。</p>";
        }

    } else {
        // ログイン中のユーザーであるかを確認する
        if (isset($_SESSION['login_id'])) {
            // ログイン中である場合は、top.phpにリダイレクト（転送）する
            header('Location: work38_22.php');
            exit();
        }
    }



    // <!-- ➃ -->

    if(isset($_COOKIE["cookie_confirmation"]) === TRUE){
        $cookie_confirmation = "checked";
    } else {
        $cookie_confirmation = "";
    }

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
   <title>WORK38_11</title>
   <style>
       .msg{
            color:red;
        }
   </style>
</head>
<body>

    <?php
    // if (isset($validation_error)) {
    //     foreach($validation_error as $err){
    //         print "<span class='msg'>$err</span><br>";
            
    //     }
    // }
    ?>

    <form method="post" action="work38_22.php">
        <label>ログインID</label><input type="text" name="login_id" value="<?php print $login_id;?>"><br>
        <label>パスワード</label><input type="password" name="password_id" value="<?php print $password_id;?>"><br>
        <input type="checkbox" name="cookie_confirmation" value="checked"<?php print $cookie_confirmation;?>>次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>
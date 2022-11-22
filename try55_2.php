

<!-- ログアウトした場合（つまりセッションを切る時） -->

<?php
    if(isset($_POST["logout"])){
        $session = session_name();
        $_SESSION=[];
    }

    if(isset($_cookie_confirmation) === TRUE){
        $_cookie_confirmation = "checked";

    } else {
        $_cookie_confirmation = "";
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
        <label>ログインID</label><input type="text" name="login_id" value=""><br>
        <input type="checkbox" name="cookie_confirmation" value="checked">次回からログインIDの入力を省略する<br>
        <input type="submit" value="ログイン">

    </form>




</body>
</html>

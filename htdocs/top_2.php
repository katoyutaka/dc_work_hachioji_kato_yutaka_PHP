<!-- 下に$_SESSION["login_id"]があるので、セッションスタートの関数使う。 -->
<?php
    // session_start();

    define('EXPIRATION_PERIOD', 1);
    $cookie_expiration = time() + 'EXPIRATION_PERIOD' * 60 *24 * 365;
?>








<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>top_2</title>
</head>


<body>

<!-- try55_2からのpostを取得して変数に代入する。 -->
<?php
    // 「$_SERVER["REQUEST_METHOD"]」は、ユーザーから受け取ったリクエストが、どのような種類なのかを格納。
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["login_id"]) && preg_match("/^[a-zA-Z0-9]+$/",$_POST["login_id"])){
            $_login_id = $_POST["login_id"];
            $_SESSION["login_id"]=$_login_id;
        } else {
                $_login_id = "";
        }

        if(isset($_POST["cookie_confirmation"])){
            $_cookie_confirmation = $_POST["cookie_confirmation"];
        } else {
            $_cookie_confirmation  = "";
        }
    }

// cookieにチェックあればcookie機能つけて、でないならcookie削除する。  
    if($_cookie_confirmation === "checked"){
        setcookie('cookie_confirmation',$_cookie_confirmation,$cookie_expiration);
        setcookie('login_id', $login_id, $cookie_expiration);
    } else {
        setcookie('cookie_confirmation',"",time()-10);
        setcookie('login_id',"",time()-10);
    }
 

    if(isset( $_SESSION["login_id"])){
        print "<br>".$_POST["login_id"]."さん：ログイン中です。<br>";
    } else {
        header("Location:try55.php");
        exit();

    }
    
?>


<form method="post" action="try55_2.php">
    <input type="hidden" name="logout">
    <input type="submit" value="ログアウト">
</form>


</body>
</html>
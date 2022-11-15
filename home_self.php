<?php

    $cookie_expiration= time()+60*60*24;

    // ➁
    // もしログインIDが入力されたら、「$login_id」の変数に格納する。入力されなかったら、「$login_id」の変数は空欄
    if(isset($_POST["login_id"]) === TRUE){
        $login_id = $_POST["login_id"];
    } else {
        $login_id = "";
    }


    // もしチェックボックスがチェックされたら、「$cookie_confirmation」にデータを格納して、チェックされなかったら空欄を格納する。
    if(isset($_POST["cookie_confirmation"]) === TRUE){
        $cookie_confirmation = $_POST["cookie_confirmation"];
    } else {
        $cookie_confirmation = "";
    }

    // ➂
    // 上記で、チェックがあれば（変数「$cookie_confirmation」に値が入れば）、cookie機能つけて、ないなら機能なしでcookie削除。
    if($cookie_confirmation = "checked"){
        setcookie("login_id",$login_id,$cookie_expiration);
        setcookie("cookie_confirmation",$cookie_confirmation,$cookie_expiration);
    } else {
        setcookie("login_id","",time()-100);
        setcookie("cookie_confirmation","",time()-100);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>TRY53_SELF</title>
</head>
<body>
   <p>ログイン（擬似的）が完了しました</p>
</body>
</html>

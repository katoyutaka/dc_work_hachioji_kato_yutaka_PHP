

<?php
    session_start();        

    // cookieの保存期間を１日に設定
    define("EXPIRATION_PERIOD", 1);
    $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

    // // ➁

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["cookie_confirmation"]) === TRUE){
            $cookie_confirmation = $_POST["cookie_confirmation"];
        } else {
            $cookie_confirmation = "";
        }
        
        if(isset($_POST["login_id"]) === TRUE){
            $login_id = $_POST["login_id"];
            $_SESSION['login_id'] =  $login_id;
        } else {
            $login_id = '';
            $_SESSION['err_flg'] = true;

        }

        if(isset($_POST["password_id"]) === TRUE){
            $password_id = $_POST["password_id"];

            $dsn = 'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp';
            $login_user = 'bcdhm_hoj_pf0001'; 
            $password = 'Au3#DZ~G'; 

            $db=new PDO($dsn,$login_user,$password);

            $sql = "SELECT user_id, user_name, password FROM user_table WHERE  user_id = ".$login_id.';"';
            $result = $db->query($sql);
            $row = $result->fetch();
            if($password_id===$row["password"]){
                print "<p>ログイン（擬似的）が完了しました</p>";
                print $row["user_name"]."さん、ようこそ！";
            } else {
                print "ログインに失敗しました";
            }
        }
    }



    // ➂
    if($cookie_confirmation === "checked"){
        setcookie("login_id",$login_id,$cookie_expiration);
        setcookie("cookie_confirmation",$cookie_confirmation,$cookie_expiration);
    } else {
        setcookie("login_id","",time()-100);
        setcookie("cookie_confirmation","",time()-100);
    }


    if (!isset($_SESSION['login_id'])) {
        // ログイン中ではない場合は、try55.phpにリダイレクト（転送）する
        header('Location: work38_1.php');
        exit();
    } else {
        echo "<p>" . $_SESSION['login_id'] . "さん：ログイン中です。</p>";
    }

    
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>work38_2</title>
</head>
<body>
    <form action="work38_1.php" method="post">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="ログアウト">
   </form>
</body>
</html>

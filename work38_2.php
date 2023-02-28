
    <?php
        session_start();       
        
        // cookieの保存期間を１日に設定
        define("EXPIRATION_PERIOD", 1);
        $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

        // // ➁
        // // もしチェックボックスがチェックされたら、「$cookie_confirmation」にデータを格納して、チェックされなかったら空欄を格納する。
        // こちらは$_POSTに値があるならば、、（work37_1は$COOKIEに値があるならば）

        if(isset($_POST["cookie_confirmation"]) === TRUE){
            $cookie_confirmation = $_POST["cookie_confirmation"];
        } else {
            $cookie_confirmation = "";
        }
        // もしログインIDが入力されたら、「$login_id」の変数に格納する。
        if(isset($_POST["login_id"]) === TRUE){
            $login_id = $_POST["login_id"];
            $_SESSION['login_id'] =  $login_id;
        } else {
            $login_id = '';
            
        }
        // もしパスワードが入力されたら、「$password_id」の変数に格納する。
        if(isset($_POST["password_id"]) === TRUE){
            $password_id = $_POST["password_id"];
            $_SESSION['password_id'] = $password_id;
        } else {
            $password_id = "";
            
        }




        // ➂
        // 上記で、チェックがあれば（変数「$cookie_confirmation」に値が入れば）、cookie機能つけて、ないなら機能なしでcookie削除。
        if($cookie_confirmation === "checked"){
            setcookie("login_id",$login_id,$cookie_expiration);
            setcookie("cookie_confirmation",$cookie_confirmation,$cookie_expiration);
        } else {
            setcookie("login_id","",time()-100);
            setcookie("cookie_confirmation","",time()-100);
        }



    ?>






<!-- SQLデータベースからデータをもってきて、入力されたデータと照合させ、OK・NG判定をする部分 -->
        <?php
       
            $dsn = 'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp';
            $login_user = 'bcdhm_hoj_pf0001'; 
            $password = 'Au3#DZ~G'; 

            $db=new PDO($dsn,$login_user,$password);
            // $db->set_charset("utf8");
            
            // 「WHERE  user_id = $login_id」部分をカットして確認
            $sql = "SELECT user_id, user_name, password FROM user_table WHERE  user_id = ".$login_id.';"';

            
            if(isset($password_id)){
                    $result = $db->query($sql);
                    
                    $row = $result->fetch();


                    if($password_id===$row["password"]){
                        print "<p>ログイン（擬似的）が完了しました</p>";
                        print $row["user_name"]."さん、ようこそ！";
                    } else {
                        print "ログインに失敗しました";
                        $_SESSION['err_flg'] === TRUE;
                    }
        }

        // if ($_SESSION['err_flg'] === TRUE){
        //     // ログイン中ではない場合は、try55.phpにリダイレクト（転送）する
        //     header('Location: work38_1.php');
        //     exit();
        // } else {
        //     echo "<p>" . $_SESSION['login_id'] . "さん：ログイン中です。</p>";
        // }
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
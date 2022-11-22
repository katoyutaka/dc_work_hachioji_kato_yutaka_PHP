
<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK37_2</title>
    </head>

    <body>



                <?php
                    
                    // cookieの保存期間を１日に設定
                    define("EXPIRATION_PERIOD", 1);
                    $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

                    // // ➁
                    // // もしチェックボックスがチェックされたら、「$cookie_confirmation」にデータを格納して、チェックされなかったら空欄を格納する。
                    if(isset($_POST["cookie_confirmation"]) === TRUE){
                        $cookie_confirmation = $_POST["cookie_confirmation"];
                    } else {
                        $cookie_confirmation = "";
                    }
                    // もしログインIDが入力されたら、「$login_id」の変数に格納する。
                    if(isset($_POST["login_id"]) === TRUE){
                        $login_id = $_POST["login_id"];
                    }
                    // もしパスワードが入力されたら、「$password_id」の変数に格納する。
                    if(isset($_POST["password_id"]) === TRUE){
                        $password_id = $_POST["password_id"];
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

            
            
            $result = $db->query($sql);
            
            $row = $result->fetch();
            // print $login_id."<br>";
            // print $password_id."<br>";
            // print $row["user_id"]."<br>";
            // print $row["user_name"]."<br>";
            // print $row["password"]."<br>";

            if($password_id===$row["password"]){
                print "<p>ログイン（擬似的）が完了しました</p>";
                print $row["user_name"]."さん、ようこそ！";
            } else {
                print "ログインに失敗しました";
            }


        ?>
</body>
</html>

        <?php
                $host = 'mysql34.conoha.ne.jp'; 
                $login_user = 'bcdhm_hoj_pf0001'; 
                $password = 'Au3#DZ~G';   
                $database = 'bcdhm_hoj_pf0001';

            session_start();
            // cookieの保存期間を１日に設定
            define("EXPIRATION_PERIOD", 1);
            $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

            // // ➁
            // // もしチェックボックスがチェックされたら、「$cookie_confirmation」にデータを格納して、チェックされなかったら空欄を格納する。
            // こちらは$_POSTに値があるならば、、（work37_1は$COOKIEに値があるならば）
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["cookie_confirmation"])){
                    $cookie_confirmation = $_POST["cookie_confirmation"];
                } else {
                    $cookie_confirmation = "";
                }
                // もしログインIDが入力されたら、「$login_id」の変数に格納する。
                if(isset($_POST["login_id"])){

                    $login_id = $_POST["login_id"];
                    $_SESSION['login_id'] =  $login_id;

                } else {
                    $login_id = '';
                    $_SESSION['err_flg'] = true;
                }
                // もしパスワードが入力されたら、「$password_id」の変数に格納する。
                if(isset($_POST["password_id"])){
                    $password_id = $_POST["password_id"];
                }
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

            if (!isset($_SESSION['login_id'])) {
                // ログイン中ではない場合は、try55.phpにリダイレクト（転送）する
                header('Location: work38_1.php');
                exit();
            } else {
                echo "<p>" . $_SESSION['login_id'] . "さん：ログイン中です。</p>";
            }
        ?>






<!-- SQLデータベースからデータをもってきて、入力されたデータと照合させ、OK・NG判定をする部分 -->
        <?php
            $db = new mysqli($host, $login_user, $password, $database);
            $db->set_charset("utf8");
            
            // 「WHERE  user_id = $login_id」部分をカットして確認
            $sql = "SELECT user_id, user_name, password FROM user_table WHERE  user_id = '$login_id';";
            
            
            $result = $db->query($sql);
            $db->close();
            
            while($row = $result->fetch_assoc()){

                if($password_id===$row["password"]){
                    print "<p>ログイン（擬似的）が完了しました</p>";
                    print $row["user_name"]."さん、ようこそ！";
                } else {
                    print "ログインに失敗しました";
                }
        }


        ?>


<!DOCTYPE html>
    <html lang="ja">
        <head>
        <meta charset="UTF-8">
        <title>WORK38_2</title>
        </head>
        <body>
            <form action="work38_1.php" method="post">
                <input type="hidden" name="logout" value="logout">
                <input type="submit" value="ログアウト">
            </form>
        </body>
</html>
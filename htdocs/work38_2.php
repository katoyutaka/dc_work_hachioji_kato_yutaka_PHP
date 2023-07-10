
    <?php
        session_start();       
        
        // cookieの保存期間を１日に設定
        define("EXPIRATION_PERIOD", 1);
        $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

        // // ➁
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if(isset($_POST["cookie_confirmation"])){
                $cookie_confirmation = $_POST["cookie_confirmation"];
            } else {
                $cookie_confirmation = "";
            }
            
            $login_id = '';
            $password_id = "";
            //$_POST["login_id"]があり$_POST["password_id"]もあったら変数に入れる。
            if((!empty($_POST["login_id"])) && (!empty($_POST["password_id"]))){
                    
                $login_id = $_POST["login_id"];
                $password_id = $_POST["password_id"];


                $dsn = 'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp';
                $login_user = 'bcdhm_hoj_pf0001'; 
                $password = 'Au3#DZ~G'; 
    
                $db=new PDO($dsn,$login_user,$password);
                $sql = "SELECT user_id, user_name, password FROM user_table WHERE user_id = :login_id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':login_id', $login_id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();

                //さらにデータベースと一致したら、セッション変数に正式に個人情報を保存する。
                if($password_id === $row["password"]){
                    $_SESSION["login_id"] =  $login_id;
                    $_SESSION["password_id"] = $password_id;

                    print "<p>ログイン（擬似的）が完了しました</p>";
                    print $row["user_name"]."さん、ようこそ！";

                } else {
                    $_SESSION['err_flg'] = TRUE;
                    $_SESSION["message"] = "ログインIDまたはパスワードが間違っています";
    
                    header('Location:work38_1.php');
                    exit();
                }
            
            } else {
                $_SESSION['err_flg'] = TRUE;
                $_SESSION["message"] = "未入力項目があります";

                header('Location:work38_1.php');
                exit();
        
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


        // ログイン中のユーザーであるかを確認する
        if (isset($_SESSION['login_id'])) {
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
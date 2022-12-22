
        <?php
            $host = 'mysql34.conoha.ne.jp'; 
            $login_user = 'bcdhm_hoj_pf0001'; 
            $password = 'Au3#DZ~G';   
            $database = 'bcdhm_hoj_pf0001';

            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if(isset($_POST["login_id"])){
                    $login_id = $_POST["login_id"];
                } 
            
                if(isset($_POST["password_id"])){
                    $password_id = $_POST["password_id"];
                }
            }

            if($_flag_a=="on"){
                print "セッション中です";
            }
            // if (isset($_SESSION['login_id'])) {
            //     echo "<p>" . $_SESSION['login_id'] . "さん：ログイン中です。</p>";
            // } else {
            //     header('Location: work38_1.php');
            //     exit();
                
            // }
    
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
                    
                    $_SESSION['login_id'] =  $login_id;
                    $_flag_a = "on";

                }else{
                    $login_id = '';
                    header('Location: work38_1.php');
                    exit();
                    
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
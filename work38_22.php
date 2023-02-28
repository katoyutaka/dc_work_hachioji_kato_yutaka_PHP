
<?php
    session_start();

    // cookieの保存期間を１日に設定
    define("EXPIRATION_PERIOD", 1);
    $dsn = 'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp';
    $login_user = 'bcdhm_hoj_pf0001'; 
    $password = 'Au3#DZ~G'; 

    $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;
    $validation_error = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // バリデーションチェック
        $login_id= "";
        if(!empty($_POST["login_id"])){
            $login_id = htmlspecialchars($_POST['login_id'], ENT_QUOTES, 'UTF-8');
            $_SESSION['login_id'] =  $login_id;

        }else{
            $validation_error[] = "ログインIDが未入力です。"."<br>"; 
        }


        $password_id= "";
        if(!empty($_POST["password_id"])){
            $password_id = htmlspecialchars($_POST['password_id'], ENT_QUOTES, 'UTF-8');
            $_SESSION["password_id"] =  $password_id;

        }else{
            $validation_error[] = "パスワードが未入力です。"."<br>";
        }


        // バリデーションチェックをパスしたらデータベース接続
        if (empty($validation_error) ){

            $db=new PDO($dsn,$login_user,$password);

            // try{
            //     $db=new PDO($dsn,$login_user,$password);
            // } catch (PDOException $e){
            //     $str = $e->getMessage();
            //     print "<span class='msg'>$str</span><br>";
            //     exit();
            // }

            $sql = "SELECT user_id, user_name, password FROM user_table WHERE user_id = ".$login_id.';"';
            
            $result = $db->query($sql);
                $row = $result->fetch();

                if($password_id===$row["password"]){
                    print "<p>ログイン（擬似的）が完了しました</p>";
                    print $row["user_name"]."さん、ようこそ！";
                    // $str1 ="<p>ログイン（擬似的）が完了しました</p>";
                    // $str2 = $row["user_name"]."さん、ようこそ！";

                    // print "<span class='msg'>$str1</span><br>";
                    // print "<span class='msg'>$str2</span><br>";

                } else {
                    print "ログインに失敗しました";
                    // $str = "パスワードが一致しないためログイン失敗しました。"."<br>";
                    // print "<span class='msg'>$str</span><br>";

                }
            }
        }

   
        


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
        } else {
            $password_id = '';
            $_SESSION['err_flg'] = true;

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
        header('Location: work38_11.php');
        exit();
    } else {
        echo "<p>" . $_SESSION['login_id'] . "さん：ログイン中です。</p>";
    }

    
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>work38_22</title>
   <style>
       .msg{
            color:red;
        }
   </style>
</head>
<body>
    <form action="work38_11.php" method="post">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="ログアウト">
   </form>
</body>
</html>

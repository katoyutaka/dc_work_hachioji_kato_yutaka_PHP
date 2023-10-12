<?php


session_start();

define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
define("LOGIN_USER",'bcdhm_hoj_pf0001');
define("PASSWORD",'Au3#DZ~G');
define("EXPIRATION_PERIOD", 1);

$cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;
$login_user_name = $_SESSION["login_user_name"];

try{
     $db=new PDO(DSN,LOGIN_USER,PASSWORD);
     $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


 } catch (PDOException $e){
     print $e->getMessage();
     exit();
 }


        // $ok_sign_up_password_1="";
        $user_check="";
        $ok_login_user_name="";
        $login_user_name="";
        $sign_up_password_1="";


        $validation_error1 =array();
        $validation_error2 =array();


        //クッキーのデータ保存
        if(isset($_COOKIE["user_check"])){
            $cookie_user_check = "checked";
        } else {
            $cookie_user_check = "";
        }


        if(isset($_COOKIE["login_user_name"])){
            $cookie_login_user_name = $_COOKIE["login_user_name"];
        } else {
            $cookie_login_user_name = "";
        }



        if(isset($_COOKIE["sign_up_password_1"])){
            $cookie_sign_up_password_1 = $_COOKIE["sign_up_password_1"];
        } else {
            $cookie_sign_up_password_1 = "";
        }


?>


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["user_check"])){
            $user_check = htmlspecialchars($_POST['user_check'], ENT_QUOTES, 'UTF-8');
            
        }else{
            $user_check="";

        }



        
        
        //バリデーションチェック           
        if(isset($_POST['login_user_name'])){
            
            $login_user_name="";
            $login_user_name = htmlspecialchars($_POST['login_user_name'], ENT_QUOTES, 'UTF-8');
        

            if(empty($login_user_name)){
                $validation_error1[] = "ユーザー名が未入力です";

            } elseif($login_user_name === "ec_admin"){
                $ok_login_user_name = "ec_admin";

            } elseif(preg_match("/^[a-z0-9]{5,}+$/",$login_user_name)){

                $ok_login_user_name = $login_user_name;

            } else {
                $validation_error1[] = "ユーザー名が半角英数字以外の形式か、５文字未満になっています";

            }
        }

        

        if(isset($_POST['sign_up_password_1'])){

            $sign_up_password_1="";
            $sign_up_password_1 = htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');
            
            
            if(empty($sign_up_password_1)){
                $validation_error2[] = "パスワードが未入力です";
                
                    

            } elseif(($sign_up_password_1 === "ec_admin")){
                $ok_sign_up_password_1 = "ec_admin";

            }elseif(preg_match("/^[a-z0-9]{8,}+$/", $sign_up_password_1)){
                $ok_sign_up_password_1 = $sign_up_password_1;

            } else {
                $validation_error2[] = "パスワードが半角英数字以外の形式か、８文字未満になっています";
                

            }
        }


        //「ログイン」が押されたときの処理
        if((isset($_POST["login_button"]))){



            //IDとパスワード共にec_adminの時は、商品管理ページへ行く
            if(($ok_login_user_name === "ec_admin") && ($ok_sign_up_password_1 === "ec_admin")){

                
                //セッションの話
                $_SESSION["login_user_name"]= $ok_login_user_name;
                $_SESSION["sign_up_password_1"] = $ok_sign_up_password_1;

                header('Location:control_page.php');
                exit();
            }

            //バリデーションチェックでOKならばデータ接続
            if ((empty($validation_error1)) && (empty($validation_error2))){

                $AS ="1";
                // $select = 'SELECT * FROM ec_user_table WHERE user_name = "yutaka12345678";';
                

                // $result = $db->query($select);
                //     $row = $result->fetch();
                //         $final_password= $row["password"];
                    


                
                $select = 'SELECT * FROM ec_user_table WHERE user_name = :user_name;';
                $stmt = $db -> prepare($select);

                $stmt->bindValue(":user_name","yutaka12345678");
                $stmt->execute();
                $result = $stmt->fetch();
    
                $final_password= $result["password"];
                        
                if($final_password === $ok_sign_up_password_1){

                        //「チェック」が入っていたらクッキー保存する
                        if($user_check==="checked"){
                            //クッキーの話
                            setcookie("user_check",$user_check,$cookie_expiration);
                            setcookie("login_user_name",$login_user_name,$cookie_expiration);  
                            setcookie("sign_up_password_1",$sign_up_password_1,$cookie_expiration);

                                                        
                        } else{
                            setcookie("login_user_name","",time()-220);  
                            setcookie("sign_up_password_1","",time()-220);
                        }

                        //セッションの話
                        $_SESSION["login_user_name"]= $ok_login_user_name;
                        $_SESSION["sign_up_password_1"] = $ok_sign_up_password_1;


                        //↓はショッピングサイト内へ行く
                        // header('Location:catalog_page.php');
                        // exit();
    
                } else {
                    $str = "ユーザー名またはパスワードが一致しません";

                    //ここでクッキーに入れた失敗したログイン情報を消す。

                    setcookie("user_check","",time()-220);
                    setcookie("login_user_name","",time()-220);  
                    setcookie("sign_up_password_1","",time()-220);
                    
                }
            }          

        
            } else{
                    //ここでクッキーに入れた失敗したログイン情報を消す。

                    setcookie("user_check","",time()-220);
                    setcookie("login_user_name","",time()-220);  
                    setcookie("sign_up_password_1","",time()-220);
                    
            }
        
    


        if(isset($_POST["sign_up_button"])){
            header('Location:membership_terms.php');
            exit();
        }

    }

        
    //ログイン中であれば、catalog_page.phpに遷移させ、index.phpには行かないようにする。
    // if (isset($_SESSION['login_user_name'])) {
    //     header('Location:catalog_page.php');
    //     exit(); 
    // }

            
?>



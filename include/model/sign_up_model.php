
<?php
      session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');

       try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
   
        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }

?>

<?php

    //バリデーションチェック
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['sign_up_user_name'])){
            
            $sign_up_user_name="";
            $sign_up_user_name = htmlspecialchars($_POST['sign_up_user_name'], ENT_QUOTES, 'UTF-8');
        

            if(empty($sign_up_user_name)){
                $validation_error1[] = "ユーザー名が未入力です";

            } elseif (preg_match("/^[a-z0-9]{5,}+$/",$sign_up_user_name)){

                $ok_sign_up_user_name = $sign_up_user_name;

            } else {
                $validation_error1[] = "ユーザー名が半角英数字以外の形式か、５文字未満になっています";

            }
        }


        
        if(isset($_POST['sign_up_password_1'])){
            
            $sign_up_password_1="";
            $sign_up_password_1= htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');
        

            if(empty($sign_up_password_1)){
                $validation_error2[] = "パスワードが未入力です";

            } elseif (preg_match("/^[a-z0-9]{8,}+$/",$sign_up_password_1)){

                $ok_sign_up_password_1 = $sign_up_password_1;

            } else {
                $validation_error2[] = "パスワードが半角英数字以外の形式もしくは８文字未満になっています";
            }
            
        }


        if(isset($_POST['sign_up_password_2'])){
            
            $sign_up_password_2="";
            $sign_up_password_2= htmlspecialchars($_POST['sign_up_password_2'], ENT_QUOTES, 'UTF-8');
        

            if(empty($sign_up_password_2)){
                $validation_error3[] = "パスワード（再確認）が未入力です";

            } elseif (preg_match("/^[a-z0-9]{8,}+$/",$sign_up_password_2)){

                $ok_sign_up_password_2 = $sign_up_password_2;

            } else {
                $validation_error3[] = "パスワード（再確認）が半角英数字以外の形式もしくは８文字未満になっています";
            }
            
        }


        
        if((!($ok_sign_up_password_1 === $ok_sign_up_password_2)||!($sign_up_password_1 === $sign_up_password_2))){
            
            $validation_error4[]="パスワードとパスワード（再確認）が一致しません"."<br>";

        }


        //バリデーションチェックOKならば次のページへ行く
        if ((empty($validation_error1)) && (empty($validation_error2)) && (empty($validation_error3)) && (empty($validation_error4))){
    
            $_SESSION["login_user_name"]= $ok_sign_up_user_name;
            $_SESSION["sign_up_password_1"] = $ok_sign_up_password_1;

            header('Location:confirm_sign_up.php');
            exit();
        }


        if(isset($_POST["reverse-button"])){
            header('Location:membership_terms.php');
            exit();

        }

    }
    
?>


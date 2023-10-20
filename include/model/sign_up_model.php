
<?php

    function get_connect(){
        try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }
        return $db;
    }


    function sign_up(){

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
    
        
        return array($sign_up_user_name, $ok_sign_up_user_name,$sign_up_password_1,$ok_sign_up_password_1,$validation_error1,$sign_up_password_2,$ok_sign_up_password_2,$validation_error2,$validation_error3,$validation_error4); 
    }


    
?>


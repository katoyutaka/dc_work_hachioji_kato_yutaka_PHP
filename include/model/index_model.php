<?php
    require_once __DIR__.'/../config/config.php';

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


    //バリデーションチェック

    function index_validation(){
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

        return array($login_user_name,$validation_error1,$ok_login_user_name,$sign_up_password_1,$validation_error2,$ok_sign_up_password_1);
    }




    function select_user_name(){

        $db = get_connect();
        global $ok_login_user_name;

        $select = 'SELECT * FROM ec_user_table WHERE user_name = :user_name;';
        $stmt = $db -> prepare($select);
        $stmt->bindValue(":user_name",$ok_login_user_name);
        $stmt->execute();
        $result = $stmt->fetch();
        $final_password= $result["password"];

        return $final_password;
    }


       
?>



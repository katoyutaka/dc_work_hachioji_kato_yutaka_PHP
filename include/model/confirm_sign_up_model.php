
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


    function confirm_button(){

        $db = get_connect();
        global $ok_login_user_name;
        global $ok_sign_up_password_1;

        $create_date = date('Ymd');
        $update_date = date('Ymd');

        $insert = "INSERT INTO ec_user_table (user_name,ec_user_table.password, create_date, update_date) VALUES (:ok_login_user_name,:ok_sign_up_password_1,:create_date,:update_date);";
        
        $stmt = $db -> prepare($insert);

        $stmt->bindValue(":ok_login_user_name",$ok_login_user_name);
        $stmt->bindValue(":ok_sign_up_password_1",$ok_sign_up_password_1);
        $stmt->bindValue(":create_date",$create_date);
        $stmt->bindValue(":update_date",$update_date);
            
        try{
            $stmt->execute();
                
            header('Location:complete_sign_up.php');
            exit();

        }catch (PDOException $e){
            $str = "既に会員登録済みです。"."<br>"."ログイン画面よりログイン下さい。";

        }

        return array($str);
    }
                

?>




<?php

    require_once '../include/config/config.php';

    $ok_login_user_name= $_SESSION["login_user_name"];
    $ok_sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["confirm-button"])){

                $create_date = date('Ymd');
                $update_date = date('Ymd');

                $insert = "INSERT INTO ec_user_table (user_name,ec_user_table.password, create_date, update_date) VALUES (:ok_login_user_name,:ok_sign_up_password_1,:create_date,:update_date);";
                $stmt = $db -> prepare($insert);

                $stmt->bindValue(":ok_login_user_name",$ok_login_user_name);
                $stmt->bindValue(":ok_sign_up_password_1",$ok_sign_up_password_1);
                $stmt->bindValue(":create_date",$create_date);
                $stmt->bindValue(":update_date",$update_date);

                $stmt->execute();
                $result = $stmt->fetch();
            
                    
                header('Location:complete_sign_up.php');
                exit();


        } else {
            $str = "既に会員登録済みです。"."<br>"."ログイン画面よりログイン下さい。";
            
            
        }


        if(isset($_POST["reverse-button"])){
            header('Location:sign_up.php');
            exit();
        }

        
        }
?>



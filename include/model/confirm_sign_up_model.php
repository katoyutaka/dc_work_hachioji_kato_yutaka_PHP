
<?php

    require_once '../include/config/config.php';

    $ok_sign_up_user_name = $_SESSION["ok_sign_up_user_name"];
    $ok_sign_up_password_1 = $_SESSION["ok_sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["confirm-button"])){

                $create_date = date('Ymd');
                $update_date = date('Ymd');

                //あとでプレースホルダやる
                $insert = "INSERT INTO ec_user_table (user_name, password, create_date, update_date) VALUES ('$ok_sign_up_user_name','$ok_sign_up_password_1',".$create_date.",".$update_date.");";

                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
                
                if($result=$db->query($insert)){
                    
                    header('Location:complete_sign_up.php');
                    exit();


                } else {
                    $str = "既に会員登録済みです。"."<br>"."ログイン画面よりログイン下さい。";
                    
                    
                }

        
        }

        if(isset($_POST["reverse-button"])){
            header('Location:sign_up.php');
            exit();
        }
    }

?>



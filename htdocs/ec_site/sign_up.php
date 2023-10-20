<?php

    require_once '../include/config/config.php';
    require_once '../../include/model/sign_up_model.php';

    //バリデーションチェック
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $sign_up = array();
        $sign_up =  sign_up();


        $sign_up_user_name       =  $sign_up[0];
        $ok_sign_up_user_name    =  $sign_up[1];
        $sign_up_password_1      =  $sign_up[2];
        $ok_sign_up_password_1   =  $sign_up[3];
        $validation_error1       =  $sign_up[4];
        $sign_up_password_2      =  $sign_up[5];
        $ok_sign_up_password_2   =  $sign_up[6];
        $validation_error2       =  $sign_up[7];
        $validation_error3       =  $sign_up[8];
        $validation_error4       =  $sign_up[9];


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

    include_once '../../include/view/sign_up_view.php';

?>

<?php

    require_once '../include/config/config.php';
    require_once '../../include/model/address_page_model.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //バリデーションチェック

        $add = array();
        $add = address_validation_func();


        $input_user_name_form = $add[0];
        $input_hiragana_form = $add[1];
        $input_birthday_form =  $add[2];
        $input_address_form = $add[3];
        $input_phone_number_form= $add[4];
        $input_mail_address_form = $add[5];

        $validation_error1  = $add[6];
        $validation_error2  = $add[7];
        $validation_error3  = $add[8];
        $validation_error4  = $add[9];
        $validation_error5  = $add[10];
        $validation_error6  = $add[11];

        //バリデーションチェックでOKならば、各入力データをセッション変数にいれて保管する。
        if ((empty($validation_error1) ) && (empty($validation_error2)) && (empty($validation_error3)) && (empty($validation_error4)) && (empty($validation_error5)) && (empty($validation_error6))){

            $_SESSION["input_user_name_form"] = $input_user_name_form;
            $_SESSION["input_hiragana_form"] = $input_hiragana_form;
            $_SESSION["input_birthday_form"] = $input_birthday_form;
            $_SESSION["input_address_form"]  = $input_address_form;
            $_SESSION["input_phone_number_form"] = $input_phone_number_form;
            $_SESSION["input_mail_address_form"] = $input_mail_address_form;

            if(isset($_POST["next-button"])){
                header('Location:payment_page.php');
                exit();
            }
    
        }


        if(isset($_POST["reverse-button"])){
            header('Location:catalog_page.php');
            exit();
        }

  
        if(isset($_POST["logout_tag"])){  
            //ログアウトが押されたら、セッションのみを消してクッキーは消さないで、index.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            header('Location:index.php');
            exit();
        }

        if(isset($_POST["cart_tag"])){
            header('Location:cart_page.php');
            exit();

        
        }

        if(isset($_POST["favorite_tag"])){
            // header('Location:index.php');
            // exit();

            }

            if(isset($_POST["mypage_tag"])){
            // header('Location:index.php');
            // exit();

            }

    }

    //ログアウトであれば、address_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }


    include_once '../../include/view/address_page_view.php';

?>

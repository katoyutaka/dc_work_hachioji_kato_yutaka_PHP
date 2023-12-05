<?php
    require_once __DIR__.'/../../include/model/complete_page_model.php';

    $login_user_name = $_SESSION["login_user_name"];

    //注文者情報
    $input_user_name_form = $_SESSION["input_user_name_form"];
    $input_hiragana_form=  $_SESSION["input_hiragana_form"];
    $input_birthday_form = $_SESSION["input_birthday_form"];
    $input_address_form = $_SESSION["input_address_form"];
    $input_phone_number_form = $_SESSION["input_phone_number_form"];
    $input_mail_address_form = $_SESSION["input_mail_address_form"];


    //支払い方法
    $input_card_number_form = $_SESSION["input_card_number_form"];
    $input_security_number_form = $_SESSION["input_security_number_form"];
    $expiration_date_month = $_SESSION["expiration_date_month"];
    $expiration_date_year = $_SESSION["expiration_date_year"];
    $payment_method_button = $_SESSION["payment_method_button"];
    $select_conveni=  $_SESSION["select_conveni"];
    $smartphone_payment_method_button = $_SESSION["smartphone_payment_method_button"];


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["reverse-button"])){
            header('Location:catalog_page.php');
            exit();
        }


        if((isset($_POST["logout_tag"]))||(isset($_POST["logout-button"]))){  
            //ログアウトが押されたら、セッションのみを消してクッキーは消さず、index.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            logout_delete_cart();

            header('Location:index.php');
            exit();
        }

        if(isset($_POST["cart_tag"])){
            header('Location:cart_page.php');
            exit();
        }

    }

    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }

    
    include_once __DIR__.'/../../include/view/complete_page_view.php';

?>

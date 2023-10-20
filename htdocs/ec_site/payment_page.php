<?php


    require_once '../include/config/config.php';
    require_once '../../include/model/payment_page_model.php';


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $conveni = $_POST["select_conveni"];


        $payment_page_validation = array();
        $payment_page_validation = payment_page_validation();

        $input_card_number_form            = $payment_page_validation[0];
        $input_security_number_form        = $payment_page_validation[1];
        $expiration_date_month             = $payment_page_validation[2];
        $expiration_date_year              = $payment_page_validation[3];
        $select_conveni                    = $payment_page_validation[4];
        $smartphone_payment_method_button  = $payment_page_validation[5];
        $payment_method_button             = $payment_page_validation[6];
        $validation_error1                 = $payment_page_validation[7];
        $validation_error2                 = $payment_page_validation[8];
        $validation_error3                 = $payment_page_validation[9];                
        $validation_error4                 = $payment_page_validation[10];
        $validation_error5                 = $payment_page_validation[11];
        $validation_error7                 = $payment_page_validation[12];
        $validation_error8                 = $payment_page_validation[13];


        if(isset($_POST["reverse-button"])){
            header('Location:address_page.php');
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


        //バリデーションチェックでOKならば、各入力データをセッション変数にいれて保管する。
        if ((empty($validation_error1)) && (empty($validation_error2))&& (empty($validation_error3) )&& (empty($validation_error4)) && (empty($validation_error5)) && (empty($validation_error6)) && (empty($validation_error7)) && (empty($validation_error8))){

            $_SESSION["input_card_number_form"] = $input_card_number_form;
            $_SESSION["input_security_number_form"] = $input_security_number_form;
            $_SESSION["expiration_date_month"] = $expiration_date_month;
            $_SESSION["expiration_date_year"]  = $expiration_date_year;
            $_SESSION["payment_method_button"] = $payment_method_button;
            $_SESSION["select_conveni"] = $select_conveni;
            $_SESSION["smartphone_payment_method_button"] = $smartphone_payment_method_button;
            

            if(isset($_POST["next-button"])){
                header('Location:confirmation_page.php');
                exit();
            }
    
        }
    
    }

            

    //ログアウトであれば、payment_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }

   
    
    include_once '../../include/view/payment_page_view.php';

?>

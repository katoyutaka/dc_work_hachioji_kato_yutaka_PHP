<?php


    require_once __DIR__.'/../../include/model/confirm_sign_up_model.php';



    //ログイン状態でcatalog_pageに行くようにセッション変数を入れておく
     $login_user_name = $_SESSION["login_user_name"];
     $sign_up_password_1 = $_SESSION["sign_up_password_1"];


    $ok_login_user_name= $_SESSION["login_user_name"];
    $ok_sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["confirm-button"])){

            $confirm_button = array();
            $confirm_button = confirm_button();
            $str = $confirm_button[0];
        
        }

        if(isset($_POST["reverse-button"])){
            header('Location:sign_up.php');
            exit();
        }
    }

    include_once __DIR__.'/../../include/view/confirm_sign_up_view.php';

?>

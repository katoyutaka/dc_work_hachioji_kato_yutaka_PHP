
<?php


    require_once '../include/config/config.php';

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
            header('Location:index.php');
            exit();
        }



        if((isset($_POST["logout_tag"]))||(isset($_POST["logout-button"]))){  
            //ログアウトが押されたら、セッションのみを消してクッキーは消さず、index.phpに遷移する。
            $_SESSION=[];
            session_destroy();

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
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文完了</title>
    <style>

                html,
                body,
                ul,
                ol,
                li,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                p,
                div {
                    margin: 0;
                    padding: 0;
                }


                * {
                    box-sizing:border-box;
                    vertical-align:middle;
                    font-family: system-ui;
                    letter-spacing: 2px;

                }
  


                .main_wrapper{
                    width: 1000px;
                    height:500px;
                    margin:0 auto;
                    /* background-color: #000099; */
                    margin-top: 100px;
                    /* z-index: 5; */
                }

                .logout-button{
                        background-color: #000099;
                        color:white;
                        margin-left:10px;
                        transition: all 0.6s;
                        cursor: pointer;
                        float: right;
                }

                .reverse-button{
                    color:#000099;
                    transition: all 0.6s;
                    cursor: pointer;
                    float: left;
                }

                
                .button_container{
                        width:100%;
                        margin:0 auto;
                        margin-top:50px;
                        width:600px;
                        height: 60px;
                }

                .logout-button,.reverse-button{
                        margin:0 auto;
                        width:250px;
                        height: 50px;
                        border-radius: 1px;
                        border: 1px solid #000099;
                        font-size:14px;
                        margin-right:10px;
                        
                }

                .order_label{
                    font-size: 50px;
                    font-weight: bolder;
                    height: 50px;
                    width: 1000px;
                    text-align: center;
                    line-height: 50px;
                    font-family: fantasy;
                    letter-spacing: 4px;

                }

                .order_label2{
                    width: 680px;
                    text-align: left;
                    margin:0 auto;
                    margin-top: 50px;
                    color:darkcyan;
                }

                .video_wrapper{
                    height: 200px;
                    width: 200px;
                    margin:0 auto;
                    padding:0 auto;
                    margin-top: 10px;
                    margin-top: 50px;
                }

    </style>
              

<?php
    include_once '../include/view/header.php';
?>


    <div class="main_wrapper">
        <p class="order_label">ARIGATO! </p>
        <div class="video_wrapper">
            <video autoplay muted loop width="200" height="200"  src='img/arigato2.mp4'></video>
        </div>
        <p class="order_label2">ご入力頂きましたメールアドレスへ「ご注文確認メール」をお送り致しましたのでご確認下さい。<br>１営業日が経ってもメールが来ない場合、恐れ入りますが以下にご連絡下さい。<br><br>メールアドレス:XXX_XX@gmail.com<br>電話番号:03-XXXX-XXXX </p>
    </div>

    <form method="post" action="">
        <div class="button_container">
            <input type="submit" class="reverse-button" name="reverse-button" value="ショッピングページに行く">
            <input type="submit" class="logout-button"  name="logout-button" value="ログアウト">
        </div>
    </form>

    

</body>
</html>

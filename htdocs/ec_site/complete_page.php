
<?php

    require_once '../include/config/config.php';

   

    $login_user_name = $_SESSION["login_user_name"];


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["reverse-button"])){
            header('Location:payment_page.php');
            exit();
        }


        if(isset($_POST["logout_tag"])){  
            //ログアウトが押されたら、セッションのみを消してクッキーは消さず、login.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            header('Location:login.php');
            exit();
        }

        if(isset($_POST["cart_tag"])){
            header('Location:cart_page.php');
            exit();
        }

    }

       //ログアウトであれば、complete_page.phpに来ても、login.phpに遷移するようにする。
    // if (empty($_SESSION['login_user_name'])) {
    //     header('Location:login.php');
    //     exit(); 
    // }
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
                    height: 200px;
                    margin:0 auto;
                    background-color: #000099;
                }

                .order-button{
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
                        margin-top:20px;
                        width:600px;
                        height: 60px;
                    

                }

                .order-button,.reverse-button{
                        margin:0 auto;
                        width:250px;
                        height: 50px;
                        border-radius: 1px;
                        border: 1px solid #000099;
                        font-size:14px;
                        margin-right:10px;
                    
                        
                }

    </style>
              

<?php
    include_once './view/header.php';
?>
    <div class="main_wrapper">
    </div>


    <div class="button_container">
        <input type="submit" class="reverse-button" name="reverse-button" value="ショッピングページに行く">
        <input type="submit" class="order-button"  name="order-button" value="ログアウト">
    </div>
    
</body>
</html>

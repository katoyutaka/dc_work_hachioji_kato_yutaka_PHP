
<?php
       session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');
       define("EXPIRATION_PERIOD", 1);

       $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;
       $login_user_name = $_SESSION["login_user_name"];

       try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
   
        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }

?>

<?php

   if($_SERVER["REQUEST_METHOD"] == "POST"){


        if(isset($_POST["reverse-button"])){
            header('Location:catalog_page.php');
            exit();
        }

        if(isset($_POST["next-button"])){
            // header('Location:YYY.php');
            // exit();
        }


        
        if(isset($_POST["logout_tag"])){  
            //ログアウトが押されたら、セッションのみを消してクッキーは消さないで、login.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            header('Location:login.php');
            exit();
        }



        if(isset($_POST["cart_tag"])){
            header('Location:cart_page.php');
            exit();

        
        }


        if(isset($_POST["favorite_tag"])){
            // header('Location:login.php');
            // exit();

            }

            if(isset($_POST["mypage_tag"])){
            // header('Location:login.php');
            // exit();

            }
    
    }

             

    //ログアウトであれば、address_page.phpに来ても、login.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:login.php');
        exit(); 
    }


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お支払い方法</title>
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
                    vertical-align:bottom;
                    font-family: system-ui;
                    letter-spacing: 2px;

                }

                .label_user{
                    /* text-align: left; */
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;

                    
                }

                .main_wrapper{
                    width: 1000px;
                    height: 3000px;
                    margin:0 auto;
                }
                .text{
                    margin-left:50px;
                    margin-top:20px;
                }

                span{
                    font-size: 18px;
                    font-weight: bolder;

                }

                .header{
                    text-align: center;
                    font-weight:bold;
                    height: 85px;
                    color: #02235F;
                    z-index: 2;
                    position: fixed;
                    width: 100%;
                    background-color: #fff;
                    top: 0px;
                    left: 0px;
                }

                .header_label{
                    text-align: center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #02235F;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    padding-left:50px;
                    color:white;
                    font-family:"Yu Mincho";
                    letter-spacing: 0px;

                }

                .top_tag p{
                    font-size: 28px;
                    font-family:"Yu Mincho";
                    font-weight: bolder;
                    display: block;
                    float: left;
                    margin-top: 25px;
                 
                }

                .top_tag{
                    height: 80px;
                    width: 100%;
                    margin-top: 100px;
                }

                .image_wrapper{
                        height:80px;
                        margin:0 auto;
                }

                .image{
                    width:330px;
                    float:right;
                }

                .input_wrapper{
                    width: 1000px;
                    height: 250px;
                    margin-top: 20px;
                    display: flex;
                }

                .next-button{
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
                        margin-top:80px;
                        width:600px;
                        height: 60px;

                }

                .next-button,.reverse-button{
                        margin:0 auto;
                        width:250px;
                        height: 50px;
                        border-radius: 1px;
                        border: 1px solid #000099;
                        font-size:14px;
                        margin-right:10px;
                        
                }

                .cart_tag{
                    background-image: url("img/cart.jpg");
                    background-size: cover; 
                }                
                
                
                .favorite_tag{
                    background-image: url("img/favorite.jpg");
                    background-size: cover; 
                }                
                
                
                .mypage_tag{
                    background-image: url("img/mypage.jpg");
                    background-size: cover; 
                }

                .logout_tag{
                    background-image: url("img/logout.jpg");
                    background-size: cover; 
                }

                .cart_tag,.favorite_tag,.mypage_tag,.logout_tag{
                    max-width: 20px;
                    width: 20px;
                    margin-top: 8px;
                    margin-right: 13px;
                    margin-left: 13px;
                    border:none;
                }

                .tag_wrapper{
                    float: right;
                    margin-right: 20px;
                    display: flex;

                }

                .login_name{
                    font-size :17px;
                    color: #02235F;
                    float: right;
                    margin-right: 30px;
                    height: 10px;
                    font-family:"Yu Mincho";
                    letter-spacing: 0px;

                }

                .text_product_count{
                    width: 35px;
                   
                }

                
                .input_name_form,.input_hiragana_form,.input_birthday_form,.input_address_form,.input_phone_number_form,.input_mail_address_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                }

                .label{
                    font-weight: bolder;
                    display: inline;
                    /* height: 30px; */
                    width: 50px;
                    background-color: #000099;
                    line-height: 30px;

                }

                .input_form{
                    display: flex;
                }

                .input_form2{
                    height: 80px;
                    background-color: #000099;
                    margin-top: 10px;
                }

                .label_container{
                    text-align: left;
                    width: 200px;
                    height: 50px;
                    background-color: #000099;
                    margin-top: 40px;
                    padding-left:10px ;
                }

                .example_label{
                    color:darkcyan;
                }

                .label_wrapper{
                    background-color:brown;
                    width: 200px;
                    height: 60px;

                }

                .payment_method_button{
                    line-height: 30px;
                    margin:0 auto;
                    margin-bottom: 7px;
                    margin-left: 10px;
                    margin-right: 30px;
                }

                .payment_tag{
                    font-size: 10px;
                    margin-left: 65px;
                   
                }

                .card_wrapper{
                    width: 700px;
                    height: 350px;
                    background-color: yellow;
                    margin-left: 100px;
                }

                .card_image_wrapper{
                    max-width:350px;
                }


                .input_card_number_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                    width: 300px;
                    margin-top: 40px;
                }






    </style>
              
</head>
<body>

<div class="header">
     <p class="header_label">3万円以上のご購入で送料無料キャンペーン実施中！</p>
     
     <div class="login_name"><?php print $login_user_name;?> 様はログイン中です</div><br>
        <div class="tag_wrapper">
            <form method="post" action="">
                    <input type="submit" class="mypage_tag" name="mypage_tag"  >
            </form>

            <form method="post" action="">
                    <input type="submit" class="favorite_tag" name="favorite_tag"  >
            </form>

            <form method="post" action="">
                    <input type="submit" class="cart_tag" name="cart_tag"  >
            </form>

            <form method="post" action="">
                    <input type="submit" class="logout_tag" name="logout_tag"  >
            </form>
        </div>
</div>

<form method="post" action="">
    <div class="main_wrapper">
        <div class="top_tag">
            <p>Method Of Payment</p>

            <div class="image_wrapper">
                <img src='img/shopping3.png' class="image">
            </div>
        </div>
            
        <div class="label_user5"><span>お支払方法入力</span><br><br>以下の項目をご入力いただき、「確認」ボタンをクリックして下さい。</div>

        <div class="label_user">クレジットカード決済</div>

            <div class="input_wrapper">
                <div class="label_wrapper">
                    <form method="post" action="">
                            <input type="radio" name="payment_method_button" class="payment_method_button" value="クレジットカード" <?php if ($payment_method_button === 'クレジットカード') { echo 'checked'; } ?>><p class="label">クレジットカード</p>
                            <p class="payment_tag">CREDIT CARD</p>
                    </form>
                </div>

                <div class="card_wrapper">
                        <img src='img/credit_card_payment.png' class="card_image_wrapper">

                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">カード番号</p>
                                <p class="example_label">半角数字16桁</p>
                            </div>
                            <input type="text" class="input_card_number_form" name="input_card_number_form">
                        </div>

                        <div class="input_form">
                            <div class="label_container">
                                    <p class="label">有効期限</p>
                                    <p class="example_label">(例)2017年3月⇒03/17</p>
                            </div>
                            <input type="text" class="input_card_number_form" name="input_card_number_form">
                        </div>

                        <div class="input_form">
                            <div class="label_container">
                                    <p class="label">セキュリティコード</p>
                                    
                            </div>
                            <input type="text" class="input_card_number_form" name="input_card_number_form">
                           
                        </div>
                        <p class="example_label">セキュリティコードとはクレジットカード裏面の署名欄に印字されている数字のうち<br>下3桁または4桁の番号です。</p>

                </div>
            </div>


            <div class="label_user">コンビニ決済</div>

                <div class="convini_wrapper">

                </div>

    </div>

           
            <!-- </div> -->
                
    <!-- </div> -->

    <div class="button_container">
        <input type="submit" class="reverse-button" name="reverse-button" value="ひとつ前に戻る">
        <input type="submit" class="next-button"  name="next-button" value="確認">
    </div>
</form>

    
</body>
</html>


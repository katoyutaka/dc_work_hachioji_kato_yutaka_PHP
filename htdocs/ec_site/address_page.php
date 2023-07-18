
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

        //バリデーションチェック

        //なぜ漢字の正規表現だけ逆の結果になるのか不明
        if(isset($_POST["input_user_name_form"])){
            if(empty($_POST['input_user_name_form'])){
                $validation_error1[] = "お名前が未入力です";

            } elseif (preg_match( '/[^一-龠]/u',$_POST["input_user_name_form"])) {
                
                $validation_error1[] = "漢字形式で入力されていません";  
                
            } else{
                $input_user_name_form = htmlspecialchars($_POST['input_user_name_form'], ENT_QUOTES, 'UTF-8');
                
               
            }
        }

        if(isset($_POST["input_hiragana_form"])){
            if(empty($_POST['input_hiragana_form'])){
                $validation_error2[] = "ひらがなが未入力です";

            } elseif (preg_match('/^[ぁ-ゞ]+$/u', $_POST['input_hiragana_form'])) {
                $input_hiragana_form = htmlspecialchars($_POST['input_hiragana_form'], ENT_QUOTES, 'UTF-8');
                
            } else{
                $validation_error2[] = "ひらがな形式で入力されていません";     
            }
        }


        if(isset($_POST["input_birthday_form"])){
            if(empty($_POST["input_birthday_form"])){
                $validation_error3[] = "生年月日が未入力です";

            } elseif (preg_match( '/^[0-9]{8}+$/', $_POST["input_birthday_form"] )) {
                $input_birthday_form = htmlspecialchars($_POST['input_birthday_form'], ENT_QUOTES, 'UTF-8');
                
            } else{
                $validation_error3[] = "半角数字８文字の形式で入力されていません";
            }
        }


        if(isset($_POST["input_address_form"])){
            if(empty($_POST["input_address_form"])){
                $validation_error4[] = "住所が未入力ですが未入力です";

            } else {
                $input_address_form = htmlspecialchars($_POST["input_address_form"], ENT_QUOTES, 'UTF-8');
                
            } 
        }


        if(isset($_POST["input_phone_number_form"])){
            if(empty($_POST["input_phone_number_form"])){
                $validation_error5[] = "携帯電話番号が未入力です";

            } elseif (preg_match( "/^0[7-9]0[0-9]{4}[0-9]{4}$/", $_POST["input_phone_number_form"] )) {
                $input_phone_number_form = htmlspecialchars($_POST['input_phone_number_form'], ENT_QUOTES, 'UTF-8');
                
            } else{
                $validation_error5[] = "携帯電話番号の形式ではありません";
            }
        }


        if(isset($_POST["input_mail_address_form"])){
            if(empty($_POST["input_mail_address_form"])){
                $validation_error6[] = "メールアドレスが未入力です";

            } elseif (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $_POST["input_mail_address_form"] )) {
                $input_mail_address_form = htmlspecialchars($_POST['input_mail_address_form'], ENT_QUOTES, 'UTF-8');
                
            } else{
                $validation_error6[] = "メールアドレスの形式ではありません";
            }
        }
        




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
    <title>お届け先住所</title>
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

                .label_user3{
                    font-size: 14px;
                    color:red;
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
                    /* display: flex; */
                    height: 80px;
                    width: 100%;
                    margin-top: 100px;
                }

                .image_wrapper{
                        /* width: 1000px; */
                        height:80px;
                        margin:0 auto;
                    }

                .image{
                    width:330px;
                    float:right;
                }

                .input_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                }


                .msg2{
                    color:red;
                    font-size: 16px;
                    font-weight: bold;
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

                
                .input_user_name_form,.input_hiragana_form,.input_birthday_form,.input_address_form,.input_phone_number_form,.input_mail_address_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                }

                .input_user_name_form,.input_hiragana_form,.input_mail_address_form{
                    width: 400px;
                }

                .input_birthday_form,.input_phone_number_form{
                    width: 400px;
                }

                .input_address_form{
                    width: 800px;
                }


                .label{
                    font-weight: bolder;
                    width: 350px;
                }

                .input_form{
                    /* margin-top: 50px; */
                    display: flex;
                }

                .input_form2{
                    height: 80px;
                    /* background-color: #000099; */
                    margin-top: 10px;
                }

                .label_container{
                    text-align: left;
                    width: 350px;
                    height: 50px;
                    /* background-color: #000099; */
                }

                .example_label{
                    color:darkcyan;
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
            <p>Delivery Address</p>

            <div class="image_wrapper">
                <img src='img/shopping2.png' class="image">
            </div>
        </div>
            
        <div class="label_user5"><span>お届け先情報入力</span><br><br>以下の項目をご入力いただき、「次へ」ボタンをクリックして下さい。</div>
        <div class="label_user">注文者情報</div>

            <div class="input_wrapper">

                    <div class="input_form2">

                    <?php
                        if(!empty($validation_error1)){
                            foreach($validation_error1 as $err1){
                                print "<span class='msg2'>$err1</span>";
                            }
                        }
                    ?>

                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">お名前（漢字）</p>
                                <p class="example_label">(例)山田太郎</p>
                            </div>
                            <input type="text" class="input_user_name_form" name="input_user_name_form">
                        </div>
                    </div>


                    <div class="input_form2">

                    <?php
                        if(!empty($validation_error2)){
                            foreach($validation_error2 as $err2){
                                print "<span class='msg2'>$err2</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">ひらがな</p>
                                <p class="example_label">(例)やまだたろう</p>
                            </div>
                            <input type="text" class="input_hiragana_form" name="input_hiragana_form">
                        </div>
                    </div>


                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error3)){
                            foreach($validation_error3 as $err3){
                                print "<span class='msg2'>$err3</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">生年月日（半角数字８文字）</p>
                                <p class="example_label">(例)20000303</p>
                            </div>
                            <input type="text" class="input_birthday_form" name="input_birthday_form">
                        </div>
                    </div>
                    

                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error4)){
                            foreach($validation_error4 as $err4){
                                print "<span class='msg2'>$err4</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">住所</p>
                            </div>
                            <input type="text" class="input_address_form" name="input_address_form">
                        </div>
                    </div>



                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error5)){
                            foreach($validation_error5 as $err5){
                                print "<span class='msg2'>$err5</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">携帯電話番号（ハイフンなしの半角数字）</p>
                                <p class="example_label">(例)07012345678</p>
                            </div>
                            <input type="text" class="input_phone_number_form" name="input_phone_number_form">
                        </div>
                    </div>



                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error6)){
                            foreach($validation_error6 as $err6){
                                print "<span class='msg2'>$err6</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">メールアドレス</p>
                                <p class="example_label">(例)kyupi13@gmail.com</p>
                            </div>
                            <input type="text" class="input_mail_address_form" name="input_mail_address_form">
                        </div>
                    </div>

            </div>
                
    </div>

    <div class="button_container">
        <input type="submit" class="reverse-button" name="reverse-button" value="ひとつ前に戻る">
        <input type="submit" class="next-button"  name="next-button" value="お支払い入力へ">
    </div>
</form>

    
</body>
</html>


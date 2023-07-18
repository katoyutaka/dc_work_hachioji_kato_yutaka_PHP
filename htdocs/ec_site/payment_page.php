
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

    $conveni = $_POST["select_conveni"];


        //バリデーションチェック

        if(($_POST["payment_method_button"])==="クレジットカード"){
            
                if(isset($_POST["input_card_number_form"])){
                    if(empty($_POST['input_card_number_form'])){
                        $validation_error1[] = "カード番号が未入力です";
        
                    } elseif (preg_match("/^[0-9]{16}+$/",$_POST["input_card_number_form"])) {
                        $input_card_number_form="";
                        $input_card_number_form = htmlspecialchars($_POST['input_card_number_form'], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error1[] = "半角数字16桁の形式で入力されていません";    
                    }
                }



                if(isset($_POST["input_security_number_form"])){
                    if(empty($_POST["input_security_number_form"])){
                        $validation_error2[] = "セキュリティコードが未入力です";

                    } elseif((preg_match("/^[0-9]{3}+$/",$_POST["input_security_number_form"])) ||(preg_match("/^[0-9]{4}+$/",$_POST["input_security_number_form"]))){
                        $input_security_number_form="";
                        $input_security_number_form= htmlspecialchars($_POST["input_security_number_form"], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error2[] = "半角数字3桁または4桁の形式で入力されていません";       
                    }
                }


                if(isset($_POST["expiration_date_month"])){
                    if(empty($_POST["expiration_date_month"])){
                        $validation_error3[] = "有効期限の「月」が未入力です";

                    } else{
                        $expiration_date_month="";
                        $expiration_date_month= htmlspecialchars($_POST["expiration_date_month"], ENT_QUOTES, 'UTF-8');       
                    }
                }


        
                if(isset($_POST["expiration_date_year"])){
                    if(empty($_POST["expiration_date_year"])){
                        $validation_error4[] = "有効期限の「年」が未入力です";

                    } else{
                        $expiration_date_year="";
                        $expiration_date_year= htmlspecialchars($_POST["expiration_date_year"], ENT_QUOTES, 'UTF-8');       
                    }
                }
        }




        if(($_POST["payment_method_button"])==="コンビニ"){
            if(empty($_POST["select_conveni"])){
                $validation_error7[] = "支払い先のコンビニ名が未選択です";

            } else{
                $expiration_date_year="";
                $select_conveni= htmlspecialchars($_POST["select_conveni"], ENT_QUOTES, 'UTF-8');       
            }

        }


        if(($_POST["payment_method_button"])==="スマートフォン"){
            if((empty($_POST["smartphone_payment_method_button"]))){
                $validation_error8[] = "支払い先のスマートフォンが未選択です";

            } else{
                $smartphone_payment_method_buttonr="";
                $smartphone_payment_method_button= htmlspecialchars($_POST["smartphone_payment_method_button"], ENT_QUOTES, 'UTF-8');       
            }

        }



 
        if(($_POST["payment_method_button"])===NULL){
            $validation_error5[] = "お支払方法が選択されていません";

        } else{
            $payment_method_button="";
            $payment_method_button= htmlspecialchars($_POST["payment_method_button"], ENT_QUOTES, 'UTF-8');       
        }
    

        if(isset($_POST["reverse-button"])){
            header('Location:address_page.php');
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

             

    //ログアウトであれば、payment_page.phpに来ても、login.phpに遷移するようにする。
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
                    /* background-color: #eff6fc; */
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;

                    
                }

                .main_wrapper{
                    width: 1000px;
                    height: 1400px;
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

                .card_input_wrapper{
                    width: 1000px;
                    height: 450px;
                    /* margin-top: 20px; */
                    display: flex;
                    /* background-color:darkseagreen; */
                    border-bottom:1px solid gray;
                    padding-bottom: 40px;
                }

                .conveni_input_wrapper{
                    width: 1000px;
                    height: 250px;
                    /* margin-top: 20px; */
                    /* display: flex; */
                    border-bottom:1px solid gray;
                    /* padding-top: 20px; */
                    /* padding-bottom: 20px; */
                    /* background-color: yellowgreen; */
                }

                .smartphone_input_wrapper{
                    width: 1000px;
                    height: 150px;
                    /* margin-top: 20px; */
                    /* display: flex; */
                    border-bottom:1px solid gray;
                    /* padding-top: 20px; */
                     /* background-color: yellowgreen; */
                }

                .cash_input_wrapper{
                    width: 1000px;
                    height: 150px;
                    margin-top: 20px;
                    display: flex;
                    border-bottom:1px solid gray;
                    padding-top: 20px;
                     /* background-color: yellowgreen; */
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
                        /* margin-top:20px; */
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

                .card_label{
                    font-weight: bolder;
                    display: inline;
                    /* height: 30px; */
                    width: 50px;
                    /* background-color: #000099; */
                    line-height: 30px;
                    padding-left: 30px;
                }
                

                .conveni_label{
                    font-weight: bolder;
                    display: inline;
                    /* height: 30px; */
                    width: 50px;
                    /* background-color: #000099; */
                    line-height: 30px;
                    padding-left: 55px;
                }

                .smartphone_label{
                    font-weight: bolder;
                    display: inline;
                    /* height: 30px; */
                    width: 50px;
                    /* background-color: #000099; */
                    line-height: 30px;
                    padding-left: 40px;
                }

                .cash_label{
                    font-weight: bolder;
                    display: inline;
                    /* height: 30px; */
                    width: 50px;
                    /* background-color: #000099; */
                    line-height: 30px;
                    padding-left: 60px;
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
                    width: 250px;
                    height: 50px;
                    /* background-color: #000099; */
                    margin-top: 10px;
                    padding-left:10px ;
                }

                .conveni_label_container{
                    text-align: left;
                    width: 250px;
                    height: 10px;
                    /* background-color: #000099; */
                    margin-top: 45px;
                    padding-left:10px ;
                }

                .example_label{
                    color:darkcyan;
                }

                .card_example_label{
                    color:darkcyan;
                    margin-left: 10px;
                }

                .card_label_wrapper{
                    /* background-color:brown; */
                    width: 200px;
                    height: 60px;
                }

                .conveni_label_wrapper{
                    /* background-color:brown; */
                    width: 200px;
                    height: 60px;
                }

                

                .smartphone_label_wrapper{
                    /* background-color:brown; */
                    width: 350px;
                    height: 60px;
                }

                
                .cash_label_wrapper{
                    /* background-color:brown; */
                    width: 400px;
                    height: 60px;
                }

                .payment_method_button{
                    line-height: 30px;
                    margin:0 auto;
                    margin-bottom: 7px;
                    margin-left: 10px;
                    margin-right: 30px;
                }

                .r-edy_payment_method_button{
                    /* line-height: 54px; */
                    margin:0 auto;
                    margin-bottom: 20px;
                    margin-left: 10px;
                    margin-right: 30px;
                }

                .paypay_payment_method_button{
                    /* line-height: 54px; */
                    margin:0 auto;
                    margin-bottom: 20px;
                    margin-left: 100px;
                    margin-right: 20px;
                }

                .card_payment_tag{
                    font-size: 10px;
                    margin-left: 65px;
                }

                .conveni_payment_tag{
                    font-size: 10px;
                    margin-left: 40px;
                }

                .smartphone_payment_tag{
                    font-size: 10px;
                    margin-left: 65px;
                    margin-right: 10px;
                }
                
                
                .cash_payment_tag{
                    font-size: 10px;
                    margin-left: 45px;
                }


                .card_wrapper{
                    width: 700px;
                    height: 350px;
                    /* background-color: yellow; */
                    margin-left: 100px;
                }

                
                .conveni_wrapper{
                    width: 700px;
                    height: 150px;
                    /* background-color: yellow; */
                    margin-left: 100px;
                }

                .smartphone_wrapper{
                    width: 700px;
                    height: 80px;
                    /* background-color: yellow; */
                    /* margin-left: 100px; */
                }

                .cash_wrapper{
                    width: 700px;
                    height: 80px;
                    /* background-color: yellow; */
                    margin-left: 100px;
                }


                .card_image_wrapper{
                    max-width:350px;
                    margin-bottom: 20px;
                }

                .conveni_image_wrapper{
                    max-width:500px;
                }

                .r-edy_image_wrapper{
                    max-width:35px;
                }

                .paypay_image_wrapper{
                    margin: 0 auto;
                    max-width:100px;
                   margin-bottom:10px
                }


                .input_card_number_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                    width: 300px;
                    margin-top: 10px;
                }

                .input_security_number_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                    width: 300px;
                    margin-top: 10px;
                }

                .select_conveni{
                    background-color: #f8f8f8;
                    width: 150px;
                    height: 30px;
                    margin-top: 38px;
                    border:1px solid #66FFCC;
                }

                .expiration_date_month{
                    background-color: #f8f8f8;
                    width: 60px;
                    height: 30px;
                    margin-top: 10px;
                    border:1px solid #66FFCC;
                }

                .expiration_date_year{
                    background-color: #f8f8f8;
                    width: 100px;
                    height: 30px;
                    margin-top: 10px;
                    border:1px solid #66FFCC;
                }

                .slash{
                    margin: 0 auto;
                    width: 30px;
                    height: 30px;
                    margin-right: 5px;
                    margin-left: 5px;
                    margin-top: 15px;
                    padding-left: 10px;
                }

                .msg2{
                    color:red;
                    font-size: 16px;
                    font-weight: bold;
                    height: 20px;
                    width: 200px;
                    padding-left: 10px;
                }

                .card_sub_wrapper{
                    /* background-color: skyblue; */
                    width: 700px;
                    height: 90px;
                    /* margin-top: 30px; */
                }

                .payment_sub_wrapper{
                    /* background-color: skyblue; */
                    width: 1000px;
                    height: 50px;
                    /* margin-top: 30px; */
                    padding-top:20px;
                }

                .msg3{
                    color:red;
                    font-size: 16px;
                    font-weight: bold;
                    height: 20px;
                    width: 200px;
                    /* padding-left: 10px; */
                }

                .smartphone_error_wrapper,.conveni_error_wrapper{
                    height: 20px;
                    width: 1000px;
                    /* background-color: #000099; */
                    padding-left: 50px;
                }

                .smartphone_input_container,.conveni_input_container{
                    display: flex;
                    margin-top: 20px;
                    
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


        <div class="payment_sub_wrapper">
            <?php
                if(!empty($validation_error5)){
                    foreach($validation_error5 as $err5){
                        print "<span class='msg3'>$err5</span>";
                    }
                }
            ?>
        </div>

        <div class="card_input_wrapper">

            <div class="card_label_wrapper">
                <!-- <form method="post" action=""> -->
                        <input type="radio" name="payment_method_button" class="card_payment_method_button" value="クレジットカード" <?php if ($payment_method_button === 'クレジットカード') { echo 'checked'; } ?>><p class="card_label">クレジットカード</p>
                        <p class="card_payment_tag">CREDIT CARD</p>
                <!-- </form> -->
            </div>

            <div class="card_wrapper">
                    <img src='img/credit_card_payment.png' class="card_image_wrapper">

                    <div class="card_sub_wrapper">
                        <?php
                                if(!empty($validation_error1)){
                                    foreach($validation_error1 as $err1){
                                        print "<span class='msg2'>$err1</span>";
                                    }
                                }
                        ?>

                        <div class="input_form">
                            <div class="label_container">

                                <p class="label">カード番号</p>
                                <p class="example_label">半角数字16桁</p>
                            </div>
                            <input type="text" class="input_card_number_form" name="input_card_number_form">
                        </div>
                    </div>


                    <div class="card_sub_wrapper">
                        <?php
                            if(!empty($validation_error4)){
                                foreach($validation_error4 as $err4){
                                    print "<span class='msg2'>$err4</span>";
                                }
                            }
                        ?>

                        <?php
                            if(!empty($validation_error3)){
                                foreach($validation_error3 as $err3){
                                    print "<span class='msg2'>$err3</span>";
                                }
                            }
                        ?>

                        <div class="input_form">
                            <div class="label_container">
                                    <p class="label">有効期限</p>
                                    <p class="example_label">(例)2017年3月⇒03/17</p>
                            </div>
                                <select name='expiration_date_month' class='expiration_date_month'>
                                    <?php
                                        for($month = 1; $month <= 12;$month++){
                                            $new_month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    ?>
                                            <option value='<?php print $new_month?>'><?php print $new_month?></option>
                                    <?php
                                        }
                                    ?> 
                                </select>

                                <div class="slash">／</div>

                                <select name='expiration_date_year' class='expiration_date_year'>
                                    <?php
                                        for($year = 2023; $year <=2033 ;$year++){
                                    ?>
                                            <option value='<?php print $year?>'><?php print $year?></option>
                                    <?php
                                        }
                                    ?> 
                                </select>
                        </div>
                    </div>


                    <div class="card_sub_wrapper">

                        <?php
                            if(!empty($validation_error2)){
                                foreach($validation_error2 as $err2){
                                    print "<span class='msg2'>$err2</span>";
                                }
                            }
                        ?>

                        <div class="input_form">
                            <div class="label_container">
                                    <p class="label">セキュリティコード</p>
                                    
                            </div>
                            <input type="text" class="input_security_number_form" name="input_security_number_form">
                            
                        </div>

                        <p class="card_example_label">※セキュリティコードとはクレジットカード裏面の署名欄に印字されている数字のうち<br>下3桁または4桁の番号です。</p>

                    </div>
            </div>


        </div>

        <!-- <div class="label_user">コンビニ決済</div> -->

            <div class="conveni_input_wrapper">

                <div class="conveni_error_wrapper">
                        <?php
                            if(!empty($validation_error7)){
                                foreach($validation_error7 as $err7){
                                    print "<span class='msg2'>$err7</span>";
                                }
                            }
                        ?>
                </div>

                <div class="conveni_input_container">
                    <div class="conveni_label_wrapper">
                            <!-- <form method="post" action=""> -->
                                    <input type="radio" name="payment_method_button" class="conveni_payment_method_button" value="コンビニ" <?php if ($payment_method_button === 'コンビニ') { echo 'checked'; } ?>><p class="conveni_label">コンビニ</p>
                                    <p class="conveni_payment_tag">CONVENIENCE STORE</p>
                            <!-- </form> -->
                    </div>

                    <div class="conveni_wrapper">
                            <img src='img/conveni.png' class="conveni_image_wrapper">

                            <div class="input_form">
                                <div class="conveni_label_container">
                                    <p class="label">ご利用になるコンビニ</p>
                                </div>
                                <select name='select_conveni' class='select_conveni'>
                                <option value='セブンイレブン'>セブンイレブン</option>
                                <option value='ファミリーマート'>ファミリーマート</option>
                                <option value='ローソン'>ローソン</option>
                                <option value='ミニストップ'>ミニストップ</option>
                                <option value='セイコーマート'>セイコーマート</option>
                                </select>
                            </div>
                    </div>

                </div>

            </div>

        <!-- <div class="label_user">スマホ決済</div> -->

        <div class="smartphone_input_wrapper">

        <div class="smartphone_error_wrapper">
                <?php
                    if(!empty($validation_error8)){
                        foreach($validation_error8 as $err8){
                            print "<span class='msg2'>$err8</span>";
                        }
                    }
                ?>
        </div>


        <div class="smartphone_input_container">
            <div class="smartphone_label_wrapper">
                    <!-- <form method="post" action=""> -->
                            <input type="radio" name="payment_method_button" class="smartphone_payment_method_button" value="スマートフォン" <?php if ($payment_method_button === 'スマートフォン') { echo 'checked'; } ?>><p class="smartphone_label">スマートフォン</p>
                            <p class="smartphone_payment_tag">SMARTPHONE</p>
                    <!-- </form> -->
            </div>

            <div class="smartphone_wrapper">

                <div class="smartphone_label_wrapper">
                    <!-- <form method="post" action=""> -->
                            <input type="radio" name="smartphone_payment_method_button" class="r-edy_payment_method_button" value="楽天edy" <?php if ($payment_method_button === '楽天edy') { echo 'checked'; } ?>>
                            <img src='img/r-edy.png' class="r-edy_image_wrapper">

                            <input type="radio" name="smartphone_payment_method_button" class="paypay_payment_method_button" value="paypay" <?php if ($payment_method_button === 'paypay') { echo 'checked'; } ?>>
                            <img src='img/paypay.jpg' class="paypay_image_wrapper">
                    <!-- </form> -->
                </div>
            </div>

        </div>


        </div>


        <div class="cash_input_wrapper">
            <div class="cash_label_wrapper">
                <!-- <form method="post" action=""> -->
                        <input type="radio" name="payment_method_button" class="cash_payment_method_button" value="代引き" <?php if ($payment_method_button === '代引き') { echo 'checked'; } ?>><p class="cash_label">代引き</p>
                        <p class="cash_payment_tag">CASH ON DELIVERY</p>
                <!-- </form> -->
            </div>
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


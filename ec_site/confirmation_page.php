
<?php
       session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');
       define("EXPIRATION_PERIOD", 1);

       $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;

       try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
   
        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }

?>

<?php

    //注文の商品

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
        header('Location:payment_page.php');
        exit();
    }

    
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文内容のご確認</title>
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

                .label_user{
                    font-size:18px;
                    font-weight:bold;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;
                    border-bottom:1px solid #b7b7b7; 
                }

                .address_label{
                    font-size:18px;
                    font-weight:bold;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;
                    border-bottom:1px solid #b7b7b7;
                    /* background-color: #b7b7b7;  */
                }

                .payment_label{
                    font-size:18px;
                    font-weight:bold;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    /* margin-top: 30px; */
                    border-bottom:1px solid #b7b7b7; 
                }

                .product_label{
                    font-size:18px;
                    font-weight:bold;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 50px;
                    border-bottom:1px solid #b7b7b7; 
                }

                
                .send_label{
                    font-size:18px;
                    font-weight:bold;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;
                    border-bottom:1px solid #b7b7b7; 
                }

                .main_wrapper{
                    width: 1000px;
                    /* height: 1500px; */
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
                    margin-top: 20px;
                    display: flex;
                    border-bottom:1px solid gray;
                    padding-top: 20px;
                    /* padding-bottom: 20px; */
                    /* background-color: yellowgreen; */
                }

                .smartphone_input_wrapper{
                    width: 1000px;
                    height: 150px;
                    margin-top: 20px;
                    display: flex;
                    border-bottom:1px solid gray;
                    padding-top: 20px;
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

                /* .order-button{
                    float: right;
                }

                .reverse-button{
                    float: left;
                } */


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

            
                /* .conveni_label{
                    font-weight: bolder;
                    display: inline;
                    width: 50px;
                    line-height: 30px;
                    padding-left: 55px;
                }

                .smartphone_label{
                    font-weight: bolder;
                    display: inline;
                    width: 50px;
                    line-height: 30px;
                    padding-left: 40px;
                }

                .cash_label{
                    font-weight: bolder;
                    display: inline;
                    width: 50px;
                    line-height: 30px;
                    padding-left: 60px;
                }



                /* .input_form2{
                    height: 80px;
                    background-color: #000099;
                    margin-top: 10px;
                } */

                .label_container{
                    text-align: left;
                    width: 250px;
                    height: 50px;
                    margin-top: 10px;
                    padding-left:10px ;
                }

                /* .conveni_label_container{
                    text-align: left;
                    width: 250px;
                    height: 10px;
                    margin-top: 45px;
                    padding-left:10px ;
                }

                .example_label{
                    color:darkcyan;
                } */

                /* .card_example_label{
                    color:darkcyan;
                    margin-left: 10px;
                }

                .card_label_wrapper{
                    width: 200px;
                    height: 60px;
                }

                .conveni_label_wrapper{
                    width: 200px;
                    height: 60px;
                }

                

                .smartphone_label_wrapper{
                    width: 350px;
                    height: 60px;
                } */

                
                /* .cash_label_wrapper{
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
                    margin:0 auto;
                    margin-bottom: 20px;
                    margin-left: 10px;
                    margin-right: 30px;
                } */

                /* .paypay_payment_method_button{
                    margin:0 auto;
                    margin-bottom: 20px;
                    margin-left: 100px;
                    margin-right: 20px;
                } */
/* 
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
                } */


                /* .card_wrapper{
                    width: 700px;
                    height: 350px;
                    margin-left: 100px;
                } */

                
                /* .conveni_wrapper{
                    width: 700px;
                    height: 150px;
                    margin-left: 100px;
                } */

                /* .smartphone_wrapper{
                    width: 700px;
                    height: 80px;
                }

                .cash_wrapper{
                    width: 700px;
                    height: 80px;
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
                } */


                /* .input_card_number_form{
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
                } */

                /* .card_sub_wrapper{
                    width: 700px;
                    height: 90px;
                }

                .payment_sub_wrapper{
                    width: 1000px;
                    height: 50px;
                    padding-top:20px;
                }

                .msg3{
                    color:red;
                    font-size: 16px;
                    font-weight: bold;
                    height: 20px;
                    width: 200px;
                } */


                .input_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    height: 400px;
                    background-color: #b7b7b7;
                }

                .address_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    height: 330px;
                    /* background-color: #b7b7b7; */
                }

                .payment_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    /* height: 70px;
                    background-color: #b7b7b7; */
                }

                
                .product_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    /* height: 650px; */
                    /* background-color: pink; */
                }

                .send_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    height: 50px;
                    /* background-color: yellowgreen; */
                    padding-left:30px;
                }

                .name_form{
                    display: flex;
                    width: 1000px;
                    height: 50px;
                    /* background-color: darkred; */
                }

                
                .label{
                    font-weight: bolder;
                    display: inline;
                    width:300px;
                    height: 35px;
                    line-height: 20px;
                    padding-left: 30px;
                    /* background-color: yellow; */
                }
                
                
                .input_name_form,.input_hiragana_form,.input_birthday_form,.input_phone_number_form,.input_mail_address_form{
                    /* background-color: #f8f8f8; */
                    width:300px;
                    height: 35px;
                    text-align: left;
                }

                .input_address_form{
                    /* background-color: #f8f8f8; */
                    width:600px;
                    height: 35px;
                    text-align: left;
                }

                .input_mail_address_form{
                    /* background-color: #f8f8f8; */
                    width:600px;
                    height: 35px;
                    text-align: left;
                }

                .input_payment_form{
                    /* background-color: #f8f8f8; */
                    width:600px;
                    height: 35px;
                    text-align: left;
                    margin-left:30px
                }

                .image{
                    width:300px;
                    float:right;
                }

                .catalog_wrapper{
                    width: 1000px;
                    /* text-align: center; */
                    /* height: 200px; */
                    margin-top: 20px;
                    padding-left: 70px;
                   
                }

                .img-wrapper{
                    height:170px;
                }

                table,
                th,
                td {
                    text-align: center;
                    /* border-bottom: 1px solid #CECECE; */
                    font-weight: bold;
                    font-size: 14px;
                   
                }


                
                .td_product_name{
                    width: 500px;
                    margin: auto;
                    margin-top: 20px;
                }

                .td_price{
                    width: 240px;
                    top: 0;
                    bottom: 0;
                    margin: auto;

                }

                .td_product_count{
                    width: 50px;
                    /* display: flex; */
                    height: 60px;
                    margin: 0 auto;
                    /* line-height: 30px; */

                }

                /* .td_delete{
                    width: 100px;

                } */

                
                .product_image_container{
                    width:60px;
                    height:60px;
                }

                
                .delete_button,.product_count_button{
                    color: white;
                    background-color: #1c1c1c;
                    width: 70px;
                    height: 25px;
                    /* margin-left: 20px; */
                    font-family: system-ui;
                    letter-spacing: 2px;
                    /* margin-top: 10px; */
                    font-size: 12px;
                }
                .sub_wrapper{
                    margin: 0 auto;
                    width: 1000px;
                    border-top: 1px solid black;
                    margin-top: 50px;
                    height: 200px;
                    /* display: column; */
                }

                .total4,.total5{
                    float: right;
                   
                }
                
                .total1, .total2,.total3{
                    margin-top: 10px;
                    width: 250px;
                    height: 30px;
                }

                .total_label1{
                    float: left;
                }

                .total_label2{
                    float: right;
                }

                .total4{
                    margin-top: 20px;
                    width: 1000px;
                    height: 30px;
                    font-size: 18px;
                    font-weight: bold;
                    background-color: #CECECE;
                }
                .update_area{
                    width: 1000px;
                    height: 200px;
                    background-color: #fff;
                    /* padding-bottom: 50px; */
                    
                    /* margin-left: 50px; */
                    
                }

                
                .text_product_count{
                    width: 35px;
                    /* margin-top: 30px;
                    */


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
            <p>Order Confirmation</p>

            <div class="image_wrapper">
                <img src='img/shopping4.png' class="image">
            </div>
        </div>
            
        <div class="label_user5"><span>注文内容のご確認</span><br><br>以下の項目を確認していただき、「注文を確定する」ボタンをクリックして下さい。</div>
        
        <div class="address_label">お届け先</div>

        <div class="address_wrapper">

            <div class="name_form">
                <p class="label">ふりがな（ひらがな）</p>
                <p class="input_hiragana_form" name="input_user_name"><?php print $input_hiragana_form;?></p>
            </div>

            <div class="name_form">
                <p class="label">お名前（漢字）</p>
                <p class="input_name_form" name="input_user_name"><?php print $input_user_name_form;?></p>
            </div>

            <div class="name_form">
                <p class="label">生年月日</p>
                <p class="input_birthday_form" name="input_user_name"><?php print $input_birthday_form;?></p>
            </div>

            <div class="name_form">
                <p class="label">住所</p>
                <p class="input_address_form" name="input_user_name"><?php print  $input_address_form;?></p>
            </div>

            <div class="name_form">
                <p class="label">携帯電話番号</p>
                <p class="input_phone_number_form" name="input_user_name"><?php print $input_phone_number_form;?></p>
            </div>

            <div class="name_form">
                <p class="label">メールアドレス</p>
                <p class="input_mail_address_form" name="input_user_name"><?php print $input_mail_address_form;?></p>
            </div>
         
        </div>

        <div class="payment_label">お支払方法</div>

        <div class="payment_wrapper">
            <div class="name_form">
                <p class="input_payment_form" name="input_user_name"><?php print $payment_method_button;?>/<?php print $select_conveni;?></p>
               
            </div>
        </div>


        
        <div class="send_label">発送予定日</div>
            
        <div class="send_wrapper">
            <?php
            $date = date('Ymd')+ 2;
             print  date('Y/m/d', strtotime($date)); 
            ?>
        </div>



        <div class="product_label">ご注文の商品</div>

        <div class="product_wrapper">

                <?php
                $sql ="SELECT * FROM ec_cart_table JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id; ";
                if($result = $db->query($sql)){

                    $total_sum = 0;
                    while($row =$result->fetch()){
                        $get_img_url = $row["image_path"];

                        $total = $row["price"]*$row["product_count"];

                        $total_sum = $total_sum + $total;
                    

                        // ３万円以上で送料無料で、未満で送料８００円
                        if($total_sum >= 30000){
                            $delivery_charge=0;
                        }else{
                            $delivery_charge=800;
                        }

                        $grand_total = $total_sum + $delivery_charge;

                ?>
                        <div class="catalog_wrapper">
                            <table>
                                        <td><img class="product_image_container" src= "<?php print $get_img_url; ?>"></td>
                                        <td class="td_product_name"><?php print $row["product_name"];?></td>

                                        <!-- number_format関数で数値にカンマを付けられる。 -->
                                        <td class="td_price"><?php print number_format($row["price"])."(税込)";?></td>

                                        <td class="td_product_count">
                                            <form method="post" action="">
                                                    <input type ="hidden" name="product_count_id_value" value ="<?php print $row["product_id"]?>">
                                                    <div name="text_product_count" class="text_product_count"><?php print $row["product_count"];?></div>
                                            </form>
                                        </td>

                            </table>
                        </div>
                    
            <?php
                    }
                }
            ?>
                        
        

                <div class="sub_wrapper">
                    <div class="total5">
                        <div class="total1">                        
                            <p class="total_label1">小計</p>
                            <p class="total_label2">￥<?php print number_format($total_sum);?>円(税込)</p>
                        </div>

                        <div class="total2">                        
                            <p class="total_label1">配送料金</p>
                            <p class="total_label2">￥<?php print number_format($delivery_charge);?>円(税込)</p>
                        </div>

                        <div class="total3">                        
                            <p class="total_label1">合計</p>
                            <p class="total_label2">￥<?php print number_format($grand_total);?>円(税込)</p>
                        </div>

                    </div>

                    <div class="total4">                        
                            <p class="total_label1">総合計</p>
                            <p class="total_label2">￥<?php print number_format($grand_total);?>円(税込)</p>
                    </div>
                </div>

        </div>

    </div>


    <div class="button_container">
        <input type="submit" class="reverse-button" name="reverse-button" value="ひとつ前に戻る">
        <input type="submit" class="order-button"  name="order-button" value="注文を確定する">
    </div>
    
</form>

</body>
</html>

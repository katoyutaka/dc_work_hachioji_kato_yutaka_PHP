
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
        header('Location:payment_page.php');
        exit();
    }

    //注文確定ボタンで、「在庫数のデータベース変更」と「カートのデータベース変更」をする。

    //SELECT * FROM ec_stock_table WHERE product_id ="41";
    if(isset($_POST["order-button"])){

        $sql ="SELECT * FROM ec_cart_table JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id; ";
        if($result = $db->query($sql)){

            while($row =$result->fetch()){

                $sql1 ="SELECT * FROM ec_stock_table WHERE product_id =".$row["product_id"].";";
                if($result1 = $db->query($sql1)){
                    while($row1 =$result1->fetch()){

                        $new_stock_count =$row1["stock_count"]-$row["product_count"];
                        
                        $update = "UPDATE ec_stock_table SET stock_count =".$new_stock_count." WHERE product_id =".$row["product_id"].";";
                        $result2 = $db->query($update);

                        $update_date = date('Ymd');
                        
                        $update = "UPDATE ec_stock_table SET update_date = '$update_date' WHERE product_id = ".$row["product_id"].";";
                        $result = $db->query($update);
                    }
                }

            }
        }
                


        // header('Location:complete_page.php');
        // exit();
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

    if(isset($_POST["favorite_tag"])){
       // header('Location:login.php');
       // exit();

    }

    if(isset($_POST["mypage_tag"])){
       // header('Location:login.php');
       // exit();

    }

    
   }


       //ログアウトであれば、confirmation_page.phpに来ても、login.phpに遷移するようにする。
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
                    display: flex;
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
                }

                .smartphone_input_wrapper{
                    width: 1000px;
                    height: 150px;
                    margin-top: 20px;
                    display: flex;
                    border-bottom:1px solid gray;
                    padding-top: 20px;
                }

                .cash_input_wrapper{
                    width: 1000px;
                    height: 150px;
                    margin-top: 20px;
                    display: flex;
                    border-bottom:1px solid gray;
                    padding-top: 20px;
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

                .label_container{
                    text-align: left;
                    width: 250px;
                    height: 50px;
                    margin-top: 10px;
                    padding-left:10px ;
                }


                .product_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                }

                .send_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                    height: 50px;
                    padding-left:30px;
                }

                .name_form{
                    display: flex;
                    width: 1000px;
                    height: 50px;
                }

                
                .label{
                    font-weight: bolder;
                    display: inline;
                    width:300px;
                    height: 35px;
                    line-height: 20px;
                    padding-left: 30px;
                }
                
                
                .input_name_form,.input_hiragana_form,.input_birthday_form,.input_phone_number_form,.input_mail_address_form{
                    width:300px;
                    height: 35px;
                    text-align: left;
                }

                .input_address_form{
                    width:600px;
                    height: 35px;
                    text-align: left;
                }

                .input_mail_address_form{
                    width:600px;
                    height: 35px;
                    text-align: left;
                }

                .input_payment_form{
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
                    height: 60px;
                    margin: 0 auto;
                }
                
                .product_image_container{
                    width:60px;
                    height:60px;
                }

                
                .delete_button,.product_count_button{
                    color: white;
                    background-color: #1c1c1c;
                    width: 70px;
                    height: 25px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                    font-size: 12px;
                }
                .sub_wrapper{
                    margin: 0 auto;
                    width: 1000px;
                    border-top: 1px solid black;
                    margin-top: 50px;
                    height: 200px;
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
                }

                
                .text_product_count{
                    width: 35px;
                }


    </style>
              
</head>

<body>

<div class="header">
     <p class="header_label">自然の輝きを表現した新作「BULK HOMME」発売中</p>
     
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
                <div class="input_payment_form" name="input_user_name"><?php print $payment_method_button;?> 
                <?php 
                    if(!empty($select_conveni || $smartphone_payment_method_button)){
                        print "/";
                    } 
                ?>
                <?php 
                    if(!empty($select_conveni)){
                        print $select_conveni;
                    
                    }else{
                        print $smartphone_payment_method_button;

                    }
                
                ?>
                </div>

               
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
                                            <input type ="hidden" name="product_count_id_value" value ="<?php print $row["product_id"]?>">
                                            <input type ="hidden" name="text_product_count" value ="<?php print $row["product_count"]?>">
                                            <div class="text_product_count"><?php print $row["product_count"];?></div>
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

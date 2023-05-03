
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

            if(isset($_POST["delete_button"])){

                $delete_number = htmlspecialchars($_POST["delete_id_value"], ENT_QUOTES, 'UTF-8');
                $delete_cart_id_number = htmlspecialchars($_POST["delete_cart_id_value"], ENT_QUOTES, 'UTF-8');

                //何の商品を削除したのか知るために以下の商品名を取ってくるコードも記載。
                $select = "SELECT product_name FROM  ec_product_table WHERE product_id = '$delete_number';";
                if($result2 = $db->query($select)){
                    $row2 =$result2->fetch();
                }

                $delete = "DELETE FROM ec_cart_table WHERE cart_id = '$delete_cart_id_number';";
                $result = $db->query($delete);
                
                $update_message[]= "『".$row2["product_name"]."』を削除しました"."<br>";

            }

            if(isset($_POST["reverse-button"])){
                header('Location:catalog_page.php');
                exit();
            }

            if(isset($_POST["next-button"])){
                header('Location:YYY.php');
                exit();
            }


            
            if(isset($_POST["logout_tag"])){  
                //ログアウトが押されたら、セッションとクッキーを空にして、login.phpに遷移する。
                $_SESSION=[];
                session_destroy();

                setcookie("user_check","",time()-100);
                setcookie("login_user_name","",time()-100);  
                setcookie("sign_up_password_1","",time()-100);  

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

             if(isset($_POST["product_count_button"])){
                
                $product_count_id_number = htmlspecialchars($_POST["product_count_id_value"], ENT_QUOTES, 'UTF-8');
                $text_product_count_number = htmlspecialchars($_POST["text_product_count"], ENT_QUOTES, 'UTF-8');

                $update_date = date('Ymd');

            
                //何の商品を削除したのか知るために以下の商品名を取ってくるコードも記載。
                $select = "SELECT product_name FROM  ec_product_table WHERE product_id = '$product_count_id_number';";
                if($result5 = $db->query($select)){
                    $row5 =$result5->fetch();
                }


                $update = "UPDATE ec_cart_table SET product_count = '$text_product_count_number' WHERE ec_cart_table.product_id = '$product_count_id_number';";
                $result = $db->query($update);

                $update = "UPDATE ec_cart_table SET update_date = '$update_date' WHERE ec_cart_table.product_id = '$product_count_id_number';";
                $result = $db->query($update);

                $update_message[]= "『".$row5["product_name"]."』の個数を変更しました"."<br>";

            }

            
    
    }

             
    

    //ログアウトであれば、catalog_page.phpに来ても、login.phpに遷移するようにする。
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
                    vertical-align:baseline;
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
                    height: 100px;
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

                .img-wrapper{
                    height:170px;
                }

                table,
                th,
                td {
                    text-align: center;
                    border-bottom: 1px solid #CECECE;
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
                    width: 150px;
                    display: flex;
                    height: 30px;
                    margin: 0 auto;

                }

                .td_delete{
                    width: 100px;

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

                .msg2{
                    color:blue;
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

                /* .btn_wrapper{
                    height: 200px;
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
                    /* height: 30px; */
                    /* background-color: green; */
                    /* width:100% ; */
                    /* float: right; */

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

                
                .input_name_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    width: 380px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                }

                .name_label{
                    font-weight: bolder;
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
<div class="main_wrapper">
    <div class="top_tag">
        <p>Delivery Address</p>

        <div class="image_wrapper">
            <img src='img/shopping2.png' class="image">
        </div>
        
        <div class="update_area">
                        <?php
                            if (!empty($update_message) ){
                                foreach($update_message as $err2){
                                    print "<span class='msg2'>$err2</span>";
                                    
                                }
                            }
                        ?>
        </div>
    </div>

    <div class="label_user5"><span>お届け先情報入力</span><br><br>以下の項目をご入力いただき、「次へ」ボタンをクリックして下さい。</div>
    <div class="label_user">注文者情報</div>

        <div class="input_wrapper">
            <div class="name_form">
                <p class="name_label">お名前</p>
                <input type="text" class="input_name_form" name="user_name">
            </div>

            <div class="name_form">
                <p class="name_label">ひらがな</p>
                <input type="text" class="input_hiragana_form" name="input_hiragana_form">
            </div>

            <div class="name_form">
                <p class="name_label">生年月日(例：1990年3月3日の時は19900303)</p>
                <input type="text" class="input_birthday_form" name="input_birthday_form">
            </div>
        </div>
               
        <div class="sub_wrapper">
        </div>
</div>

    
</body>
</html>


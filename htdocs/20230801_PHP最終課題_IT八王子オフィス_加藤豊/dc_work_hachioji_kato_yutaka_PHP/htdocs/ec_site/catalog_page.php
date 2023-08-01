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
    $sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["logout_tag"])){  
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

         if(isset($_POST["favorite_tag"])){
            // header('Location:index.php');
            // exit();

         }

         if(isset($_POST["mypage_tag"])){
            // header('Location:index.php');
            // exit();

         }


         if(isset($_POST["buy_button"])){
            $product_id = htmlspecialchars($_POST["count_id_value"], ENT_QUOTES, 'UTF-8');
            $product_count = htmlspecialchars($_POST["product_count_value"], ENT_QUOTES, 'UTF-8');

            $login_user_name = $_SESSION["login_user_name"];

            $create_date = date('Ymd');
            $update_date = date('Ymd');

            

            $sql =  " SELECT * FROM ec_cart_table WHERE product_id = '$product_id'";
            if($result = $db->query($sql)){
                $row4 =$result->fetch();

                //指定商品がすでにDBのショッピングカート情報を保存するテーブルに保存されている時、DBの数量をDBの数量＋１に更新する。
                if($row4["product_id"]==""){
                    
                        $sql =  " SELECT * FROM ec_user_table WHERE user_name = '$login_user_name'";
                        if($result = $db->query($sql)){
                            $row =$result->fetch();
                            $user_id = $row["user_id"];
                            
                        }

                        //新規にデータベースにカートに入れた情報を挿入
                        $insert = "INSERT INTO ec_cart_table (user_id,product_id,product_count,create_date, update_date) VALUES ('$user_id','$product_id','$product_count','$create_date','$update_date');";

                        if($result=$db->query($insert)){

                            $sql =  " SELECT * FROM ec_product_table WHERE product_id = '$product_id'";
                            if($result = $db->query($sql)){
                                $row3 =$result->fetch();

                                $message[]=  "『". $row3["product_name"]."』の商品は正常にカートに追加されました";

                            }
                            
                        }

                }else{  
                        $product_count =$row4["product_count"]+1;
 
                        $update = "UPDATE ec_cart_table SET product_count = '$product_count' WHERE product_id = '$product_id';";
                        $result = $db->query($update);

                        $sql =  " SELECT * FROM ec_product_table WHERE product_id = '$product_id'";
                            if($result = $db->query($sql)){
                                $row3 =$result->fetch();
                    
                                $message[]=  "『". $row3['product_name']."』の商品は正常にカートに追加されました";
                               
                            }
                }
                
                
            }


            


            

          
         }

        


    }



    //ログアウトであれば、catalog_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }
                
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog page</title>


    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
      -->
    </script>


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
                    vertical-align: middle;
                    font-family:"Yu Mincho";
                    /* letter-spacing: 2px; */
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

                .label_user{
                    text-align: center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #02235F;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    padding-left:50px;
                    color:white;

                }


                span{
                    font-size: 14px;
                    height: 18px;
                    line-height:  18px;
                    color:#02235F;

                }

                .text{
                    text-align: left;
                    font-size: 14px;
                    margin-top: 20px;
                }

                .ring_wrapper,.necklace_wrapper{
                    width: 1300px;
                    height:380px;
                    margin: 0 auto;
                    display: flex;
                    margin-top: 20px;
                }

                .ring_img img ,.necklace_img img{
                    width: 200px;
                    height:200px;
                }

                .ring_img,.necklace_img{
                    margin-right: 30px;
                    margin-left: 30px;
                    position: relative;
                }

                .online_tag{
                    max-width: 90px;
                    max-height:20px;
                    
                }

                .ring_name,.necklace_name{
                    font-family: system-ui;
                    letter-spacing: 2px;
                    margin-top: 13px;
                    margin-bottom: 10px;
                    font-size: 14px;
                }

                        
                .ring_price,.necklace_price{
                    font-size: 16px;

                }
                

                .publish_tag{
                    max-width: 60px;
                    max-height:20px;


                }
                
                .exclusive_tag{
                    max-width: 35px;
                    max-height:20px;

                }

                
                .ring_container,.necklace_container{
                    width: 100%;
                    height: 530px;
                    z-index: 1;
                    position: relative;
                    background-color: #fff;
                }

                .ring_container,.necklace_container{
                    width: 100%;
                    height: 530px;
                    z-index: 1;
                    position: relative;
                    background-color: #fff;
                }

                .ring_title{
                font-size: 26px;
                text-align: center;
                font-weight: bold;
                    letter-spacing: 3px;
                    margin-top: 90px;
                    margin-bottom: 30px;
                
                }

                    
                .necklace_title{
                    font-size: 26px;
                    text-align: center;
                    font-weight: bold;
                    letter-spacing: 3px;
                    margin-top: 13px;
                    margin-bottom: 30px;
                    padding-top: 20px;
                    
                }

                .buy_button{
                    color: white;
                    background-color: #1c1c1c;
                    padding:10px 30px;
                    margin-left: 20px;
                    font-family: system-ui;
                    letter-spacing: 2px;

                }

                .buy_button:hover{
                    cursor: pointer;
                }

                .img_container{
                    width: 200px;
                    height: 330px;
                }

                .buy_form{
                    margin-top: 20px;
                }

                .login_name{
                    font-size :17px;
                    color: #02235F;
                    float: right;
                    margin-right: 30px;
                    height: 10px;

                }

                .under_area{ 
                    height: 400px;
                    

                    color: white; 
                    text-align: center;
                    font-size: 25px;
                    padding-top: 50px; 
                }

                .under_area::before{ 
                    content: ""; 
                    position: fixed;
                    top: 220px; left: 0; 
                    width: 100%;
                    height: 400px; ; 
                    z-index: -1; 
                    background-image: url("img/under_area2.jpg");
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


                .soldout{
                    max-width: 250px;
                    height: 80px;
                    position: absolute;
                    top:0px;
                    left:-10px;
                    z-index: 2;
                            
                }

                .blind_img_container{
                    width:200px;
                    height: 330px;
                    background-color: #fff;
                    opacity: 0.6;
                    position: absolute;

                }


                .msg2{
                    color:blue;
                    font-size: 18px;
                    font-weight: bold;
                    margin-left: 350px;
                }


    </style>
              
</head>







<body>
   
     <div class="header">
     <p class="label_user">2023 Spring Collection発売</p>

     <?php
        if (!empty($message) ){
            foreach($message as $err2){
                print "<span class='msg2'>$err2</span>";
                
            }
        }

        if (!empty($test) ){
            foreach($test as $err1000){
                print "<span class='msg2'>$err1000</span>";
                
            }
        }

     ?>

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


        <div class="ring_container">
            <p class="ring_title">Ring</p>
            <div class="ring_wrapper">

            <?php
            
            $sql =  " SELECT *FROM ec_product_table JOIN ec_stock_table ON ec_product_table.product_id = ec_stock_table.product_id WHERE category = 'ring';";

                if($result = $db->query($sql)){
                    while($row =$result->fetch()){ 
                        $get_img_url = $row["image_path"];
                
                        if($row["public_flg"] === "0"){
                            $img_display = "none";
                
                        } else {
                            $img_display = "block";
                
                        }


                        if($row["stock_count"] === "0"){
                            $sold_out_display1="hidden";
                            $sold_out_display2="visible";
                
                        } else {
                            $sold_out_display1="visible";
                            $sold_out_display2="hidden";
                
                        }





                    ?>
                       
                        <div style="display:<?php print $img_display;?>" class= "ring_img">
                        <div class="img_container">
                        <div class="blind_img_container" style="visibility:<?php print $sold_out_display2;?>" >
                        </div>

                        <img src="<?php print $get_img_url; ?>">
                        <br>
                        <img class="online_tag" src="img/online_tag.png">
                        <p class="ring_name"><?php print $row["product_name"]; ?></p>
                        <p class="ring_price">¥<?php print number_format($row["price"]); ?>(tax in)</p>
                        </div>
                        <form method="post" action="" class="buy_form">
                            <input type="submit" class="buy_button" name="buy_button" style="visibility:<?php print $sold_out_display1;?>"  value="カートに入れる">
                            
                            <input type ="hidden" name="count_id_value" value ="<?php print $row["product_id"]?>">
                            <input type ="hidden" name="product_count_value" value ="<?php print 1;?>">

                            <img src="img/soldout.png" style="visibility:<?php print $sold_out_display2;?>" class="soldout">
                        </form>
                               
                        </div>

                        <?php

                   }
                }

                
            
            ?>

                

                  

            </div>
            

        </div>

        <div class="under_area">2023 Spring Collection 72Sec jewerly homme＋<br><br>華やかでいて肌馴染みも良い<br>オリジナルカラーの「72Secアクアゴールド」
          <br><br>72Secだけの特別な輝きを纏った<br>大人の洗練されたジュエリーコレクションです</p> </div>
 

        <div class="necklace_container">
            <p class="necklace_title">Necklace</p>
            <div class="necklace_wrapper">

            <?php


                $sql =  " SELECT *FROM ec_product_table JOIN ec_stock_table ON ec_product_table.product_id = ec_stock_table.product_id WHERE category = 'necklace';";

                if($result = $db->query($sql)){
                    while($row =$result->fetch()){ 
                        $get_img_url = $row["image_path"];

                     
                        if($row["public_flg"] === "0"){
                            $img_display = "none";

                        } else {
                            $img_display = "block";

                        }

                         
                        if($row["stock_count"] === "0"){
                            $sold_out_display1="hidden";
                            $sold_out_display2="visible";
                
                        } else {
                            $sold_out_display1="visible";
                            $sold_out_display2="hidden";
                
                        }
    ?>
                         
                        <div style="display:<?php print $img_display;?>;" class= "necklace_img">
                        <div class="img_container">
                        <div class="blind_img_container" style="visibility:<?php print $sold_out_display2;?>" >
                        </div>
                        <img src="<?php print $get_img_url;?>">
                        <br>
                        <img class="online_tag" src="img/online_tag.png">
                        <p class="necklace_name"><?php print $row["product_name"]; ?></p>
                        <p class="necklace_price">¥<?php print number_format($row["price"]); ?>(tax in)</p>
                        </div>
                        <form method="post" action="" class="buy_form">
                            <input type="submit" class="buy_button" name="buy_button" style="visibility:<?php print $sold_out_display1;?>" value="カートに入れる">

                            <input type ="hidden" name="count_id_value" value ="<?php print $row["product_id"]?>">
                            <input type ="hidden" name="product_count_value" value ="<?php print 1;?>">

                            <img src="img/soldout.png" style="visibility:<?php print $sold_out_display2;?>" class="soldout">
                        </form>
                        </div>

            <?php

                    }
                }
            ?>

            </div>
            

        </div>

    </div>
 
</body>
</html>
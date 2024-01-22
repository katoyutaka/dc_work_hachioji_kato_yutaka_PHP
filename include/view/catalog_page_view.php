

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ショッピングページ</title>

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
                    background-image: url("img/under_area2.gif");
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


    <?php
       include_once __DIR__.'/header.php';
    ?>
              

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

            $db = get_connect();

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
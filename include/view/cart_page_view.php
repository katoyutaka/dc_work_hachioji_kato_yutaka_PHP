
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ショッピングカート</title>
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
                    font-size:20px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 90px;
                    line-height: 40px;
                    width: 1000px;
                    padding-left:50px;
                    margin-top: 50px;

                    
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
                    font-size: 14px;
                    padding-top: 10px;

                }

                .label_user3{
                    font-size: 14px;
                    color:red;
                }


                .image_wrapper{
                        /* width: 1000px; */
                        height:80px;
                        margin:0 auto;
                    }

                .image{
                    width:300px;
                    float:right;
                }

                .catalog_wrapper{
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
                    padding-bottom: 50px; 
                    
                    margin-left: 50px;
                    
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

                .text_product_count{
                    width: 35px;
                   
                }


    </style>

    <?php
        include_once __DIR__.'/header.php';
    ?>


<div class="main_wrapper">
    <div class="top_tag">
        <p>Shopping Cart</p>

        <div class="image_wrapper">
            <img src='img/shopping1.png' class="image">
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


    <div class="label_user">ご注文商品 
            <span>発送予定日  :            
                <?php
                    print  date("Y年m月d日", strtotime("2 day")); 
                    
                ?>
            </span>
        <p class="label_user3">※お届け日ではありません。またコンビニ前払いの場合は発送日が異なります。ご注意ください。</p>
    </div>

    <?php
        $sql ="SELECT * FROM ec_cart_table JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id; ";

        $db = get_connect();


        //↓ここがprepareでなくただのqueryなので修正すること。12月1現在！
        
        $stmt = $db->query($sql);


        $all = $stmt->fetchAll();


        $total_sum = 0;
        foreach($all as $row){
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
                                    <input type ="text" name="text_product_count" class="text_product_count" value ="<?php print $row["product_count"];?>">
                                    <input type="submit" class="product_count_button" name="product_count_button" value="変更"  >

                                    
                            </form>
                            </td>


                            <td class="td_delete">
                                <form method="post" action="">
                                    <input type ="hidden" name="delete_id_value" value ="<?php print $row["product_id"]?>">
                                    <input type ="hidden" name="delete_cart_id_value" value ="<?php print $row["cart_id"]?>">
                                    <input type="submit" class="delete_button" name="delete_button" value="削除"  >
                                </form>
                            </td>

                </table>
              
    <?php
            }
        
    ?>
            </div>
    </div>

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

        <div class="button_container">
                <form method="post" action="">
                    <input type="submit" class="reverse-button" name="reverse-button" value="ショッピングページに戻る">
                    <input type="submit" class="next-button"  name="next-button" value="次へ">
                </form>
        </div>

    
</body>
</html>


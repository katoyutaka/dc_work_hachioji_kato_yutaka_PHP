
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理ページ</title>


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
                    font-family: system-ui;
                    letter-spacing: 2px;
                }
                
              
                h1 {
                    font-size:24px;
                    width: 280px;
                    height: 370px;
                    line-height: 370px;
                    text-align: center;
                    /* margin-right: 100px; */
                }

                p {
                    font-size:18px; 
                }


                .box{
                    color: #fff;
                    font-weight: bold; 
                    width: 180px;
                    height:220px;
                    border:1px solid #b7b7b7;
                    margin-right:5px;
                    margin-bottom:5px;
                    text-align: center;
                    
                }  

                .main {
                    margin-left:50px;
                    width:650px;
                }

                .contents-container {
                    display:flex;
                    flex-wrap: wrap;
                    margin-top:10px;

                }

                .contents-container p {
                    text-align: center;
                    font-size:10px;
                
                }
                    
              
      
                .introduce-image{
                    width:100%;
                    max-width: 128px;
                    max-height: 128px;
                    margin: 0 auto;
                    display: block;
                    
                    

                }
   
                .img-container {
                    height:150px;
                    margin-right:20px;
                    margin-left:20px;
                    margin-top: 5px;
                    margin: 0 auto;
                    width:100%;
                    display: inline;
                    
                }


                .btn-wrapper{
                    margin-bottom:2px;
                }

                .flg-button {
                    display: inline-block;
                    width: 90px;
                    height:20px;
                    font-size:11px;
                }

                .title{
                    display:inline-block;
                    margin-top:2px;
                    margin-bottom:2px;
                    color:#000000;
                }
                .msg{
                    color:red;
                    font-size: 13px;
                    font-weight: bold;
                }

                .msg2{
                    color:blue;
                    font-size: 13px;
                    font-weight: bold;
                }

                .on_off_button  {
                    display: inline-block;
                    font-size: 12px;
                    text-align: center;
                }

                .button-container {
                    margin-top: 10px;
                    margin-bottom: 10px;

                }

                .img-wrapper{
                    height:170px;
                }

                table,
                th,
                td {
                    border:solid #333 1px;
                    text-align: center;
                }

                table{
                    margin:0 auto;
                }
                
                .product_image_container{
                    width:100px;
                    height:100px;
                }

                .label_user1{
                    text-align:center;
                    font-size:18px;
                    /* font-weight:bold; */
                    background-color:#444444;
                    height: 40px;
                    line-height: 40px;
                    font-size: 24px;
                    width: 100%;
                    /* margin-top:20px; */
                    color:#fff;
                    
                }
                
                .main_form{
                    width: 500px;
                    height: 390px;
                    background-color: #b7b7b7;
                    margin:0 auto;
                    width: 100%;
                    display: flex;
                
                }

                .label1,.label2,.label3,.label4,.label5,.label6,.label7{
                    margin-top: 20px;
                    margin-left: 50px;
                    font-size: 20px;
                    
                }

                .product_name{
                    height: 25px;
                    width: 280px;
                    margin-left:14px;
                }


                .price{
                    height: 25px;
                    width: 120px;
                    margin-left:42px;
                }

                .stock_count{
                    height: 25px;
                    width: 120px;
                    margin-left:43px;
                }

                .public_flg{
                    height: 25px;
                    width: 80px;
                    margin-left:13px;
                }

                
                .category{
                    height: 25px;
                    width: 120px;
                    margin-left:14px;
                }

                .product_image{
                    margin-left:43px;
                }

                .submit{
                    color: white;
                    background-color: #1c1c1c;
                    padding:10px 150px;
                    /* margin-left: 20px; */
                    font-family: system-ui;
                    letter-spacing: 2px;
                    margin-top: 10px;

                }

                .over_area{
                    width: 100%;
                    height: 430px;
                    /* z-index: 2;
                    position: fixed;
                    top: 0px;
                    left: 0px; */

                }

                .under_area{
                    width: 100%;
                    height: 1900px;
                }

                .td_product_name{
                    width: 300px;
                }

                .td_price{
                    width: 100px;

                }

                .td_stock_count{
                    width: 180px;

                }

                .td_public_flg{
                    width: 150px;

                }

                .td_create_date,.td_update_date{
                    width: 150px;
                }

                .td_delete{
                    width: 100px;

                }
                .count_text{
                    width: 50px;
                }

                .count_button,.delete_button{
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

                .public_flg_button{
                    color: white;
                    background-color: #1c1c1c;
                    width: 120px;
                    height: 25px;
                    /* margin-left: 20px; */
                    font-family: system-ui;
                    letter-spacing: 2px;
                    /* margin-top: 10px; */
                    font-size: 12px;
                }

                .err_area{
                    /* background-color: blue; */
                    width: 460px;
                    display: flex;
                
                }

                .input_area{
                    /* background-color: green; */
                    width: 500px;
                    padding-left: 20px;
                

                }
                .confirm_area,.update_area{
                    width: 350px;
                    height: 200px;
                    background-color: #fff;
                    
                    /* margin-left: 50px; */
                    
                }

                .confirm_area{
                    margin-right: 20px;
                    padding-left: 20px;

                }



                .err_area p{
                    margin-top: 10px;
                    font-size: 15px;
                }

                .err_area1{
                    margin-left: 10px;
                }

                
                .logout_button{
                    color: white;
                    background-color: #1c1c1c;
                    padding:10px 5px;
                    /* margin-left: 20px; */
                    font-family: system-ui;
                    letter-spacing: 2px;
                    float:right;
                    font-size: 12px;
                    margin-top: 100px;
                    width: 150px;

                }
        

        </style>

</head>
<body>
<div class="over_area">
    <p class="label_user1">商品管理</p>
   <?php print $product_id;?>
    <div class="main_form">
        <h1>商品登録フォーム</h1>
     

        <form method="post" action="" enctype="multipart/form-data" class="input_area">
            <p class="label1">商品名 ：<input type="text" class="product_name" name="product_name"></p>
            <p class="label7">カテゴリ   ：<input type="text" class="category" name="category"></p>
            <p class="label2">価格：<input type="text" class="price" name="price"></p>
            <p class="label3">個数：<input type="text" class="stock_count" name="stock_count"></p>
            <p class="label4">画像：<input type="file" class="product_image" name="product_image"></p>
            <p class="label5">公開/非公開：<input type="text" class="public_flg" name="public_flg"></p>
            <p class="label6"><input type="submit" name="submit" class="submit" value="商品を登録する"></p>
        </form>
        
        <div class="err_area">
            <div class="err_area1">
                <p>商品の登録結果</p>
                <div class="confirm_area">
                    <?php
                            if (!empty($validation_error) ){
                                foreach($validation_error as $err){
                                    print "<span class='msg'>$err</span>";
                                }
                            }

                            print "<span class='msg'>$str</span><br>";
                    ?>
                </div>
            </div>

            <div class="err_area2">
                <p>商品情報の更新結果</p>
                <div class="update_area">
                    <?php
                            if (!empty($update_message) ){
                                foreach($update_message as $err2){
                                    print "<span class='msg2'>$err2</span>";
                                    
                                }
                            }
                        ?>

                </div>
                <form method="post" action="">
                   <input type="submit" class="logout_button" name="logout_button" value="LOGOUT">
                </form>
            </div>

        </div>



    </div>


</div>


<div class="under_area">
    <?php


    $sql =  " SELECT * FROM ec_product_table JOIN ec_stock_table ON ec_product_table.product_id = ec_stock_table.product_id";

    if($result = $db->query($sql)){
        while($row =$result->fetch()){ 
        $get_img_url = $row["image_path"];

        if($row["public_flg"] === "0"){
            $display = "公開にする";
            $color = "gray";

        } else {
            $display = "非公開にする";
            $color = "white";

        } 
        
        ?>
       
            <table style="background:<?php print $color; ?>;">
            <tr>
                <th>画像</th><th>商品名</th><th>価格</th><th>在庫数</th><th>公開<br>非公開</th><th>作成日</th><th>更新日</th><th>削除</th><br>
            </tr>
            
                <td><img class="product_image_container" src= "<?php print $get_img_url; ?>"></td>
                <td class="td_product_name"><?php print $row["product_name"];?></td>
                <td class="td_price"><?php print $row["price"];?></td>

                <td class="td_stock_count">
                    <form method="post" action="" class="stock_count_form">
                        <input type ="hidden" name="count_id_value" value ="<?php print $row["stock_id"]?>">
                        <input type="text" class="count_text" name="count_text" value="<?php print $row["stock_count"];?>"  >
                        <input type="submit" class="count_button" name="count_button" value="登録"  >
                    </form>
                    
                </td>

                <td class="td_public_flg">
                    <form method="post" action="">
                        <input type ="hidden" name="id_value" value ="<?php print $row["product_id"]?>">
                        <input type="submit" class="public_flg_button" name="public_flg_button" value="<?php print $display; ?>">
                    </form>
                    
                </td>


                <td class="td_create_date"><?php print $row["create_date"];?></td>
                <td class="td_update_date"><?php print $row["update_date"];?></td>

                <td class="td_delete">
                    <form method="post" action="">
                        <input type ="hidden" name="delete_id_value" value ="<?php print $row["product_id"]?>">
                        <input type="submit" class="delete_button" name="delete_button" value="削除"  >
                    </form>
                </td>

        </table>
        <?php }

    } ?>

</div>
                       

    
</body>
</html>
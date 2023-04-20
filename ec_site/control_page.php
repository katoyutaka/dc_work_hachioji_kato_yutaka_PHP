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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){
            //商品名,価格,個数,画像,公開/非公開のバリデーションチェック

            //商品名product_name
            //  価格price
            //  個数product_count
            //  画像product_image
            //  公開/非公開public_flg


                    $product_name =''; 
                    if(!empty($_POST['product_name'])){
                        $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
                    } else {
                        $validation_error[]="商品名が未入力です"."<br>";
                    }



                    $price ='';
                    if(!empty($_POST['price'])){
                        $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');

                        if(!preg_match("/^[0-9]+$/", $price)){
                            $validation_error[] = "「価格」が数字以外の形式になっています"."<br>";
                        }

                    } else {
                        $validation_error[]="価格が未入力です"."<br>";
                    }


                    $product_count ='';
                    if(!empty($_POST['product_count'])){
                        $product_count = htmlspecialchars($_POST['product_count'], ENT_QUOTES, 'UTF-8');

                        if(!preg_match("/^[0-9]+$/", $product_count)){
                            $validation_error[] = "「個数」が数字以外の形式になっています"."<br>";
                        }

                    } else {
                        $validation_error[]="個数が未入力です"."<br>";
                    }

                    
                    $product_image ='';
                    $image_path ='';
                    if(!empty($_FILES['product_image']['name'])){
                        $product_image = htmlspecialchars($_FILES['product_image']['name'], ENT_QUOTES, 'UTF-8');
                        $image_path =  'img/'.htmlspecialchars($_FILES['product_image']['name'], ENT_QUOTES, 'UTF-8');


                    } else {
                        $validation_error[]="画像が未選択です"."<br>";
                    }


                    $product_image_tmp_name ='';
                    if(isset($_FILES['product_image']['tmp_name'])){
                        $product_image_tmp_name = htmlspecialchars($_FILES['product_image']['tmp_name'], ENT_QUOTES, 'UTF-8');
                    }
                    

                    $file=pathinfo($image_path);
                    $filetype=$file["extension"];
                        
                    if (!($filetype === "jpeg" || $filetype === "png" || $filetype === "jpg")) {
                        $validation_error[] = "拡張子がJPEG,PNG,JPG以外の形式になっています"."<br>";
                    }



                    
                    $public_flg ='';
                    $cg_public_flg= '';
                    if(!empty($_POST['public_flg'])){
                        $public_flg = htmlspecialchars($_POST['public_flg'], ENT_QUOTES, 'UTF-8');

                        if(!($public_flg === "公開" || $public_flg === "非公開")){
                            $validation_error[] = "ステータスが「公開」または「非公開」以外の形式になっています"."<br>";
                        }else{

                            if($public_flg === "公開"){
                                $cg_public_flg = 1;
                            }

                            if($public_flg === "非公開"){
                                $cg_public_flg = 0;
                            }
                        }

                            

                    } else {
                        $validation_error[]="ステータスが未入力です"."<br>";
                    
        }


                    

                    


                    




                

            // バリデーションチェックOKならSQL文(insert文)送る(➀各データの登録時)
                    
                    if (empty($validation_error) ){

                            $create_date = date('Ymd');
                            $update_date = date('Ymd');
                            $insert = "INSERT INTO ec_product_table (product_name, price,public_flg, create_date, update_date,image_path) VALUES ('$product_name', '$price','$cg_public_flg', ".$create_date.",".$update_date.",'$image_path');";

                            if($result=$db->query($insert)){
                                $save = 'ec_site/img/'.basename($product_image);
                                move_uploaded_file($product_image_tmp_name,$save);
                                $str = "商品登録が完了しました";
                                print "<span class='msg'>$str</span><br>";
                              
                            } else {
                                $str = "データベースに既に同じファイル名が存在している為か、その他の理由により登録失敗しました。"."<br>";
                                print "<span class='msg'>$str</span><br>";
                            
                            }

                    } else {
                            foreach($validation_error as $err){
                                print "<span class='msg'>$err</span><br>";
                                
                            }
                        
                    }

        }


    }


?>




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
                    width: 400px;
                    height: 370px;
                    line-height: 370px;
                    text-align: center;
                    margin-right: 100px;
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

                .product_count{
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
                    height: 1000px;
                }

                .td_product_name{
                    width: 300px;
                }

                .td_price{
                    width: 100px;

                }

                .td_product_count{
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
                
                }

                .input_area{
                    /* background-color: green; */
                    width: 560px;
                

                }
                .confirm_area,.update_area{
                    width: 450px;
                    height: 100px;
                    background-color: #fff;
                }

                .err_area p{
                    margin-top: 30px;
                }


        </style>

</head>
<body>
<div class="over_area">
    <p class="label_user1">商品管理</p>
    <div class="main_form">
        <h1>商品登録フォーム</h1>

        <form method="post" action="" enctype="multipart/form-data" class="input_area">
            <p class="label1">商品名 ：<input type="text" class="product_name" name="product_name"></p>
            <p class="label7">カテゴリ   ：<input type="text" class="category" name="category"></p>

            <p class="label2">価格：<input type="text" class="price" name="price"></p>
            <p class="label3">個数：<input type="text" class="product_count" name="product_count"></p>
            <p class="label4">画像：<input type="file" class="product_image" name="product_image"></p>
            <p class="label5">公開/非公開：<input type="text" class="public_flg" name="public_flg"></p>
            <p class="label6"><input type="submit" name="submit" class="submit" value="商品を登録する"></p>
        </form>
        
        <div class="err_area">
            <p>商品の登録結果を以下に表示します。</p>
            <div class="confirm_area">

            </div>

            <p>商品情報の更新結果を以下に表示します。</p>
            <div class="update_area">

            </div>



        </div>
    </div>

</div>


<div class="under_area">
    <?php


    $sql = "SELECT * FROM  ec_product_table";

    if($result = $db->query($sql)){
        while($row =$result->fetch()){ 
        $get_img_url = $row["image_path"];
        
        ?>

            <table>
            <tr>
                <th>画像</th><th>商品名</th><th>価格</th><th>在庫数</th><th>公開<br>非公開</th><th>作成日</th><th>更新日</th><th>削除</th><br>
            </tr>
            
                <td><img class="product_image_container" src= "<?php print $get_img_url; ?>"></td>
                <td class="td_product_name"><?php print $row["product_name"];?></td>
                <td class="td_price"><?php print $row["price"];?></td>

                <td class="td_product_count">
                    <form method="post" action="" class="product_count_form">
                        <input type="text" class="count_text" name="count_text" value="<?php print $row["product_count"];?>"  >
                        <input type="submit" class="count_button" name="count_button" value="登録"  >
                    </form>
                    
                </td>

                <td class="td_public_flg">
                    <form method="post" action="">
                        <input type="submit" class="public_flg_button" name="public_flg_button" value="非公開にする"  >
                    </form>
                    
                </td>


                <td class="td_create_date"><?php print $row["create_date"];?></td>
                <td class="td_update_date"><?php print $row["update_date"];?></td>

                <td class="td_delete">
                    <form method="post" action="">
                        <input type="submit" class="delete_button" name="delete_button" value="削除"  >
                    </form>
                </td>

        </table>
        <?php }

    } ?>

</div>








            <?php
                // ポイントはデータベースからidをもってきて、それをボタンにつける。ボタンに名前をつけてやる。それで、ボタンのid = データベースidで表示・非表示分ける。
                // ポイントはデータベースから持ってきたflag情報をfetch_assocのループの中で場合分けして、各変数も全てここにいれる！

               
                // while($row = $result->fetch_assoc()){


                //     $get_img_url = $row["image_path"];

                //     if($row["public_flg"] === "1"){
                //         $display = "表示する";
                //         $color = "gray";
                //         $img_display = "hidden";

                //     } else {
                //         $display = "非表示にする";
                //         $color = "white";
                //         $img_display = "visible";

                //     } 

            ?>
      

                    

                                 
            </div>

        </div>
    
</body>
</html>
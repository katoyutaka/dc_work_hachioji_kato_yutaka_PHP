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



                    $category ='';
                    if(!empty($_POST['category'])){
                        $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');

                        if (!($category === "ring" || $category === "necklace" )) {
                            $validation_error[] = "カテゴリが「ring」または「necklace」以外になっています"."<br>";
                        }

                    } else {
                        $validation_error[]="カテゴリが未入力です"."<br>";
                    }



                    $price ='';
                    if(!empty($_POST['price'])){
                        $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');

                        if(!preg_match("/^([1-9][0-9]*|0)$/", $price)){
                            $validation_error[] = "「価格」が0以上の整数以外の形式になっています"."<br>";
                        }

                    } else {
                        $validation_error[]="価格が未入力です"."<br>";
                    }


                    $product_count ='';
                    if(!empty($_POST['product_count'])){
                        $product_count = htmlspecialchars($_POST['product_count'], ENT_QUOTES, 'UTF-8');

                        if(!preg_match("/^([1-9][0-9]*|0)$/", $product_count)){
                            $validation_error[] = "「個数」が0以上の整数以外の形式になっています"."<br>";
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


                    

                    


                    




                

            // バリデーションチェックOKならSQL文(insert文)送る
                    
                    if (empty($validation_error) ){

                            $create_date = date('Ymd');
                            $update_date = date('Ymd');
                            $insert = "INSERT INTO ec_product_table (product_name,category, price,product_count,public_flg, create_date, update_date,image_path) VALUES ('$product_name', '$category','$price','$product_count','$cg_public_flg', ".$create_date.",".$update_date.",'$image_path');";

                            if($result=$db->query($insert)){
                                $save = 'ec_site/img/'.basename($product_image);
                                move_uploaded_file($product_image_tmp_name,$save);
                                $str ="『".$product_name."』の商品登録が完了しました";
                               
                              
                            } else {
                                $str = "データベースに既に同じファイル名が存在している為か、その他の理由により登録失敗しました。"."<br>";
                            
                            }

                     }






  

        }



        if(isset($_POST["public_flg_button"])){
            $number = htmlspecialchars($_POST["id_value"], ENT_QUOTES, 'UTF-8');

            if($_POST["public_flg_button"] === "公開にする"){

                $update = "UPDATE ec_product_table SET public_flg = '1' WHERE product_id = ".$number.";";
                $result = $db->query($update);
                $update = "UPDATE ec_product_table SET update_date = '".date('Ymd')."' WHERE product_id = ".$number.";";
                $result = $db->query($update);


                //何の商品を公開にしたのか知るために以下の商品名を取ってくるコードも記載。
                $select = "SELECT * FROM  ec_product_table WHERE product_id = ".$number.";";
                if($result2 = $db->query($select)){
                    $row2 =$result2->fetch();
                }

                $update_message[]= "『".$row2["product_name"]."』を公開に変更しました"."<br>";

            } 

            if($_POST["public_flg_button"] === "非公開にする"){
                
                $update = "UPDATE ec_product_table SET public_flg = '0' WHERE product_id = ".$number.";";
                $result = $db->query($update);
                $update = "UPDATE ec_product_table SET update_date = '".date('Ymd')."' WHERE product_id = ".$number.";";
                $result = $db->query($update);


                //何の商品を非公開にしたのか知るために以下の商品名を取ってくるコードも記載。
                $select = "SELECT * FROM  ec_product_table WHERE product_id = ".$number.";";
                if($result2 = $db->query($select)){
                    $row2 =$result2->fetch();
                }

                $update_message[]= "『".$row2["product_name"]."』を非公開に変更しました"."<br>";


            }

         }



         if(isset($_POST["delete_button"])){

            $delete_number = htmlspecialchars($_POST["delete_id_value"], ENT_QUOTES, 'UTF-8');

            //何の商品を削除したのか知るために以下の商品名を取ってくるコードも記載。
            $select = "SELECT product_name FROM  ec_product_table WHERE product_id = ".$delete_number.";";
            if($result2 = $db->query($select)){
                $row2 =$result2->fetch();
            }

            $delete = "DELETE FROM ec_product_table WHERE ec_product_table.product_id = ".$delete_number.";";
            $result = $db->query($delete);
            
            $update_message[]= "『".$row2["product_name"]."』を削除しました"."<br>";



         }


    
         if(isset($_POST["count_button"])){


            
                if(!empty($_POST["count_text"])){
                    $count_button_number = htmlspecialchars($_POST["count_id_value"], ENT_QUOTES, 'UTF-8');
                    $count_text = htmlspecialchars($_POST["count_text"], ENT_QUOTES, 'UTF-8');

                    
                    //何の商品の在庫数を変更したのか知るために以下の商品名を取ってくるコードも記載。
                    $select = "SELECT * FROM  ec_product_table WHERE product_id = ".$count_button_number.";";
                    if($result2 = $db->query($select)){
                        $row2 =$result2->fetch();
                    }



                    if(!preg_match("/^([1-9][0-9]*|0)$/", $count_text)){

                        $update_message[] = "『".$row2["product_name"]."』の「在庫数」が0以上の整数以外の形式になっています"."<br>";

                    }else{

                        //変更する在庫数とデータベースに登録されている在庫数が同じであるときは、変更できないとメッセージを表示する。

                        if($count_text === $row2["product_count"]){

                            $update_message[]= "『".$row2["product_name"]."』の在庫数に変更がないため更新できません"."<br>";


                        }else{
                            $update = "UPDATE ec_product_table SET product_count = ".$count_text." WHERE product_id = ".$count_button_number.";";
                            $result = $db->query($update);
                            $update = "UPDATE ec_product_table SET update_date = '".date('Ymd')."' WHERE product_id = ".$count_button_number.";";
                            $result = $db->query($update);
    
                            $update_message[]= "『".$row2["product_name"]."』の在庫数を変更しました"."<br>";

                        }



                    }

                    
                }

                if(empty($_POST["count_text"])){
                    
                    $update_message[]= "『".$row2["product_name"]."』の「在庫数」が未入力です"."<br>";

                }

         }


         if(isset($_POST["logout_button"])){
            //ログアウトが押されたら、セッションとクッキーを空にして、login.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            setcookie("user_check","",time()-100);
            setcookie("login_user_name","",time()-100);  
            setcookie("sign_up_password_1","",time()-100);  

            header('Location:login.php');
            exit();
         }

       

        




    }

    //ログアウトであれば、control_page.phpに来ても、login.phpに遷移するようにする。
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
                    height: 1900px;
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


    $sql = "SELECT * FROM  ec_product_table";

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

                <td class="td_product_count">
                    <form method="post" action="" class="product_count_form">
                        <input type ="hidden" name="count_id_value" value ="<?php print $row["product_id"]?>">
                        <input type="text" class="count_text" name="count_text" value="<?php print $row["product_count"];?>"  >
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
                       
<!-- </div>

 </div> -->
    
</body>
</html>
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
                    font-size:20px; 
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
                }
                
                .product_image_container{
                    width:100px;
                    height:100px;
                }

                .label_user1{
                    text-align:center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 40px;
                    line-height: 40px;
                    font-size: 24px;
                    width: 1000px;
                    /* margin-top:20px; */
                    color:#02235F;
                    
                }
                

        </style>

</head>
<body>
<p class="label_user1">Login</p>
<h1>商品登録フォーム</h1>

<form method="post" action="" enctype="multipart/form-data">
    <p>商品名：<input type="text" name="product_name"></p>
    <p>価格：<input type="text" name="price"></p>
    <p>個数：<input type="text" name="product_count"></p>
    <p>画像 : <input type="file" name="product_image"></p>
    <p>公開/非公開：<input type="text" name="public_flg"></p>
    <p><input type="submit" name="submit" value="商品を登録する"></p>
</form>


<?php


$sql = "SELECT * FROM  ec_product_table";

if($result = $db->query($sql)){
    while($row =$result->fetch()){ 
    $get_img_url = $row["image_path"];
    
    ?>

        <table>
        <tr>
            <th>画像</th><th>商品名</th><th>価格</th><th>在庫数</th><th>公開/非公開</th><th>作成日</th><th>更新日</th><th>削除</th><br>
        </tr>
        
            <td><img class="product_image_container" src= "<?php print $get_img_url; ?>"></td>
            <td><?php print $row["product_name"];?></td>
            <td><?php print $row["price"];?></td>
            <td><?php print $row["product_count"];?></td>
            <td><?php print $row["public_flg"];?></td>
            <td><?php print $row["create_date"];?></td>
            <td><?php print $row["update_date"];?></td>
            <td>削除</td>

       </table>
    <?php }

} ?>



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
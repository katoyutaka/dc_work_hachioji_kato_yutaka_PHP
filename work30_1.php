

<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $error_msg = array();
        $error_msg=[];
        

        $db = new mysqli($host, $login_user, $password, $database);
        if($db->connect_error){
            print $db->connect_error;
            exit();

        }else{
            $db->set_charset("utf8");
            $db->close();
        }


?>

<!-- バリデーションチェック -->
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $input_data ='';
        	
        if(!empty($_POST['input_data'])){
            $input_data = htmlspecialchars($_POST['input_data'], ENT_QUOTES, 'UTF-8');
        } else {
            $validation_error[]="画像名に問題があるか、未入力です"."<br>";
        }

        $upload_image_name ='';
        $image_path ='';

        if(isset($_FILES['upload_image']['name'])){
            $upload_image_name = htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
            $image_path =  './img/'.htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
        } else {
            $validation_error[] = "アップロードファイル名に問題があるか、未選択です"."<br>";
        }

        $upload_image_tmp_name ='';

        if(isset($_FILES['upload_image']['tmp_name'])){
            $upload_image_tmp_name = htmlspecialchars($_FILES['upload_image']['tmp_name'], ENT_QUOTES, 'UTF-8');
        }

        if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
            $validation_error[] = "「画像名」が半角英数字以外の形式になってるか、未入力です。"."<br>";
        }

        $file=pathinfo($image_path);
        $filetype=$file["extension"];
            
        if(!($filetype === "jpeg")){
                if(!($filetype === "png")){
                    $validation_error[] = "拡張子がJPEGまたはPNG以外の形式になっています"."<br>";
                } 
        }
    

        if(isset($_POST["count_hidden"])){
            $number = htmlspecialchars($_POST["count_hidden"], ENT_QUOTES, 'UTF-8');
        }

// バリデーションチェックOKならSQL文(insert文)送る(➀各データの登録時)
           
        if (empty($validation_error) ){

                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");

                $create_date = date('Ymd');
                $update_date = date('Ymd');
                $insert = "INSERT INTO gallery (image_name, public_flg, create_date, update_date,image_path) VALUES ('$input_data','0',".$create_date.",".$update_date.",'$image_path');";

                if($result=$db->query($insert)){
                    $save = 'img/'.basename($upload_image_name);
                    move_uploaded_file($upload_image_tmp_name,$save);
                    $str = "更新成功しました";
                    print "<span class='msg'>$str</span><br>";
                    $db->close();
                } else {
                    $str = "データベースに既に同じファイル名が存在している為か、その他の理由により更新失敗しました。"."<br>";
                    print "<span class='msg'>$str</span><br>";
                    $db->close();
                
                }

        } else {
                foreach($validation_error as $err){
                    print "<span class='msg'>$err</span><br>";
                    
                }
               
        }



        // ➂表示・非表示ボタンが押されたらデータベースに登録
            if($_POST["btn"] == "表示する"){


                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");
                $update = "UPDATE gallery SET public_flg = '0' WHERE id = ".$number.";";
                $db->query($update);
                $update = "UPDATE gallery SET update_date = '".date('Ymd')."' WHERE id = ".$number.";";
                $db->query($update);
                $db->close();

            } else {

                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");
                $update = "UPDATE gallery SET public_flg = '1' WHERE id = ".$number.";";
                $db->query($update);
                $update = "UPDATE gallery SET update_date = '".date('Ymd')."' WHERE id = ".$number.";";
                $db->query($update);
                $db->close();

            }
      }

// SQL文（select文）送る（➁登録後の画面表示）

        $db = new mysqli($host, $login_user, $password, $database);
        $db->set_charset("utf8");
        $a= "ALTER table gallery drop id";
        $db->query($a);
        $b = "ALTER table gallery add id int(11) primary key not null auto_increment first";
        $db->query($b);
        $c = "ALTER TABLE gallery AUTO_INCREMENT = 1";
        $db->query($c);
        $select = "SELECT * FROM gallery";
        $result = $db->query($select);
        $db->close();


    
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_1</title>

        <style>
                * {
                    box-sizing:border-box;
                    vertical-align: middle;
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

        </style>

    </head>

    <body>
                        
        <h1>画像投稿</h1>
        <form method="post" action="work30_1.php" enctype="multipart/form-data">
            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>

        <form method="get" action="work30_2.php">
        <a href="work30_2.php?data1=<?php print $max;?>&data2=<?php print $row100;?>">画像一覧ページへ</a>
        </form>
        
        <div class=main>
            <div class="contents-container"> 



            <?php
                
                // ポイントはデータベースから持ってきたflag情報をfetch_assocのループの中で場合分けして、各変数も全てここにいれる！

                $j = 1;
                while($row = $result->fetch_assoc()){

                    $get_img_url = $row["image_path"];

                    if($row["public_flg"] === "1"){
                        $display = "表示する";
                        $color = "gray";
                        $img_display = "hidden";

                    } else {
                        $display = "非表示にする";
                        $color = "white";
                        $img_display = "visible";

                    } 
            ?>

                        <div style="background:<?php print $color; ?>;" class="box">
                        <div class ="img-wrapper">
                        <div style="visibility:<?php print $img_display;?>;" class= img-container>
                            <p class="title"><?php print $row['image_name'];?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        </div>
    
                        <form  class = "button-container" method="post" action="">
                            <input type ="hidden" name="count_hidden" value ="<?php print $j;?>">
                            <input type="submit" name="btn" value="<?php print $display ?>">
                        </form>
                        </div>
                    
            <?php
                    $j++;
                    }
            ?>
                                 
            </div>

        </div>

    
    </body>
</html>
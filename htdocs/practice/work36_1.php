
<?php      
       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');

//データベース接続の関数
       function func_db_open(){
            try{
                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
        return $db;
       }

        
// バリデーションチェックの関数
        function validation_func(){
            $validation_error = array();

            if(!empty($_POST['input_data'])){
                $input_data = htmlspecialchars($_POST['input_data'], ENT_QUOTES, 'UTF-8');
            } else {
                $validation_error[]="画像名に問題があるか、未入力です"."<br>"; 
            }

            if(isset($_FILES['upload_image']['name'])){
                $upload_image_name = htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
                $image_path =  './img/'.htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
            } else {
                $validation_error[] = "アップロードファイル名に問題があるか、未選択です"."<br>";
            }

            if(isset($_FILES['upload_image']['tmp_name'])){
                $upload_image_tmp_name = htmlspecialchars($_FILES['upload_image']['tmp_name'], ENT_QUOTES, 'UTF-8');
            }
            
            if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
                $validation_error[] = "「画像名」が半角英数字以外の形式になってるか、未入力です。"."<br>";
            }
            
            $file=pathinfo($image_path);
            $filetype=$file["extension"];

            if(!($filetype === "jpeg" || $filetype === "png" || $filetype === "jpg")){
                $validation_error[] = "拡張子がJPEG,PNG,JPG以外の形式になっています"."<br>";
            }

            return array($input_data,$validation_error,$upload_image_name,$image_path,$upload_image_tmp_name);
        }

        function func_public_flg($row_public_flg){
            if($row_public_flg === "1"){
                $display = "表示する";
                $color = "gray";
                $img_display = "hidden";

            } else {
                $display = "非表示にする";
                $color = "white";
                $img_display = "visible";    
            }

            return array($display,$color,$img_display);
        }


// 表示・非表示の関数➁
        function func_btn($btn){

            $number = htmlspecialchars($_POST["id_value"], ENT_QUOTES, 'UTF-8');
            try{
                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
 


            if($btn == "表示する"){
                $update = "UPDATE gallery SET public_flg = '0' WHERE image_id = ".$number.";";
                $db->query($update);
                $update = "UPDATE gallery SET update_date = '".date('Ymd')."' WHERE image_id = ".$number.";";
                $db->query($update);
            } 

            if($btn == "非表示にする"){
                $update = "UPDATE gallery SET public_flg = '1' WHERE image_id = ".$number.";";
                $db->query($update);
                $update = "UPDATE gallery SET update_date = '".date('Ymd')."' WHERE image_id = ".$number.";";
                $db->query($update);
            }
        

        }

?>
<!-- ---------------------------------------------- -->
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){

        $input_data ='';
        $upload_image_name ='';
        $image_path ='';
        $upload_image_tmp_name ='';
            
        $s = validation_func();
        $input_data = $s[0];
        $validation_error = $s[1];
        $upload_image_name = $s[2];
        $image_path = $s[3];
        $upload_image_tmp_name = $s[4];

            if (empty($validation_error) ){

                    $create_date = date('Ymd');
                    $update_date = date('Ymd');
                    $insert = "INSERT INTO gallery (image_name, public_flg, create_date, update_date,image_path) VALUES ('$input_data','0',".$create_date.",".$update_date.",'$image_path');";
                    $db=new PDO(DSN,LOGIN_USER,PASSWORD);

                    if($result=$db->query($insert)){
                        $save = 'img/'.basename($upload_image_name);
                        move_uploaded_file($upload_image_tmp_name,$save);
                        $str = "更新成功しました";
                        print "<span class='msg'>$str</span><br>";
                        
                    } else {
                        $str = "データベースに既に同じファイル名が存在している為か、その他の理由により更新失敗しました。"."<br>";
                        print "<span class='msg'>$str</span><br>";
                        
                    }

            } else {
                    foreach($validation_error as $err){
                        print "<span class='msg'>$err</span><br>";
                        
                    }
                
            }

        }


        // ➂表示・非表示ボタンが押されたらデータベースに登録
            if(isset($_POST["btn"])){
                    $number = htmlspecialchars($_POST["id_value"], ENT_QUOTES, 'UTF-8');
                    $btn = $_POST["btn"];
                    func_btn($btn);
  
            }
        }

    //   }

// SQL文（select文）送る（➁登録後の画面表示）
        try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }

        $select = "SELECT * FROM gallery";
        $result = $db->query($select);

?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK36_1</title>

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
        <form method="post" action="work36_1.php" enctype="multipart/form-data">
            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" name="submit" value="画像投稿"></p>
        </form>

        <form method="get" action="work36_2.php">
        <a href="work36_2.php?">画像一覧ページへ</a>
        </form>
        
        <div class=main>
            <div class="contents-container"> 



            <?php
               
               
                while($row = $result->fetch()){
                    $get_img_url = $row["image_path"];
                    $row_public_flg = $row["public_flg"]; 

                    $a =func_public_flg($row_public_flg);
                    $display=$a[0];
                    $color=$a[1];
                    $img_display=$a[2];


 
            ?>
      
                <div style="background:<?php print $color; ?>;" class="box">
                <div class ="img-wrapper">
                <div style="visibility:<?php print $img_display;?>;" class= img-container>
                    <p class="title"><?php print $row['image_name'];?></p>
                    <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                </div>
                </div>

                <form  class = "button-container" method="post" action="">
                    <input type ="hidden" name="id_value" value ="<?php print $row["image_id"]?>">
                    <input type="submit" name="btn" value="<?php print $display; ?>">
                </form>
                </div>           

       
                       
            <?php
               }
                    
            ?>
                                 
            </div>

        </div>

    
    </body>
</html>
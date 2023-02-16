
<?php
       
       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');

//データベース接続の関数
       function func_db_open(){
            try{
                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
                return $db;
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
       }
        
// バリデーションチェックの関数
        function validation_func($validation_input_data,$validation_upload_image,$validation_tmp_name,$input_data,$image_path){

                if(!empty($validation_input_data)){
                    $input_data ='';
                    $input_data = htmlspecialchars($validation_input_data, ENT_QUOTES, 'UTF-8');
                    $list[3] = $input_data;
                    return $list;

                } else {
                    $validation_error[]="画像名に問題があるか、未入力です"."<br>";
                    $list[5] = $validation_error;
                    return $list;

                }

                
                if(isset($validation_upload_image)){
                    $upload_image_name ='';
                    $image_path ='';

                    $upload_image_name = htmlspecialchars($validation_upload_image, ENT_QUOTES, 'UTF-8');
                    $image_path =  './img/'.htmlspecialchars($validation_upload_image, ENT_QUOTES, 'UTF-8');
                    $list[4] = $image_path;
                    return $list;

                } else {
                    $validation_error[] = "アップロードファイル名に問題があるか、未選択です"."<br>";
                    $list[5] = $validation_error;
                    return $list;

                }

                if(isset($validation_tmp_name)){
                    $upload_image_tmp_name ='';
                    $upload_image_tmp_name = htmlspecialchars($validation_tmp_name, ENT_QUOTES, 'UTF-8');
                    $list[2] = $upload_image_tmp_name;
                    return $list;
                }

                
                if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
                    $validation_error[] = "「画像名」が半角英数字以外の形式になってるか、未入力です。"."<br>";
                    $list[5] = $validation_error;
                    return $list;
                }
                
                $file=pathinfo($image_path);
                $filetype=$file["extension"];

                if(!($filetype === "jpeg")){
                    if(!($filetype === "png")){
                        $validation_error[] = "拡張子がJPEGまたはPNG以外の形式になっています"."<br>";
                        $list[5] = $validation_error;
                        return $list;
                    } 
                }

        
        }


// 表示・非表示の関数➀
// ローカル変数使用するのでreturnと複数返り値の対処でarray使用して、関数外でも使用できるようにした。
        function func_public_flg($row_public_flg){

                    if($row_public_flg === "1"){
                       $display = "表示する";
                       $color = "gray";
                       $img_display = "hidden";

                       return array($display,$color,$img_display);
    
                    } else {
                        $display = "非表示にする";
                        $color = "white";
                        $img_display = "visible";

                        return array($display,$color,$img_display);
    
                    }
        }


// 表示・非表示の関数➁
        function func_btn($btn){

            $number = htmlspecialchars($_POST["id_value"], ENT_QUOTES, 'UTF-8');
            $db = func_db_open();
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);


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

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){
            
                    
                    $validation_input_data =$_POST['input_data'];
                    $validation_upload_image = $_FILES['upload_image']['name'];
                    $validation_tmp_name = $_FILES['upload_image']['tmp_name'];

                    $list = validation_func($validation_input_data,$validation_upload_image,$validation_tmp_name,$input_data,$image_path);
                    // $list[0] = ;
                    // $list[1] = ;
                    var_dump(($list));
                    $list[2] = $upload_image_tmp_name;
                    $list[3] = $input_data;
                    $list[4] = $image_path;
                    $list[5] = $validation_error;

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
        $db = func_db_open();
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

                    $flag = func_public_flg($row_public_flg);
                    $display = $flag[0];
                    $color =  $flag[1];
                    $img_display =  $flag[2];

                    // define("DISPLAY","$flag[0]");にすると反応しなくなるのはなぜ？

 
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
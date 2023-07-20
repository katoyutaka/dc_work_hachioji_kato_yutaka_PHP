
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



<?php

    require_once("work39_1_model.php");   

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


        include_once("work39_1_view.php");
?>


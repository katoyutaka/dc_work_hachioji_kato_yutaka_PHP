
<?php

    require_once '../include/config/config.php';

    function get_connect(){
        try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }
        return $db;
    }


    function control_page_validation(){

        if(!empty($_POST['product_name'])){
            $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
        } else {
            $validation_error[]="商品名が未入力です"."<br>";
        }

        if(!empty($_POST['category'])){
            $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');

            if (!($category === "ring" || $category === "necklace" )) {
                $validation_error[] = "カテゴリが「ring」または「necklace」以外になっています"."<br>";
            }

        } else {
            $validation_error[]="カテゴリが未入力です"."<br>";
        }

        
        if(!empty($_POST['price'])){
            $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');

            if(!preg_match("/^([1-9][0-9]*|0)$/", $price)){
                $validation_error[] = "「価格」が0以上の整数以外の形式になっています"."<br>";
            }

        } else {
            $validation_error[]="価格が未入力です"."<br>";
        }


        if(!empty($_POST['stock_count'])){
            $stock_count = htmlspecialchars($_POST['stock_count'], ENT_QUOTES, 'UTF-8');

            if(!preg_match("/^([1-9][0-9]*|0)$/", $stock_count)){
                $validation_error[] = "「個数」が0以上の整数以外の形式になっています"."<br>";
            }

        } else {
            $validation_error[]="個数が未入力です"."<br>";
        }

        
        if(!empty($_FILES['product_image']['name'])){
            $product_image = htmlspecialchars($_FILES['product_image']['name'], ENT_QUOTES, 'UTF-8');
            $image_path =  'img/'.htmlspecialchars($_FILES['product_image']['name'], ENT_QUOTES, 'UTF-8');


        } else {
            $validation_error[]="画像が未選択です"."<br>";
        }


        if(isset($_FILES['product_image']['tmp_name'])){
            $product_image_tmp_name = htmlspecialchars($_FILES['product_image']['tmp_name'], ENT_QUOTES, 'UTF-8');
        }
        

        $file=pathinfo($image_path);
        $filetype=$file["extension"];
            
        if (!($filetype === "jpeg" || $filetype === "png" || $filetype === "jpg")) {
            $validation_error[] = "拡張子がJPEG,PNG,JPG以外の形式になっています"."<br>";
        }



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
    
    
        return array($product_name,$category,$price,$stock_count,$product_image,$image_path,$product_image_tmp_name,$public_flg,$cg_public_flg,$validation_error);
    }
        


    function control_page_insert(){

        $db = get_connect();
        global $product_name;
        global $category;
        global $price;
        global $cg_public_flg;
        global $create_date;
        global $update_date;
        global $image_path;
        global $product_image;
        global $product_image_tmp_name;
        global $stock_count;

        //➀個数（在庫数）以外の情報は別のテーブル（ec_product_table）に挿入。
        $insert = "INSERT INTO ec_product_table (product_name,category, price,public_flg, create_date, update_date,image_path) VALUES (:product_name,:category,:price,:cg_public_flg,:create_date,:update_date,:image_path);";
        $stmt = $db -> prepare($insert);
        $stmt->bindValue(":product_name",$product_name);
        $stmt->bindValue(":category",$category);
        $stmt->bindValue(":price",$price);
        $stmt->bindValue(":cg_public_flg",$cg_public_flg);
        $stmt->bindValue(":create_date",$create_date);
        $stmt->bindValue(":update_date",$update_date);
        $stmt->bindValue(":image_path",$image_path);

        $stmt->execute();
    
        $result = $stmt->fetch();
        $save = 'ec_site/img/'.basename($product_image);
        move_uploaded_file($product_image_tmp_name,$save);

        //lastInsertId()関数は直前のやつのIDを持ってくる関数！！
        $product_id = $db->lastInsertId();
        $insert= "INSERT INTO ec_stock_table (product_id,stock_count,create_date, update_date) VALUES (:product_id,:stock_count,:create_date,:update_date);";
        
        $stmt = $db -> prepare($insert);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->bindValue(":stock_count",$stock_count);
        $stmt->bindValue(":create_date",$create_date);
        $stmt->bindValue(":update_date",$update_date);
    
        return array($product_name,$result,$stmt);
    }

     

    function public_flg_button(){

        $db = get_connect();
        global $number;
        global $update_date;

        if($_POST["public_flg_button"] === "公開にする"){

            $update = "UPDATE ec_product_table SET public_flg = '1' WHERE product_id =:product_id_number;";
            $stmt = $db -> prepare($update);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->execute();

            $update = "UPDATE ec_product_table SET update_date = :update_date WHERE product_id = :product_id_number;";

            $stmt = $db -> prepare($update);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->bindValue(":update_date",$update_date);
            $stmt->execute();

            //何の商品を公開にしたのか知るために以下の商品名を取ってくるコードも記載。
            $select = "SELECT * FROM  ec_product_table WHERE product_id = :product_id_number;";
            $stmt = $db -> prepare($select);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->execute();

            $row2 =$stmt->fetch();
            $update_message[]= "『".$row2["product_name"]."』を公開に変更しました"."<br>";

        }else{
            
            $update = "UPDATE ec_product_table SET public_flg = '0' WHERE product_id = :product_id_number;";
            $stmt = $db -> prepare($update);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->execute();

            $update = "UPDATE ec_product_table SET update_date = :update_date WHERE product_id = :product_id_number;";
            $stmt = $db -> prepare($update);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->bindValue(":update_date",$update_date);
            $stmt->execute();


            //何の商品を非公開にしたのか知るために以下の商品名を取ってくるコードも記載。
            // $select = "SELECT * FROM  ec_product_table WHERE product_id = '$number';";
            $select = "SELECT * FROM  ec_product_table WHERE product_id = :product_id_number;";
            $stmt = $db -> prepare($select);
            $stmt->bindValue(":product_id_number",$number);
            $stmt->execute();

            $row2 =$stmt->fetch();
            $update_message[]= "『".$row2["product_name"]."』を非公開に変更しました"."<br>";

        }
        
        
        return $update_message;
    }



    function control_page_delete_button(){

        $db = get_connect();
        $delete_number = htmlspecialchars($_POST["delete_id_value"], ENT_QUOTES, 'UTF-8');

        //何の商品を削除したのか知るために以下の商品名を取ってくるコードも記載。
        $select = "SELECT product_name FROM  ec_product_table WHERE product_id = :delete_number;";
        $stmt = $db -> prepare($select);
        $stmt->bindValue(":delete_number",$delete_number);
        $stmt->execute();
        $row2 = $stmt->fetch();


        $delete = "DELETE FROM ec_product_table WHERE ec_product_table.product_id = :delete_number;";
        $stmt = $db -> prepare($delete);
        $stmt->bindValue(":delete_number",$delete_number);
        $stmt->execute();


        $delete = "DELETE FROM ec_stock_table WHERE ec_stock_table.product_id = :delete_number;";
        $stmt = $db -> prepare($delete);
        $stmt->bindValue(":delete_number",$delete_number);
        $stmt->execute();

        $update_message[]= "『".$row2["product_name"]."』を削除しました"."<br>";

        return $update_message;

    }


    function control_page_count_button(){

        $db = get_connect();


        if(isset($_POST["count_text"])){
            $count_button_number = htmlspecialchars($_POST["count_id_value"], ENT_QUOTES, 'UTF-8');
            $count_text = htmlspecialchars($_POST["count_text"], ENT_QUOTES, 'UTF-8');
            $update_date = date('Ymd');

            //何の商品の在庫数を変更したのか知るために以下の商品名を取ってくるコードも記載。
            $sql= " SELECT *FROM ec_product_table JOIN ec_stock_table ON ec_product_table.product_id = ec_stock_table.product_id WHERE stock_id = :count_button_number;";
            
            $stmt = $db -> prepare($sql);

            $stmt->bindValue(":count_button_number",$count_button_number);
            $stmt->execute();
            $row2 = $stmt->fetch();

            if(($_POST["count_text"])===""){
            
                $update_message[]= "『".$row2["product_name"]."』の「在庫数」が未入力です"."<br>";

            }else if(!preg_match("/^([1-9][0-9]*|0)$/", $count_text)){
                
                $update_message[] = "『".$row2["product_name"]."』の「在庫数」が0以上の整数以外の形式になっています"."<br>";

            }else if($count_text === $row2["stock_count"]){

                //変更する在庫数とデータベースに登録されている在庫数が同じであるときは、変更できないとメッセージを表示する。

                $update_message[]= "『".$row2["product_name"]."』の在庫数に変更がないため更新できません"."<br>";

            }else{

                $update = "UPDATE ec_stock_table SET stock_count = :count_text WHERE stock_id = :count_button_number;";
                $stmt = $db -> prepare($update);
                $stmt->bindValue(":count_button_number",$count_button_number);
                $stmt->bindValue(":count_text",$count_text);
                $stmt->execute();

                $update = "UPDATE ec_stock_table SET update_date = :update_date WHERE stock_id = :count_button_number;";
                $stmt = $db -> prepare($update);
                $stmt->bindValue(":count_button_number",$count_button_number);
                $stmt->bindValue(":update_date",$update_date);
                $stmt->execute();
                $update_message[]= "『".$row2["product_name"]."』の在庫数を変更しました"."<br>";

                // プラチナピンキーリング
            }
            
        }

        return $update_message;
    }

?>


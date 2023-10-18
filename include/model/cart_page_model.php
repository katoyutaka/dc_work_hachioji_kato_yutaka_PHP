

<?php
    //何故かconfig.phpに以下の関数(function get_connect)を持ってくるとエラーになる。なぜ？
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


        function delete_func(){

            $db = get_connect();

            $delete_number = htmlspecialchars($_POST["delete_id_value"], ENT_QUOTES, 'UTF-8');
            $delete_cart_id_number = htmlspecialchars($_POST["delete_cart_id_value"], ENT_QUOTES, 'UTF-8');

            //何の商品を削除したのか知るために以下の商品名を取ってくるコードも記載。
            $select = "SELECT product_name FROM  ec_product_table WHERE product_id = :product_id;";
            $stmt = $db->prepare($select);
            $stmt->bindValue(":product_id",$delete_number);
            $stmt->execute();
            $result = $stmt->fetch();
            
            $delete = "DELETE FROM ec_cart_table WHERE cart_id = :cart_id;";
            $stmt = $db->prepare($delete);
            $stmt->bindValue(":cart_id",$delete_cart_id_number);
            $stmt->execute();

            $update_message[]= "『".$result["product_name"]."』を削除しました"."<br>";

            return array($delete_number,$delete_cart_id_number,$update_message);
        }

        
        function update_func(){

            $db = get_connect();

            $product_count_id_number = htmlspecialchars($_POST["product_count_id_value"], ENT_QUOTES, 'UTF-8');
            $text_product_count_number = htmlspecialchars($_POST["text_product_count"], ENT_QUOTES, 'UTF-8');

            $update_date = date('Ymd');

            //何の商品を変更したのか知るために以下の商品名を取ってくるコードも記載。
            $select = "SELECT product_name FROM  ec_product_table WHERE product_id = :product_id;";

            $stmt = $db->prepare($select);
            $stmt->bindValue(":product_id",$product_count_id_number);
            $stmt->execute();
            $row5 = $stmt->fetch();


            $update = "UPDATE ec_cart_table SET product_count = :product_count WHERE product_id = :product_id;";
            $stmt = $db->prepare($update);
            $stmt->bindValue(":product_count",$text_product_count_number);
            $stmt->bindValue(":product_id",$product_count_id_number);

            $stmt->execute();

            $update = "UPDATE ec_cart_table SET update_date = :update_date WHERE product_id = :product_id;";
            $stmt = $db->prepare($update);
            $stmt->bindValue(":update_date",$update_date);
            $stmt->bindValue(":product_id",$product_count_id_number);
            $stmt->execute();

            $update_message[]= "『".$row5["product_name"]."』の個数を変更しました"."<br>";

            return array($product_count_id_number,$text_product_count_number,$update_date,$update_message);
        }
                

?>


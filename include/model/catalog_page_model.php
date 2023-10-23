

<?php

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


    
    function catalog_page_buy_button(){

        $db = get_connect();

        $product_id = htmlspecialchars($_POST["count_id_value"], ENT_QUOTES, 'UTF-8');
        $product_count = htmlspecialchars($_POST["product_count_value"], ENT_QUOTES, 'UTF-8');

        $login_user_name = $_SESSION["login_user_name"];

        $create_date = date('Ymd');
        $update_date = date('Ymd');

        
        $sql =  " SELECT * FROM ec_cart_table WHERE product_id = :product_id";
        $stmt = $db -> prepare($sql);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->execute();
        $row4 = $stmt->fetch();

        return array($product_id,$product_count,$login_user_name,$create_date, $update_date,$stmt,$row4);

    }


    function insert_func1(){

        $login_user_name = $_SESSION["login_user_name"];
        $db = get_connect();

        $sql =  " SELECT * FROM ec_user_table WHERE user_name = :user_name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":user_name",$login_user_name);
        $stmt->execute();
        $row = $stmt->fetch();
        $user_id = $row["user_id"];

        global $product_id;
        global $product_count;
        global $create_date;
        global $update_date;
            

        //新規にデータベースにカートに入れた情報を挿入
        $insert = "INSERT INTO ec_cart_table (user_id,product_id,product_count,create_date, update_date) VALUES (:user_id,:product_id,:product_count,:create_date,:update_date);";
        $stmt = $db -> prepare($insert);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->bindValue(":product_count",$product_count);
        $stmt->bindValue(":create_date",$create_date);
        $stmt->bindValue(":update_date",$update_date);
        $stmt->execute();

        $sql =  " SELECT * FROM ec_product_table WHERE product_id = :product_id";
        $stmt = $db -> prepare($sql);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->execute();
        $row3 = $stmt->fetch();
        $message[]=  "『". $row3["product_name"]."』の商品は正常にカートに追加されました";

        return array($message);
    }


    function insert_func2(){

        global $row4;
        global $product_id;
        global $product_count;

        $db = get_connect();
        $product_count =$row4["product_count"]+1;

        $update = "UPDATE ec_cart_table SET product_count = :product_count WHERE product_id = :product_id;";
        $stmt = $db -> prepare($update);
        $stmt->bindValue(":product_count",$product_count);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->execute();

        $sql =  " SELECT * FROM ec_product_table WHERE product_id =  :product_id ";
        $stmt = $db -> prepare($sql);
        $stmt->bindValue(":product_id",$product_id);
        $stmt->execute();
        $row3 = $stmt->fetch();
        $message[]=  "『". $row3['product_name']."』の商品は正常にカートに追加されました";
                            
        return array($message);
    }


    function logout_delete_cart(){
        $db = get_connect();
        $delete ="DELETE FROM ec_cart_table;";
        $db->query($delete);
    }
        

            
?>


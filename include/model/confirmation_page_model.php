
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


    function update_stock_count(){

        $db = get_connect();
        global $new_stock_count;
        global $row;

        $update = "UPDATE ec_stock_table SET stock_count = :new_stock_count  WHERE product_id = :product_id;";
        $stmt = $db -> prepare($update);
        $stmt->bindValue(":new_stock_count",$new_stock_count);
        $stmt->bindValue(":product_id",$row["product_id"] );
        $stmt->execute();

        $update_date = date('Ymd');
        $update = "UPDATE ec_stock_table SET update_date =:update_date WHERE product_id = :product_id;";
        $stmt = $db -> prepare($update);
        $stmt->bindValue(":update_date",$update_date);
        $stmt->bindValue(":product_id",$row["product_id"]);
        $stmt->execute();

    }
 

    function delete_cart(){
        $db = get_connect();
        $delete ="DELETE FROM ec_cart_table;";
        $db->query($delete);
    }



      


?>

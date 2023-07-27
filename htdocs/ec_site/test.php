
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


$sql = "SELECT * FROM ec_cart_table JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id LEFT JOIN ec_stock_table ON ec_stock_table.product_id = ec_product_table.product_id;";
if ($result = $db->query($sql)) {

    while ($row = $result->fetch()) {

        $new_stock_count = $row["stock_count"] - $row["product_count"];

        
        print $new_stock_count."<br>";
        print $row["product_id"]."<br><br>";

        if($row["stock_count"] - $row["product_count"]<0){
            print "在庫数が足りないため購入できません";
        }else{
            $update = "UPDATE ec_stock_table SET stock_count =".$new_stock_count." WHERE product_id =".$row["product_id"].";";
            $db->query($update);

        }

    }
}



// $sql = "SELECT * FROM ec_cart_table 
//         JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id 
//         LEFT JOIN ec_stock_table ON ec_stock_table.product_id = ec_product_table.product_id;";

// if ($result = $db->query($sql)) {
//     while ($row = $result->fetch()) {
//         $new_stock_count = $row["stock_count"] - $row["product_count"];
//         $product_id = $row["product_id"];

//         print $new_stock_count."<br>";
//         print $product_id."<br><br>";

//         // UPDATE文を生成して実行
//         $update = "UPDATE ec_stock_table SET stock_count =" . $new_stock_count . " WHERE product_id =" . $product_id;
//         $db->query($update);

//         // エラー処理（任意の処理を追加）

//     }
// }

?>



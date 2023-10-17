

<?php

    require_once '../include/config/config.php';

   if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST["delete_button"])){

                function sql_func(){

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

                $sql_func = array();
                $sql_func = sql_func();

                $delete_number = $sql_func[0];
                $delete_cart_id_number  = $sql_func[1];
                $update_message  = $sql_func[2];

            }

            
            

            if(isset($_POST["reverse-button"])){
                header('Location:catalog_page.php');
                exit();
            }

            if(isset($_POST["next-button"])){
                header('Location:address_page.php');
                exit();
            }


            
            if(isset($_POST["logout_tag"])){  
                  //ログアウトが押されたら、セッションのみを消してクッキーは消さず、index.phpに遷移する。
                $_SESSION=[];
                session_destroy();

                header('Location:index.php');
                exit();
            }



            if(isset($_POST["cart_tag"])){
                header('Location:cart_page.php');
                exit();

            
            }


            if(isset($_POST["favorite_tag"])){
                // header('Location:index.php');
                // exit();
    
             }
    
             if(isset($_POST["mypage_tag"])){
                // header('Location:index.php');
                // exit();
    
             }

             if(isset($_POST["product_count_button"])){
                
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

            }

            
    
    }

             
    

    //ログアウトであれば、catalog_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }




?>


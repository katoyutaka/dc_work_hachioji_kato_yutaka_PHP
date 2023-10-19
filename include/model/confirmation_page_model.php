
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


    $login_user_name = $_SESSION["login_user_name"];

    //注文者情報
    $input_user_name_form = $_SESSION["input_user_name_form"];
    $input_hiragana_form=  $_SESSION["input_hiragana_form"];
    $input_birthday_form = $_SESSION["input_birthday_form"];
    $input_address_form = $_SESSION["input_address_form"];
    $input_phone_number_form = $_SESSION["input_phone_number_form"];
    $input_mail_address_form = $_SESSION["input_mail_address_form"];


    //支払い方法
    $input_card_number_form = $_SESSION["input_card_number_form"];
    $input_security_number_form = $_SESSION["input_security_number_form"];
    $expiration_date_month = $_SESSION["expiration_date_month"];
    $expiration_date_year = $_SESSION["expiration_date_year"];
    $payment_method_button = $_SESSION["payment_method_button"];
    $select_conveni=  $_SESSION["select_conveni"];
    $smartphone_payment_method_button = $_SESSION["smartphone_payment_method_button"];

    //その他
    $to="$input_mail_address_form";
    $subject="【72Sec Jewerly Homme+】ご注文内容の確認";
    $message="この度は72Sec Jewelry Homme+ Online Shoppingをご利用いただき有難う御座います。発送までしばしお待ちください。";
    $headers="";



   if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["reverse-button"])){
            header('Location:payment_page.php');
            exit();
        }

        //注文確定ボタンで、「在庫数のデータベース変更」と「カートのデータベース変更」をする。
        if(isset($_POST["order-button"])){

            
            $db->beginTransaction();

            //ここは変数がないのでプリペアードステートメントやらない。
            $sql = "SELECT * FROM ec_cart_table JOIN ec_product_table ON ec_cart_table.product_id = ec_product_table.product_id LEFT JOIN ec_stock_table ON ec_stock_table.product_id = ec_product_table.product_id;";
            if ($result = $db->query($sql)) {
                $commitTransaction = true; // ロールバックを行うかどうかを判断するフラグ
                
                while ($row = $result->fetch()) {
                    $new_stock_count = $row["stock_count"] - $row["product_count"];

                    if ($new_stock_count < 0) {
                        $str = "在庫数が足りないため購入できません";
                        $commitTransaction = false; // フラグをfalseにしてロールバックを指示
                        break;
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

                        // return array();
                    }

                    // $update_stock_count = array();
                    // $update_stock_count = update_stock_count();
                }

                if ($commitTransaction) {
                    $db->commit();

                    $delete ="DELETE FROM ec_cart_table;";
                    $db->query($delete);

                    mail($input_mail_address_form,$subject,$message,$headers);

                    header('Location:complete_page.php');
                    exit();
                    
                } else {
                    $db->rollback();
                }
            }

            
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

}
   


       //ログアウトであれば、confirmation_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }
?>

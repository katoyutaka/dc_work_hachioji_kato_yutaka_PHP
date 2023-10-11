

<?php

    require_once '../include/config/config.php';

    $login_user_name = $_SESSION["login_user_name"];
    $sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

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


         if(isset($_POST["buy_button"])){
            $product_id = htmlspecialchars($_POST["count_id_value"], ENT_QUOTES, 'UTF-8');
            $product_count = htmlspecialchars($_POST["product_count_value"], ENT_QUOTES, 'UTF-8');

            $login_user_name = $_SESSION["login_user_name"];

            $create_date = date('Ymd');
            $update_date = date('Ymd');

            

            $sql =  " SELECT * FROM ec_cart_table WHERE product_id = '$product_id'";
            if($result = $db->query($sql)){
                $row4 =$result->fetch();

                //指定商品がすでにDBのショッピングカート情報を保存するテーブルに保存されている時、DBの数量をDBの数量＋１に更新する。
                if($row4["product_id"]==""){
                    
                        $sql =  " SELECT * FROM ec_user_table WHERE user_name = '$login_user_name'";
                        if($result = $db->query($sql)){
                            $row =$result->fetch();
                            $user_id = $row["user_id"];
                            
                        }

                        //新規にデータベースにカートに入れた情報を挿入
                        $insert = "INSERT INTO ec_cart_table (user_id,product_id,product_count,create_date, update_date) VALUES ('$user_id','$product_id','$product_count','$create_date','$update_date');";

                        if($result=$db->query($insert)){

                            $sql =  " SELECT * FROM ec_product_table WHERE product_id = '$product_id'";
                            if($result = $db->query($sql)){
                                $row3 =$result->fetch();

                                $message[]=  "『". $row3["product_name"]."』の商品は正常にカートに追加されました";

                            }
                            
                        }

                }else{  
                        $product_count =$row4["product_count"]+1;
 
                        $update = "UPDATE ec_cart_table SET product_count = '$product_count' WHERE product_id = '$product_id';";
                        $result = $db->query($update);

                        $sql =  " SELECT * FROM ec_product_table WHERE product_id = '$product_id'";
                            if($result = $db->query($sql)){
                                $row3 =$result->fetch();
                    
                                $message[]=  "『". $row3['product_name']."』の商品は正常にカートに追加されました";
                               
                            }
                }
                
                
            }


            


            

          
         }

        


    }



    //ログアウトであれば、catalog_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }
                
?>

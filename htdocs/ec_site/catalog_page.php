<?php
    
    require_once '../include/config/config.php';
    require_once '../../include/model/catalog_page_model.php';
    

    $login_user_name = $_SESSION["login_user_name"];
    $sign_up_password_1 = $_SESSION["sign_up_password_1"];


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["logout_tag"])){  
             //ログアウトが押されたら、セッションのみを消してクッキーは消さず、index.phpに遷移する。
            $_SESSION=[];
            session_destroy();

            logout_delete_cart();

            
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


            $catalog_page_buy_button = array();
            $catalog_page_buy_button = catalog_page_buy_button();

            $product_id       = $catalog_page_buy_button[0];
            $product_count    = $catalog_page_buy_button[1];
            $login_user_name  = $catalog_page_buy_button[2];
            $create_date      = $catalog_page_buy_button[3];
            $update_date      = $catalog_page_buy_button[4];
            $stmt             = $catalog_page_buy_button[5];
            $row4             = $catalog_page_buy_button[6];



            //指定商品がすでにDBのショッピングカート情報を保存するテーブルに保存されている時、DBの数量をDBの数量＋１に更新する。
            if($row4["product_id"]==""){
  
               $insert_func1 = array();
               $insert_func1 = insert_func1();

               $message = $insert_func1[0];


            }else{  

                $insert_func2 = array();
                $insert_func2 = insert_func2();
 
                $message = $insert_func2[0];

            }
        }
    
    }


    //ログアウトであれば、catalog_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }
       
    
    include_once '../../include/view/catalog_page_view.php';

?>

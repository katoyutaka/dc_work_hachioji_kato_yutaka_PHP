
<?php

    require_once '../include/config/config.php';

    require_once '../../include/model/cart_page_model.php';


    if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST["delete_button"])){

                $delete_func = array();
                $delete_func = delete_func();

                $delete_number = $delete_func[0];
                $delete_cart_id_number  = $delete_func[1];
                $update_message  = $delete_func[2];

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

                $update_func = array();
                $update_func = update_func();

                $product_count_id_number = $update_func[0];
                $text_product_count_number = $update_func[1];
                $update_date = $update_func[2];
                $update_message = $update_func[3];

            }

    }

            

    //ログアウトであれば、catalog_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }

    
    include_once '../../include/view/cart_page_view.php';

?>

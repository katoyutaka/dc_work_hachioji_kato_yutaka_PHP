<?php

 
    require_once '../../include/model/control_page_model.php';

    $ok_login_user_name = $_SESSION["login_user_name"];
    $ok_sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["submit"])){
        
            $control_page_validation = array();
            $control_page_validation = control_page_validation();

            $product_name            = $control_page_validation[0];
            $category                = $control_page_validation[1];
            $price                   = $control_page_validation[2];
            $stock_count             = $control_page_validation[3];
            $product_image           = $control_page_validation[4];
            $image_path              = $control_page_validation[5];
            $product_image_tmp_name  = $control_page_validation[6];
            $public_flg              = $control_page_validation[7];
            $cg_public_flg           = $control_page_validation[8];
            $validation_error        = $control_page_validation[9];



            // バリデーションチェックOKならSQL文(insert文)送る
                    
            if (empty($validation_error) ){

                    $create_date = date('Ymd');
                    $update_date = date('Ymd');


                    $control_page_insert = array();
                    $control_page_insert = control_page_insert();

                    $product_name = $control_page_insert[0];
                    $result = $control_page_insert[1];
                    $stmt = $control_page_insert[2];

                    if($stmt->execute()){
                        $str ="『".$product_name."』の商品登録が完了しました";
                    
                    } else {
                        $str = "登録失敗しました。"."<br>";
                    
                    }
            }

        }


        if(isset($_POST["public_flg_button"])){
            $number = htmlspecialchars($_POST["id_value"], ENT_QUOTES, 'UTF-8');
            $update_date = date('Ymd');
            $update_message = public_flg_button();
         }


         if(isset($_POST["delete_button"])){
           $update_message = control_page_delete_button();
         }


    
         if(isset($_POST["count_button"])){
            $update_message = control_page_count_button();
         }


         if(isset($_POST["logout_button"])){
            //ログアウトが押されたら、セッションとクッキーを空にして、index.phpに遷移する。

            $ok_login_user_name ="";
            $ok_sign_up_password_1="";
            
            $_SESSION=[];
            session_destroy();

            setcookie("user_check","",time()-100);
            setcookie("login_user_name","",time()-100);  
            setcookie("sign_up_password_1","",time()-100);  

            header('Location:index.php');
            exit();
         }

    }

    //ログアウトであれば、control_page.phpに来ても、index.phpに遷移するようにする。
    if (empty($_SESSION['login_user_name'])) {
        header('Location:index.php');
        exit(); 
    }


    
    include_once '../../include/view/control_page_view.php';

?>

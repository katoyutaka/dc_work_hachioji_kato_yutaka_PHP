

<?php
    require_once '../../include/model/index_model.php';

    $user_check="";
    $ok_login_user_name="";
    $login_user_name="";
    $sign_up_password_1="";
    $ok_sign_up_password_1="";


    $validation_error1 =array();
    $validation_error2 =array();


    //クッキーのデータ保存
    if(isset($_COOKIE["user_check"])){
        $cookie_user_check = "checked";
    } else {
        $cookie_user_check = "";
    }


    if(isset($_COOKIE["login_user_name"])){
        $cookie_login_user_name = $_COOKIE["login_user_name"];
    } else {
        $cookie_login_user_name = "";
    }



    if(isset($_COOKIE["sign_up_password_1"])){
        $cookie_sign_up_password_1 = $_COOKIE["sign_up_password_1"];
    } else {
        $cookie_sign_up_password_1 = "";
    }



    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["user_check"])){
            $user_check = htmlspecialchars($_POST['user_check'], ENT_QUOTES, 'UTF-8');
            
        }else{
            $user_check="";

        }

        
        $index_validation= array();
        $index_validation = index_validation();


        $login_user_name        = $index_validation[0];
        $validation_error1      = $index_validation[1];
        $ok_login_user_name     = $index_validation[2];
        $sign_up_password_1     = $index_validation[3];
        $validation_error2      = $index_validation[4];
        $ok_sign_up_password_1  = $index_validation[5];
        


        //「ログイン」が押されたときの処理
        if((isset($_POST["login_button"]))){

            //IDとパスワード共にec_adminの時は、商品管理ページへ行く
            if(($ok_login_user_name === "ec_admin") && ($ok_sign_up_password_1 === "ec_admin")){
   
                //セッションの話
                $_SESSION["login_user_name"]= $ok_login_user_name;
                $_SESSION["sign_up_password_1"] = $ok_sign_up_password_1;

                header('Location:control_page.php');
                exit();
            }

            //バリデーションチェックでOKならばデータ接続
            if ((empty($validation_error1)) && (empty($validation_error2))){


                $final_password = select_user_name();


                if($final_password === $ok_sign_up_password_1){

                        //「チェック」が入っていたらクッキー保存する
                        if($user_check==="checked"){
                            //クッキーの話
                            setcookie("user_check",$user_check,$cookie_expiration);
                            setcookie("login_user_name",$login_user_name,$cookie_expiration);  
                            setcookie("sign_up_password_1",$sign_up_password_1,$cookie_expiration);

                                                        
                        } else{
                            setcookie("login_user_name","",time()-220);  
                            setcookie("sign_up_password_1","",time()-220);
                        }

                        //セッションの話
                        $_SESSION["login_user_name"]= $ok_login_user_name;
                        $_SESSION["sign_up_password_1"] = $ok_sign_up_password_1;


                        //↓はショッピングサイト内へ行く
                        header('Location:catalog_page.php');
                        exit();

                } else {
                    $str = "ユーザー名またはパスワードが一致しません";

                    //ここでクッキーに入れた失敗したログイン情報を消す。

                    setcookie("user_check","",time()-220);
                    setcookie("login_user_name","",time()-220);  
                    setcookie("sign_up_password_1","",time()-220);
                    
                }
            }          

        
        } else{
                //ここでクッキーに入れた失敗したログイン情報を消す。

                setcookie("user_check","",time()-220);
                setcookie("login_user_name","",time()-220);  
                setcookie("sign_up_password_1","",time()-220);
                
        }
        

        if(isset($_POST["sign_up_button"])){
            header('Location:membership_terms.php');
            exit();
        }

    }

    
    //ログイン中であれば、catalog_page.phpに遷移させ、index.phpには行かないようにする。
    if (isset($_SESSION['login_user_name'])) {
        header('Location:catalog_page.php');
        exit(); 
    }


    
    include_once '../../include/view/index_view.php';

?>



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


    //バリデーションチェック
    function payment_page_validation(){


            if(($_POST["payment_method_button"])==="クレジットカード"){
                
                    if(isset($_POST["input_card_number_form"])){
                        if(empty($_POST['input_card_number_form'])){
                            $validation_error1[] = "カード番号が未入力です";
            
                        } elseif (preg_match("/^[0-9]{16}+$/",$_POST["input_card_number_form"])) {
                            $input_card_number_form="";
                            $input_card_number_form = htmlspecialchars($_POST['input_card_number_form'], ENT_QUOTES, 'UTF-8');
                            
                        } else{
                            $validation_error1[] = "半角数字16桁の形式で入力されていません";    
                        }
                    }



                    if(isset($_POST["input_security_number_form"])){
                        if(empty($_POST["input_security_number_form"])){
                            $validation_error2[] = "セキュリティコードが未入力です";

                        } elseif((preg_match("/^[0-9]{3}+$/",$_POST["input_security_number_form"])) ||(preg_match("/^[0-9]{4}+$/",$_POST["input_security_number_form"]))){
                            $input_security_number_form="";
                            $input_security_number_form= htmlspecialchars($_POST["input_security_number_form"], ENT_QUOTES, 'UTF-8');
                            
                        } else{
                            $validation_error2[] = "半角数字3桁または4桁の形式で入力されていません";       
                        }
                    }


                    if(isset($_POST["expiration_date_month"])){
                        if(empty($_POST["expiration_date_month"])){
                            $validation_error3[] = "有効期限の「月」が未入力です";

                        } else{
                            $expiration_date_month="";
                            $expiration_date_month= htmlspecialchars($_POST["expiration_date_month"], ENT_QUOTES, 'UTF-8');       
                        }
                    }


            
                    if(isset($_POST["expiration_date_year"])){
                        if(empty($_POST["expiration_date_year"])){
                            $validation_error4[] = "有効期限の「年」が未入力です";

                        } else{
                            $expiration_date_year="";
                            $expiration_date_year= htmlspecialchars($_POST["expiration_date_year"], ENT_QUOTES, 'UTF-8');       
                        }
                    }
            }




            if(($_POST["payment_method_button"])==="コンビニ"){
                if(empty($_POST["select_conveni"])){
                    $validation_error7[] = "支払い先のコンビニ名が未選択です";

                } else{
                    $expiration_date_year="";
                    $select_conveni= htmlspecialchars($_POST["select_conveni"], ENT_QUOTES, 'UTF-8');       
                }

            }


            if(($_POST["payment_method_button"])==="スマートフォン"){
                if((empty($_POST["smartphone_payment_method_button"]))){
                    $validation_error8[] = "支払い先のスマートフォンが未選択です";

                } else{
                    $smartphone_payment_method_button="";
                    $smartphone_payment_method_button= htmlspecialchars($_POST["smartphone_payment_method_button"], ENT_QUOTES, 'UTF-8');       
                }

            }


            if(($_POST["payment_method_button"])===NULL){
                $validation_error5[] = "お支払方法が選択されていません";

            } else{
                $payment_method_button="";
                $payment_method_button= htmlspecialchars($_POST["payment_method_button"], ENT_QUOTES, 'UTF-8');       
            }


            return array($input_card_number_form,$input_security_number_form,$expiration_date_month, $expiration_date_year,$select_conveni,$smartphone_payment_method_button,$payment_method_button,$validation_error1,$validation_error2,$validation_error3,$validation_error4,$validation_error5,$validation_error7,$validation_error8);

}


?>

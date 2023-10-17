

<?php

        //バリデーションチェックの関数
        function address_validation_func(){

                    //なぜ漢字の正規表現だけ逆の結果になるのか不明
                if(isset($_POST["input_user_name_form"])){
                    if(empty($_POST['input_user_name_form'])){
                        $validation_error1[] = "お名前が未入力です";

                    } elseif (preg_match( '/[^一-龠]/u',$_POST["input_user_name_form"])) {
                        
                        $validation_error1[] = "漢字形式で入力されていません";  
                        
                    } else{
                        $input_user_name_form = htmlspecialchars($_POST['input_user_name_form'], ENT_QUOTES, 'UTF-8');
                        
                    
                    }
                }

                if(isset($_POST["input_hiragana_form"])){
                    if(empty($_POST['input_hiragana_form'])){
                        $validation_error2[] = "ひらがなが未入力です";

                    } elseif (preg_match('/^[ぁ-ゞ]+$/u', $_POST['input_hiragana_form'])) {
                        $input_hiragana_form = htmlspecialchars($_POST['input_hiragana_form'], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error2[] = "ひらがな形式で入力されていません";     
                    }
                }


                if(isset($_POST["input_birthday_form"])){
                    if(empty($_POST["input_birthday_form"])){
                        $validation_error3[] = "生年月日が未入力です";

                    } elseif (preg_match( '/^[0-9]{8}+$/', $_POST["input_birthday_form"] )) {
                        $input_birthday_form = htmlspecialchars($_POST['input_birthday_form'], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error3[] = "半角数字８文字の形式で入力されていません";
                    }
                }


                if(isset($_POST["input_address_form"])){
                    if(empty($_POST["input_address_form"])){
                        $validation_error4[] = "住所が未入力ですが未入力です";

                    } else {
                        $input_address_form = htmlspecialchars($_POST["input_address_form"], ENT_QUOTES, 'UTF-8');
                        
                    } 
                }


                if(isset($_POST["input_phone_number_form"])){
                    if(empty($_POST["input_phone_number_form"])){
                        $validation_error5[] = "携帯電話番号が未入力です";

                    } elseif (preg_match( "/^0[7-9]0[0-9]{4}[0-9]{4}$/", $_POST["input_phone_number_form"] )) {
                        $input_phone_number_form = htmlspecialchars($_POST['input_phone_number_form'], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error5[] = "携帯電話番号の形式ではありません";
                    }
                }


                if(isset($_POST["input_mail_address_form"])){
                    if(empty($_POST["input_mail_address_form"])){
                        $validation_error6[] = "メールアドレスが未入力です";

                    } elseif (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $_POST["input_mail_address_form"] )) {
                        $input_mail_address_form = htmlspecialchars($_POST['input_mail_address_form'], ENT_QUOTES, 'UTF-8');
                        
                    } else{
                        $validation_error6[] = "メールアドレスの形式ではありません";
                    }
                }
                

            return array($input_user_name_form,$input_hiragana_form,$input_birthday_form,$input_address_form,$input_phone_number_form,$input_mail_address_form,$validation_error1,$validation_error2,$validation_error3,$validation_error4,$validation_error5,$validation_error6);
        }



?>


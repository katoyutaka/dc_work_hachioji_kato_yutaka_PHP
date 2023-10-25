
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お届け先情報入力</title>
    <style>
                html,
                body,
                ul,
                ol,
                li,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                p,
                div {
                    margin: 0;
                    padding: 0;
                }


                * {
                    box-sizing:border-box;
                    vertical-align:bottom;
                    font-family: system-ui;
                    letter-spacing: 2px;

                }

                .label_user{
                    /* text-align: left; */
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 50px;
                    line-height: 50px;
                    width: 1000px;
                    padding-left:30px;
                    margin-top: 30px;

                    
                }

                .main_wrapper{
                    width: 1000px;
                    margin:0 auto;
                }
                .text{
                    margin-left:50px;
                    margin-top:20px;
                }

                span{
                    font-size: 18px;
                    font-weight: bolder;

                }

                .label_user3{
                    font-size: 14px;
                    color:red;
                }

                .image_wrapper{
                        /* width: 1000px; */
                        height:80px;
                        margin:0 auto;
                    }

                .image{
                    width:330px;
                    float:right;
                }

                .input_wrapper{
                    width: 1000px;
                    margin-top: 20px;
                }


                .msg2{
                    color:red;
                    font-size: 16px;
                    font-weight: bold;
                }

                .next-button{
                        background-color: #000099;
                        color:white;
                        margin-left:10px;
                        transition: all 0.6s;
                        cursor: pointer;
                        float: right;
                }

                .reverse-button{
                    color:#000099;
                    transition: all 0.6s;
                    cursor: pointer;
                    float: left;
                }

                
                .button_container{
                        width:100%;
                        margin:0 auto;
                        margin-top:80px;
                        width:600px;
                        height: 60px;

                }

                .next-button,.reverse-button{
                        margin:0 auto;
                        width:250px;
                        height: 50px;
                        border-radius: 1px;
                        border: 1px solid #000099;
                        font-size:14px;
                        margin-right:10px;
                        
                }

                .text_product_count{
                    width: 35px;
                   
                }

                
                .input_user_name_form,.input_hiragana_form,.input_birthday_form,.input_address_form,.input_phone_number_form,.input_mail_address_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                }

                .input_user_name_form,.input_hiragana_form,.input_mail_address_form{
                    width: 400px;
                }

                .input_birthday_form,.input_phone_number_form{
                    width: 400px;
                }

                .input_address_form{
                    width: 800px;
                }


                .label{
                    font-weight: bolder;
                    width: 350px;
                }

                .input_form{
                    /* margin-top: 50px; */
                    display: flex;
                }

                .input_form2{
                    height: 80px;
                    /* background-color: #000099; */
                    margin-top: 10px;
                }

                .label_container{
                    text-align: left;
                    width: 350px;
                    height: 50px;
                    /* background-color: #000099; */
                }

                .example_label{
                    color:darkcyan;
                }


    </style>


    <?php
        include_once '../include/view/header.php';
    ?>

              

<form method="post" action="">
    <div class="main_wrapper">
        <div class="top_tag">
            <p>Delivery Address</p>

            <div class="image_wrapper">
                <img src='img/shopping2.png' class="image">
            </div>
        </div>
            
        <div class="label_user5"><span>お届け先情報入力</span><br><br>以下の項目をご入力いただき、「次へ」ボタンをクリックして下さい。</div>
        <div class="label_user">注文者情報</div>

            <div class="input_wrapper">

                    <div class="input_form2">

                    <?php
                        if(!empty($validation_error1)){
                            foreach($validation_error1 as $err1){
                                print "<span class='msg2'>$err1</span>";
                            }
                        }
                    ?>

                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">お名前（漢字）</p>
                                <p class="example_label">(例)山田太郎</p>
                            </div>
                            <input type="text" class="input_user_name_form" name="input_user_name_form">
                        </div>
                    </div>


                    <div class="input_form2">

                    <?php
                        if(!empty($validation_error2)){
                            foreach($validation_error2 as $err2){
                                print "<span class='msg2'>$err2</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">ひらがな</p>
                                <p class="example_label">(例)やまだたろう</p>
                            </div>
                            <input type="text" class="input_hiragana_form" name="input_hiragana_form">
                        </div>
                    </div>


                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error3)){
                            foreach($validation_error3 as $err3){
                                print "<span class='msg2'>$err3</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">生年月日（半角数字８文字）</p>
                                <p class="example_label">(例)20000303</p>
                            </div>
                            <input type="text" class="input_birthday_form" name="input_birthday_form">
                        </div>
                    </div>
                    

                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error4)){
                            foreach($validation_error4 as $err4){
                                print "<span class='msg2'>$err4</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">住所</p>
                            </div>
                            <input type="text" class="input_address_form" name="input_address_form">
                        </div>
                    </div>



                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error5)){
                            foreach($validation_error5 as $err5){
                                print "<span class='msg2'>$err5</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">携帯電話番号（ハイフンなしの半角数字）</p>
                                <p class="example_label">(例)07012345678</p>
                            </div>
                            <input type="text" class="input_phone_number_form" name="input_phone_number_form">
                        </div>
                    </div>



                    <div class="input_form2">
                    <?php
                        if(!empty($validation_error6)){
                            foreach($validation_error6 as $err6){
                                print "<span class='msg2'>$err6</span>";
                            }
                        }
                    ?>
                        <div class="input_form">
                            <div class="label_container">
                                <p class="label">メールアドレス</p>
                                <p class="example_label">(例)kyupi13@gmail.com</p>
                            </div>
                            <input type="text" class="input_mail_address_form" name="input_mail_address_form">
                        </div>
                    </div>

            </div>
                
    </div>

    <div class="button_container">
        <input type="submit" class="reverse-button" name="reverse-button" value="ひとつ前に戻る">
        <input type="submit" class="next-button"  name="next-button" value="お支払い入力へ">
    </div>
</form>

    
</body>
</html>


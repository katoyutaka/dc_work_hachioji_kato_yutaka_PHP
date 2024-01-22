<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規会員登録</title>
    
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
                    vertical-align: middle;
                }

                .header{
                    text-align: center;
                    background-color: #02235F;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    color:white;
                    font-weight:bold;
                    font-family:"Yu Mincho";
                    text-align: center;
                }

                

                .msg{
                    color:red;
                    font-weight: bolder;
                    height: 20px;
                    display: flex;
                    padding-left: 100px;
                }

                h2 {
                    margin-bottom: 40px;
                    text-align: center;
                }


                .sign_up_wrapper{
                    margin: 0 auto;
                    width:100%;
                    width:1000px;
                }

                .sign_up_text{
                    text-align: center;
                    margin-bottom: 40px;
                }

                .user_sign_up_wrapper{
                    width:1000px;
                    text-align:center;
                    border-top: 1px solid #b7b7b7;
                    margin:0 auto;
                
                }

                .label_user{
                    text-align: center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 40px;
                    line-height: 40px;
                    font-size: 16px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                    width: 1000px;
                    
                }

                .user_name_form,.password_name_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    width: 400px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                }

                .name_form_container{
                    display:flex;
                    width: 1000px;
                    padding-left: 100px;
                }

                .label_1{
                    display:flex;
                    height:35px;
                    line-height: 35px;
                    width:400px;
                }

                .label_2{
                    display:flex;
                    height:35px;
                    line-height: 35px;
                    width:400px;
                }

                .label_3{
                    display:flex;
                    height:35px;
                    line-height: 35px;
                    width:400px;
                }

                .main-container{
                    margin-top:5px;
                }

                .check-button,.reverse-button{
                    margin:0 auto;
                    width:250px;
                    height: 50px;
                    border-radius: 1px;
                    border: 1px solid #000099;
                    font-size:14px;
                    margin-right:10px;
                    
                }

                .check-button{
                    background-color: #000099;
                    color:white;
                    margin-left:10px;
                    cursor: pointer;
                }

                .reverse-button{
                    color:#000099;
                    cursor: pointer;
                }

                .button_container{
                    width:100%;
                    margin:0 auto;
                    margin-top:80px;

                }

                .sign_up_form{
                    width:700px;
                }

                .link_text{
                    float: right;
                }

                .image{
                    width:250px;
                    float:right;
                }

                .image_wrapper{
                    width: 1000px;
                    height:60px;
                    margin:0 auto;
                    margin-top: 10px;
                }

                .limit{
                    font-size: 15px;
                    opacity: 0.7;
                }

                .validation_error_area{
                    width: 1000px;
                    height: 30px;
                    margin: 0;
                    padding-top:10px;
                }


    </style>
              
</head>
<body>
    <p class="header">【MEN'S VERY 7月号掲載】2024 Summer Collection 発売中 </p>
    <div class="image_wrapper">
        <img src='img/status2.png' class="image">
    </div>

    <h2>New Customer 新規会員登録</h2>

        <div class="sign_up_wrapper">
            <div class="sign_up_text">
            <p>JEWERLY HOMME ONLINE SHOP 会員へのお申込みにあたっては、以下の項目にご入力が必要です。<br>下記の項目に入力の上、「確認する」ボタンを押して下さい。</p>
            </div> 
            <div>
               
            </div>  
            
            <div class="user_sign_up_wrapper">
                <div class="main-container">
                    <p class="label_user">お客様情報</p>

                    <form method="post" action="sign_up.php">

                        <div class="sign_up_form">

                            <div class= validation_error_area>
                                <?php
                                    if(!empty($validation_error1)){
                                        foreach($validation_error1 as $err1){
                                            print "<p class='msg'>$err1</p>";
                                        }
                                    }
                                ?>
                            </div>                            


                            <div class="name_form_container">
                                <p class="label_1">ユーザー名<span class="limit">（半角英数字で５文字以上）</span></p>
                                <input type="text" class="user_name_form" name="sign_up_user_name">
                            </div>

                            
                            <div class= validation_error_area>
                                <?php
                                    if(!empty($validation_error4)){
                                        foreach($validation_error4 as $err4){
                                            print "<p class='msg'>$err4</p>";
                                        }
                                    }
                                ?>
                            </div>


                            <div class= validation_error_area>
                                <?php
                                    if(!empty($validation_error2)){
                                        foreach($validation_error2 as $err2){
                                            print "<p class='msg'>$err2</p>";
                                        }
                                    }
                                ?>
                            </div>
                            
                            <div class="name_form_container">
                                <p class="label_2">パスワード<span class="limit">（半角英数字で８文字以上）</span></p>
                                <input type="password" class="password_name_form" name="sign_up_password_1" >
                            </div>



                            <div class= validation_error_area>
                                <?php
                                    if(!empty($validation_error3)){
                                        foreach($validation_error3 as $err3){
                                            print "<p class='msg'>$err3</p>";
                                        }
                                    }
                                ?>
                            </div>

                            <div class="name_form_container">
                                <p class="label_3">パスワード <span class="limit"> （再確認）</span></p>
                                <input type="password" class="password_name_form" name="sign_up_password_2">
                            </div>
                            
                        </div>

                        

                        <div class="button_container">
                            <input type="submit" class="reverse-button" name="reverse-button" value="戻る">
                            <input type="submit" class="check-button"  name="check-button" value="確認する">
                        </div>
                        <a href="index.php?" class="link_text">ログイン画面はこちらから</a>


                    
                    </form>   

                </div>

            </div>
        </div>

  

</body>
</html>
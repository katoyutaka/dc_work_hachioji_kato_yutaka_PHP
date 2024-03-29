
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>入力内容の確認</title>
        
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
                        font-family: system-ui;
                        letter-spacing: 2px;
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
                        letter-spacing: 0px;
                    }


                    .msg{
                        color:red;
                        font-weight: bolder;
                        height: 20px;
                        display: flex;
                        padding-left: 85px;
                    }

                    .label_user{
                        text-align: left;
                        font-size:18px;
                        font-weight:bold;
                        background-color: #eff6fc;
                        height: 40px;
                        line-height: 40px;
                        font-size: 16px;
                        width: 1000px;
                        padding-left:50px;
                        
                    }

                    .label_user2{
                        text-align: left;
                        font-size:18px;
                        font-weight:bold;
                        background-color: #eff6fc;
                        height: 40px;
                        line-height: 40px;
                        font-size: 16px;
                        width: 1000px;
                        padding-left:50px;
                        margin-top:20px;
                        
                    }

                    .main_wrapper{
                        width: 1000px;
                        margin:0 auto;
                    }

                    .text{
                        margin-left:50px;
                        margin-top:20px;
                    }

                    .confirm-button,.reverse-button{
                        margin:0 auto;
                        width:250px;
                        height: 50px;
                        border-radius: 1px;
                        border: 1px solid #000099;
                        font-size:14px;
                    }

                    .confirm-button{
                        background-color: #000099;
                        color:white;
                        margin-left:10px;
                        transition: all 0.6s;
                        cursor: pointer;
                        float:right;
                    }

                    .reverse-button{
                        color:#000099;
                        transition: all 0.6s;
                        cursor: pointer;
                        float:left;
                    }

                    .button_container{
                        width:100%;
                        margin:0 auto;
                        width:600px;
                        height: 100px;

                    }


                    .label1{
                        margin-top: 20px;
                        height:35px;
                        line-height: 35px;
                        font-weight: bold;
                        width: 50%;
                    }

                    .label2{
                        margin-top: 20px;
                        height:35px;
                        line-height: 35px;
                        text-align: left;
                        padding-left:140px;
                        width: 50%;
                    }

                    .label3{
                        /* margin-top: 60px;   */
                        height:35px;
                        line-height: 35px;
                        font-weight: bold;
                        width: 200px;
                        padding-left:90px;
                    }

                    
                    .label4{
                        /* margin-top: 60px;   */
                        height:35px;
                        line-height: 35px;
                        width: 200px;
                        padding-left:190px;
                        text-align: left;
                    }
                    
                    .label5{
                        margin-top: 60px;  
                        height:35px;
                        line-height: 35px;
                        width: 500px;
                        padding-left:90px;
                        text-align: left;
                        /* background-color: #000099; */
                        /* text-align: center; */
                    }

                    .form_container{
                        display:flex;
                        justify-content: space-between;
                        width:500px;
                        height: 70px;
                        text-align: center;

                    }

                    .label3_4container{
                        /* margin-top: 60px;   */
                        height:35px;
                        line-height: 35px;
                        width:500px;
                        /* padding-left:140px; */
                        text-align: left;
                        display: flex;
                    }

                    
                    .sub_wrapper{
                        margin:0 auto;
                        width:100%;
                        width:600px;
                        height: 300px;
                    }

                    
                    .image{
                        width:250px;
                        float:right;
                    }

                    .image_wrapper{
                        width: 1000px;
                        height:90px;
                        margin:0 auto;
                    }

                    .error_area{
                        width: 500px;
                        height: 50px;
                        margin: 0;
                        display: flex;
                        margin-top: 5px;
                    }


        </style>
                
    </head>


    <body>
        <p class="header">72Sec JEWERY HOMME＋ コラボレーションリング  6月23日(金) 発売</p>
        <div class="image_wrapper">
            <img src='img/status3.png' class="image">
        </div>

                
        <div class="main_wrapper">
            <p class="label_user">入力内容の確認</p>
            <div class="text">お客様の入力された内容は以下の通りでよろしいでしょうか？<br>よろしければ「登録する」ボタンを押して下さい。</div>
            <p class="label_user2">お客様情報</p>

            <div class="sub_wrapper">

                <div class= error_area>
                    <?php
                        print "<p class='msg'>$str</p>";
                    ?>
                </div>

                <div class="form_container">
                    <p class="label1">ユーザー名</p>
                    <p class="label2"><?php print $ok_login_user_name?></p>
                </div>

                
                <div class="form_container1">
                    <p class="label5">パスワードは安全の為、非表示にしています</p>
                    <div class="label3_4container">
                        <p class="label3">パスワード</p>
                        <p class="label4"><?php print str_repeat('*', strlen($ok_sign_up_password_1)) ?></p>
                    </div>

                </div>
            </div>
        
            <form method="post" action="confirm_sign_up.php">
                <div class="button_container">
                    <input type="submit" class="reverse-button" name="reverse-button" value="戻る">
                    <input type="submit" class="confirm-button"  name="confirm-button" value="登録する">
                </div>
            </form>


    </body>
</html>

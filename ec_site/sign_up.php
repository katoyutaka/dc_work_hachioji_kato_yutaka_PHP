
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規会員登録ページ</title>
    
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

                h2 {
                    margin-top: 70px;
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
                    /* margin-top: 50px; */
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
                    width: 700px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                }

                .name_form_container{
                    display:flex;
                    margin-top:40px;
                    margin-left:230px;
                    width: 700px;
                }

                .label_1{
                    display:flex;
                    height:35px;
                    margin-right:40px;
                    line-height: 35px;
                    width:300px;
                }

                .label_2{
                    display:flex;
                    height:35px;
                    margin-right:40px;
                    line-height: 35px;
                    width:300px;
                }

                .label_3{
                    display:flex;
                    height:35px;
                    margin-right:40px;
                    line-height: 35px;
                    width:300px;
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
                }

                .reverse-button{
                    color:#000099;
                    /* margin-left:100px; */
                }

                .button_container{
                    /* display:flex; */
                    width:100%;
                    margin:0 auto;
                    margin-top:100px;

                }

                .sign_up_form{
                    width:700px;
                    /* width:100%; */
                }


    </style>
              
</head>
<body>

    

    <h2>New Customer 新規会員登録</h2>
        <div class="sign_up_wrapper">
            <div class="sign_up_text">
                <p>会員登録は無料です。</p>
                <p>一度ご登録していただきますと、ご注文の際にユーザー名などの</p>
                <p>入力が不要になり安全かつ簡単にご利用いただけます。</p>
            </div> 
            <div>
               
            </div>  
            <img class="image" src= ".ec_site/images/status1.png" alt="" > 
            
            <div class="user_sign_up_wrapper">
                <div class="main-container">
                    <p class="label_user">お客様情報</p>
                    <form method="post">
                    <div class="sign_up_form">
                        <div class="name_form_container">
                            <p class="label_1">ユーザー名</p>
                            <input type="text" class="user_name_form" name="sign_up_user_name">
                        </div>
                        
                        <div class="name_form_container">
                            <p class="label_2">パスワード</p>
                            <input type="text" class="password_name_form" name="sign_up_password">
                        </div>

                        <div class="name_form_container">
                            <p class="label_3">パスワード(再確認)</p>
                            <input type="text" class="password_name_form" name="sign_up_password">
                        </div>
                        
                    </div>

                    <div class="button_container">
                        <input type="submit" class="reverse-button" value="戻る">
                        <input type="submit" class="check-button" value="確認する">
                    </div>


                    
                    </form>   

                </div>

            </div>
        </div>

  

</body>
</html>
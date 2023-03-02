
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規会員登録ページ</title>
    
    <style>
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
                    width:700px;
                }

                .sign_up_text{
                    text-align: center;
                }

                .user_sign_up_wrapper{
                    width:700px;
                    text-align: left;
                    margin-top: 50px;
                    border-top: 1px solid #b7b7b7;
                
                }

                .label_user{
                    text-align: center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    
                }

                .user_name_form,.password_name_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    width: 400px;
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
            
            <div class="user_sign_up_wrapper">
                <p class="label_user">お客様情報</p>
                <form method="post">
                <div class="sign_up_form">
                    <p class="label_1">ユーザー名</p>
                    <input type="text" class="user_name_form" name="sign_up_user_name">
                    <p>パスワード</p>
                    <input type="text" class="password_name_form" name="sign_up_password">
                    <p>パスワード(再確認)</p>
                    <input type="text" class="password_name_form" name="sign_up_password">
                    <input type="submit" value="登録">
                </div>
                </form>
            </div>
        </div>

  

</body>
</html>
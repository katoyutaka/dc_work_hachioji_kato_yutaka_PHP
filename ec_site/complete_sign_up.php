
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録完了</title>
    
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

                .label_user{
                    text-align: left;
                    font-size:18px;
                    font-weight:bold;
                    background-color:#000099;
                    height: 40px;
                    line-height: 40px;
                    font-size: 16px;
                    width: 1000px;
                    padding-left:50px;
                    margin-top:50px;
                    color:white;
                    
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

                .login-button{
                    margin:0 auto;
                    width:250px;
                    height: 50px;
                    border-radius: 1px;
                    border: 1px solid #000099;
                    font-size:14px;
                    margin-right:10px;
                    background-color: #000099;
                    color:white;
                    cursor: pointer;
                    
                }

                .button_container{
                    width:100%;
                    margin-top:150px;
                    width:600px;
                    display: flex;

                }
                .label1{
                    margin-left:120px;
                    margin-top: 60px;
                    display:flex;
                    height:35px;
                    line-height: 35px;
                    font-weight: bold;
                }

                .label2{
                    margin-left:120px;
                    margin-top: 60px;
                    display:flex;
                    height:35px;
                    line-height: 35px;
                }

                .label3{
                    margin-left:120px;
                    margin-top: 80px;  
                    display:flex;
                    height:35px;
                    line-height: 35px;
                    font-weight: bold;
                }

                
                .label4{
                    margin-left:120px;
                    margin-top: 80px;  
                    display:flex;
                    height:35px;
                    line-height: 35px;
                }
                

                .form_container{
                    display:flex;
                    width:600px;

                }
                .sub_wrapper{
                    margin:0 auto;
                    width:100%;
                    width:600px;
                }

                .link_text{
                    float: left;
                    margin-top:50px;

                }



    </style>
              
</head>
<body>

     <div class="main_wrapper">
        <p class="label_user">ユーザー登録完了</p>
        <div class="text">お客様のユーザー登録が完了しました。<br>ログイン画面よりログイン下さい。</div>
        <p class="label_user2"></p>
       
      
        <a href="login.php?" class="link_text">ログイン画面はこちらから</a>
     </div>



</body>
</html>
<?php
       session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');

        
       try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
   
        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }

?>

<div id="></div>

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
                    font-family:"Yu Mincho";
                    /* letter-spacing: 2px; */
                }

                .label_user{
                    text-align: center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #02235F;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    /* width: 1000px; */
                    padding-left:50px;
                    margin-top:50px;
                    color:white;
                    
                }

                .label_user1{
                    text-align:center;
                    font-size:18px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 40px;
                    line-height: 40px;
                    font-size: 24px;
                    width: 1000px;
                    margin-top:20px;
                    color:#02235F;
                    
                }

                .label_user2{
                    border-bottom: 1px solid #b7b7b7;
                    font-size:18px;
   
                }

                .label_user3{
                    border-bottom: 1px solid #b7b7b7;
                    font-size:18px;
   
                }



                .main_wrapper{
                    width: 1000px;
                    margin:0 auto;
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
                
                .sub_label1{
                    height:35px;
                    line-height: 35px;
                    width: 200px;
                    text-align: left;
                }

                                
                .sub_label2{
                    height:35px;
                    line-height: 35px;
                    width: 200px;
                    text-align: left;
                }

                .form_container{
                    /* display:flex; */
                    /* width:600px; */
                    float:left;

                }

                .sub_wrapper{
                    width: 1000px;
                    height: 500px;
 
                }

                .link_text{
                    float: left;
                    margin-top:50px;

                }

                .sub_container1{
                    border:1px solid blue;
                    width: 460px;
                    height: 500px;
                    float: left;
                    text-align: center;
                    margin-top: 30px;

                }
                .sub_container2{
                    border:1px solid blue;
                    width: 460px;
                    height: 500px;
                    float:right;
                    text-align: center;
                    margin-top: 30px;

                }

                span{
                    font-size: 14px;
                    height: 18px;
                    line-height:  18px;
                    color:#02235F;

                }

                .text{
                    text-align: left;
                    font-size: 14px;
                    margin-top: 20px;
                }

                .user_name_form,.password_name_form{
                    background-color: #f8f8f8;
                    height: 35px;
                    width: 300px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                }

                .third_wrapper{
                    margin-top:20px;
                    margin-left: 20px;
                }

                
                .login_button{
                    background-color: #000099;
                    color:white;
                    cursor: pointer;
                    height: 50px;
                    width: 300px;
                    float:left;
                    margin-top: 20px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                }

                .cookie_confirmation{
                    font-size: 10px;

                    

                }



    </style>
              
</head>
<body>
     <p class="label_user">JEWELRY HOMME 銀座本店オープン</p>
     <div class="main_wrapper">
        
        <div class="text">XXXXXXX<br>XXXXXXX</div>
        <div class="sub_wrapper">
            <p class="label_user1">Login</p>
               <div class="sub_container1">
                 <p class="label_user2">Membership  <span>会員</span></p>
                 <p class="text">【 重要なお知らせ 】<br>リニューアル以前に会員登録をされたお客様は、<br>はじめてログインする際、パスワードの再設定が必要です。 </p>
                 <p class="text">【 LINE会員様へ 】<br>オンラインショップ会員と連動しておりません。<br>オンラインショップをご利用の際には新規会員登録をお願い致します。</p>
               

                 <div class="third_wrapper">
                    <div class="form_container">
                        <p class="sub_label1">ユーザー名</p>
                        <input type="text" class="user_name_form" name="sign_up_user_name">
                    </div>

                    <div class="form_container">
                        <p class="sub_label2">パスワード</p>
                        <input type="password" class="password_name_form" name="sign_up_password_1" >
                        <br>
                        <input type="checkbox"  class="cookie_confirmation" name="cookie_confirmation" value="checked" <?php print $cookie_check; ?>>ユーザ名を記憶する<br>
                    </div>

                    <input type="submit" class="login_button"  name="login_button" value="ログインする">
               </div>
               
               
                </div>

               <div class="sub_container2">
                 <p class="label_user3">New Customer  <span>新規会員登録</span></p>
               </div>

        </div>
     </div>



</body>
</html>
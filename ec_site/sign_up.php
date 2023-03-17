
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

<?php

    //バリデーションチェック実施
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["check-button"])){

            $validation_error = array();

            $sign_up_user_name ='';
            if(!empty($_POST['sign_up_user_name'])){

                $sign_up_user_name = htmlspecialchars($_POST['sign_up_user_name'], ENT_QUOTES, 'UTF-8');
               


                if(!preg_match("/^[a-zA-Z0-9]+$/",$sign_up_user_name)){
                    $validation_error[] = "ユーザー名が半角英数字以外の形式になっています。"."<br>";
                }

            } else {
                $validation_error[]="ユーザー名が未入力です"."<br>";
            }
        

            $sign_up_password_1="";
            if(!empty($_POST['sign_up_password_1'])){

                $sign_up_password_1 = htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');

                if(!preg_match("/^[a-zA-Z0-9]+$/",$sign_up_password_1)){
                    $validation_error[] = "パスワードが半角英数字以外の形式になっています。"."<br>";
                }

            } else {
                $validation_error[]="パスワードが未入力です"."<br>";
            }

            $sign_up_password_2="";
            if(!empty($_POST['sign_up_password_2'])){

                $sign_up_password_2 = htmlspecialchars($_POST['sign_up_password_2'], ENT_QUOTES, 'UTF-8');

                if(!preg_match("/^[a-zA-Z0-9]+$/",$sign_up_password_2)){
                    $validation_error[] = "パスワード（再確認）が半角英数字以外の形式になっています。"."<br>";
                }

            } else {
                $validation_error[]="パスワード（再確認）が未入力です"."<br>";
            }

            if(!($sign_up_password_1 === $sign_up_password_2)){
                $validation_error[]="パスワードが一致しません"."<br>";

            }

    //バリデーションチェックOKならばデータベースに新規登録
            if (empty($validation_error) ){

                $_SESSION["sign_up_user_name"]=$sign_up_user_name;
                $_SESSION["sign_up_password_1"]=$sign_up_password_1;

                header('Location:confirm_sign_up.php');


            }else{
                foreach($validation_error as $err){
                    print "<span class='msg'>$err</span><br>";
                    
                }
            
            }
        }
    }
    
    
?>





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

                .msg{
                    color:red;
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
                    cursor: pointer;
                }

                /* .check-button:hover{
                    color: red;
                    transition: all 0.6s;
                } */

                .reverse-button{
                    color:#000099;
                    /* transition: all 0.6s; */
                    cursor: pointer;
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

                .link_text{
                    float: right;
                }

                .img{
                    background-image:url"(ec_site/images/status1.png)";
        
                    
                    /* float: right; */
                    width:400px;
                }


    </style>
              
</head>
<body>

    
<div class="img">
    <img scr="/status1.png">

</div>
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

                    <form method="post" action="sign_up.php">
                        <div class="sign_up_form">
                            <div class="name_form_container">
                                <p class="label_1">ユーザー名（半角英数字）</p>
                                <input type="text" class="user_name_form" name="sign_up_user_name">
                            </div>
                            
                            <div class="name_form_container">
                                <p class="label_2">パスワード（半角英数字）</p>
                                <input type="password" class="password_name_form" name="sign_up_password_1" >
                            </div>

                            <div class="name_form_container">
                                <p class="label_3">パスワード(再確認)</p>
                                <input type="password" class="password_name_form" name="sign_up_password_2">
                            </div>
                            
                        </div>

                        <div class="button_container">
                            <input type="submit" class="reverse-button" name="reverse-button" value="戻る">
                            <input type="submit" class="check-button"  name="check-button" value="確認する">
                        </div>
                        <a href="sign_up.php?" class="link_text">ログイン画面はこちらから</a>


                    
                    </form>   

                </div>

            </div>
        </div>

  

</body>
</html>
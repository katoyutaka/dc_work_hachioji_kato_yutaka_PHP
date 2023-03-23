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

    $sign_up_user_name = $_SESSION["sign_up_user_name"];
    $sign_up_password_1 = $_SESSION["sign_up_password_1"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["confirm-button"])){

                $create_date = date('Ymd');
                $update_date = date('Ymd');

                //あとでプレースホルダやる
                $insert = "INSERT INTO ec_user_table (user_name, password, create_date, update_date) VALUES ('$sign_up_user_name','$sign_up_password_1',".$create_date.",".$update_date.");";

                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
                
                if($result=$db->query($insert)){
                    
                    $_SESSION = [];
                    session_destroy();

                    header('Location:complete_sign_up.php');
                    exit();


                } else {
                    $str = "既に会員登録済みです。"."<br>"."ログイン画面よりログイン下さい。";
                    
                    
                }

        
        }

        if(isset($_POST["reverse-button"])){
            header('Location:sign_up.php');
            exit();
        }
    }

?>



<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>会員登録確認</title>
        
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

                    .msg{
                        color:red;
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
                        margin-right:10px;
                        
                    }

                    .confirm-button{
                        background-color: #000099;
                        color:white;
                        margin-left:10px;
                        transition: all 0.6s;
                        cursor: pointer;
                    }

                    .reverse-button{
                        color:#000099;
                        transition: all 0.6s;
                        cursor: pointer;
                    }

                    .button_container{
                        width:100%;
                        margin:0 auto;
                        margin-top:80px;
                        width:600px;

                    }
                    .label1{
                        margin-top: 60px;
                        height:35px;
                        line-height: 35px;
                        font-weight: bold;
                        width: 50%;
                    }

                    .label2{
                        margin-top: 60px;
                        height:35px;
                        line-height: 35px;
                        width: 50%;
                    }

                    .label3{
                        margin-top: 80px;  
                        height:35px;
                        line-height: 35px;
                        font-weight: bold;
                        width: 50%;
                    }

                    
                    .label4{
                        margin-top: 80px;  
                        height:35px;
                        line-height: 35px;
                        width: 50%;
                    }
                    

                    .form_container{
                        display:flex;
                        justify-content: space-between;
                        width:500px;
                        text-align: center;

                    }
                    .sub_wrapper{
                        margin:0 auto;
                        width:100%;
                        width:600px;
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
                        height:90px;
                        margin:0 auto;
                        margin-top: 40px;
                    }

        </style>
                
    </head>


    <body>
        <div class="image_wrapper">
            <img src='img/status3.png' class="image">
        </div>
                
        <div class="main_wrapper">
            <?php print "<span class='msg'>$str</span><br>";?>
            <p class="label_user">入力内容の確認</p>
            <div class="text">お客様の入力された内容は以下の通りでよろしいでしょうか？<br>よろしければ「登録する」ボタンを押して下さい。</div>
            <p class="label_user2">お客様情報</p>

            <div class="sub_wrapper">
                <div class="form_container">
                    <p class="label1">ユーザー名</p>
                    <p class="label2"><?php print $sign_up_user_name ?></p>
                </div>

                <div class="form_container">
                    <p class="label3">パスワード</p>
                    <p class="label4"><?php print $sign_up_password_1 ?></p>
                </div>
            </div>
        
            <form method="post" action="confirm_sign_up.php">
                <div class="button_container">
                    <input type="submit" class="reverse-button" name="reverse-button" value="戻る">
                    <input type="submit" class="confirm-button"  name="confirm-button" value="登録する">
                </div>
                <!-- <a href="login.php?" class="link_text">ログイン画面はこちらから</a> -->   
            </form>


    </body>
</html>

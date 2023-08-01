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


                .link_text{
                    float: left;
                    margin-top:50px;

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



    </style>
              
</head>
<body>
    <p class="header">STANDARD PLATINUM 発売開始</p>
    <div class="image_wrapper">
        <img src='img/status4.png' class="image">
    </div>

     <div class="main_wrapper">
        <p class="label_user">ユーザー登録完了</p>
        <div class="text">お客様のユーザー登録が完了しました。<br>ログイン画面よりログイン下さい。</div>
        <p class="label_user2"></p>
       
        <a href="index.php?" class="link_text">ログイン画面はこちらから</a>
     </div>



</body>
</html>
<?php
       session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');
       define("EXPIRATION_PERIOD", 1);

       $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;
        
       try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
   
        } catch (PDOException $e){
            print $e->getMessage();
            exit();
        }

?>




<?php
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog page</title>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
     
    </script>


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
                    /* margin-top:50px; */
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
                    /* margin-top:20px; */
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
                    width: 1400px;
                    margin:0 auto;
                    height:2500px;
                    background-color: green;
                }

                .sub_label1{
                    height:35px;
                    line-height: 35px;
                    width: 400px;
                    text-align: left;
                }

                                
                .sub_label2{
                    height:35px;
                    line-height: 35px;
                    width: 400px;
                    text-align: left;
                    /* margin-left:20px; */
                }

                .sub_wrapper{
                    width: 1000px;
                    height: 600px;
                }

                .sub_container1{
                    /* border:1px solid blue; */
                    width: 460px;
                    height: 550px;
                    float: left;
                    text-align: center;
                    margin-top: 30px;

                }
                .sub_container2{
                    /* border:1px solid blue; */
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
                    width: 380px;
                    border:1px solid #66FFCC;
                    border-radius: 1px;
                    display: block;
                    text-align: left;
                }

                .third_wrapper{
                   margin-top:20px;
                   margin-left:40px;
                   height:220px;
                }

                
                .login_button{
                    background-color: #000099;
                    color:white;
                    cursor: pointer;
                    height: 50px;
                    width: 380px;
                    /* float:left; */
                    margin-top: 20px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                }

                .sign_up_button{
                    background-color: #000099;
                    color:white;
                    cursor: pointer;
                    height: 50px;
                    width: 380px;
                    margin-top: 50px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                }

                .checkbox{
                    float:left;
                    font-size:14px;
                    margin-top:10px;
                }

                .checkbox2{
                    float:left;
                    font-size:14px;
                    margin-top:10px;
                }

                .msg{
                    color:red;
                }

                .cookie-consent {
                    margin: 0 auto;
                    display: flex;
                    position: fixed;
                    bottom: 0;
                    width: 100%;
                    font-size: 14px;
                    color: #fff;
                    background: rgba(0,0,100,0.5);
                    padding-top:40px;
                    padding-bottom:40px;
                    padding-left:400px;
                    height: 160px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                    color:white;
                }

                .policy-link, :link, :visited{
                    color:white;
                    font-family: system-ui;
                    letter-spacing: 2px;
                }
                .cookie_agree {
                    color: white;
                    background-color: #000099;
                    padding:10px 30px;
                    margin-left: 20px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                }

                .cookie_agree:hover{
                    cursor: pointer;
                }

                .limit{
                    font-size: 13px;
                }

                .err{
                    height: 70px;
                    margin-bottom: 50px;
                }

                .eye_check{
                    padding:10px;
                    opacity: 0;
                    cursor: pointer;
                    z-index: 2;
                    position: absolute;
                    top:40px;
                    left:380px;
                    width: 50px;
                    height:30px;
                }

                .image{
                    width: 30px;
                    height:20px;
                   margin-top: 10px;
                }

                .form_container{
                    position: relative;
                }

                .password_container{
                    display: flex;
                }

                /* .scroll_header{
                    height: 100px;
                    background-color: red;
                } */

                .slider img{
                    max-width:180px;
                    width: 100%;
                    height: 120px;
                    
                }

                .slider{
                    width:1000px;
                }

                .fade{
                   
                    text-align:center;
                    /* background-color: gray; */
                    /* width: 750px; */
                    margin: 0 auto;
                    /* background-image: url(img/jewery1.jpg);
                    background-image: url(img/jewery6.jpg);
                    background-image: url(img/jewery10.jpg); */
                    width: 100%;
                    height: 500px;
                    

                }

                .fade img{
                    /* max-width:750px; */
                    width: 100%;
                    height: 500px;
                    /* height: 100%; */
                    object-fit: cover;
                
                }
                .arrival{
                    font-size: 26px;
                    text-align: center;
                    font-weight: bold;
                     letter-spacing: 3px;
                     margin-top: 100px;
                     margin-bottom: 30px;
                    
                }

                .slick-prev, 
                .slick-next {
                    position: absolute;/*絶対配置にする*/
                    top: 42%;
                    cursor: pointer;/*マウスカーソルを指マークに*/
                    /* outline: none;クリックをしたら出てくる枠線を消す */
                    
                    height: 15px;
                    width: 15px;
           
                    
                    

                   
                   }
                    /* 矢印変更はここ！！！ */
                   .slick-prev:before{
                    opacity: 1;
                    background-color: blue;
                    content: url(img/eye1.png);
                    max-width:20px;
                    height: 20px;
                    z-index: 100;
                    display: block;
                   }

                   .slick-next:before{
                    opacity: 1;
                    background-color: blue;
                   }

                   .slick-prev {/*戻る矢印の位置と形状*/
                        left: -3%;
                        /* transform: rotate(-135deg); */
                    }

                    .slick-next {/*次へ矢印の位置と形状*/
                        right: -3%;
                        /* transform: rotate(45deg); */
                    }

                    .right_left1{
                        max-width:500px;
                        width: 100%;
                        height: 300px;
                        float:left;
                        transform: translate(-200px,0); 
                        opacity: 0; 
                        visibility: hidden; 
                        transition: transform 4s, opacity 4s, visibility 4s;

                    
                    }

                    .right_left2{
                        max-width:500px;
                        width: 100%;
                        height: 300px;
                        float:right;
                        transform: translate(200px,0); 
                        opacity: 0; 
                        visibility: hidden; 
                        transition: transform 4s, opacity 4s, visibility 4s;
                    
                    }

                    .right_left3{
                        max-width:500px;
                        width: 100%;
                        height: 300px;
                        float:left;
                        transform: translate(-200px,0); 
                        opacity: 0; 
                        visibility: hidden; 
                        transition: transform 4s, opacity 4s, visibility 4s;

                    
                    }

                    .right_left4{
                        max-width:500px;
                        width: 100%;
                        height: 300px;
                        float:right;
                        transform: translate(200px,0); 
                        opacity: 0; 
                        visibility: hidden; 
                        transition: transform 4s, opacity 4s, visibility 4s;

                    
                    }

                    .right_left_fade_in_container1{
                        width: 1000px;
                        height: 300px;
                        margin-top: 100px;
                    }


                    .right_left_fade_in_container2{
                        width: 1000px;
                        height: 300px;
                        margin-top: 100px;
                        
                    }


                    .right_left_fade_in_container3{
                        width: 1000px;
                        height: 300px;
                        margin-top: 100px;
                    }


                    .right_left_fade_in_container4{
                        width: 1000px;
                        height: 300px;
                        margin-top: 100px;
                        
                    }
          
                    .is-fadein {
                        transform: translate(0,0); 
                        opacity: 1; 
                        visibility: visible; 

                    }

                    .ring_wrapper{
                        width: 1200px;
                        height:300px;
                        background-color: red;
                        margin: 0 auto;
                        display: flex;
                    }

                    .ring_img img{
                        width: 200px;
                        height:200px;
                    }

                    .ring_img{
                        margin-right: 15px;
                        margin-left: 15px;
                    }

                    .online_tag{
                        max-width: 90px;
                        max-height:20px;
                        
                    }

                    .ring_name{
                        font-family: system-ui;
                        letter-spacing: 2px;

                    }



    </style>
              
</head>
<body>
     <p class="label_user">72Sec JEWERY HOMME＋ 銀座本店オープン</p>

     <div class="main_wrapper">
        <p class="arrival">Ring</p>
        <div class="ring_wrapper">
            <div class="ring_img">
            <img src="img/jewery4.jpg">
            <br>
            <img class="online_tag" src="img/online_tag.png">
            <p class="ring_name">シルバーリング</p>
            </div>

            <div class="ring_img">
            <img src="img/jewery4.jpg">
            </div>

            <div class="ring_img">
            <img src="img/jewery4.jpg">
            </div>

            <div class="ring_img">
            <img src="img/jewery4.jpg">
            </div>

            <div class="ring_img">
            <img src="img/jewery4.jpg">
            </div>

        </div>
            
    

        <div class="err">
            <?php
                if(!empty($validation_error)){
                    foreach($validation_error as $err){
                        print "<p class='msg'>$err</p>";
                    }
                }

                print "<span class='msg'>$str</span>";

            ?>
        </div>


        <div class="sub_wrapper">
            <p class="label_user1">Login</p>
               <div class="sub_container1">
                    <p class="label_user2">Membership  <span>会員</span></p>
                    <p class="text">【 重要なお知らせ 】<br>リニューアル以前に会員登録をされたお客様は、<br>はじめてログインする際、パスワードの再設定が必要です。 </p>
                    <p class="text">【 LINE会員様へ 】<br>オンラインショップ会員と連動しておりません。<br>オンラインショップをご利用の際には新規会員登録をお願い致します。</p>
                
                    <form method="post" action="">
                        <div class="third_wrapper">
                                <div class="form_container">
                                    <p class="sub_label1">ユーザー名<span class="limit">（半角英数字で５文字以上）</span></p>
                                        <input type="text" class="user_name_form" name="login_user_name" value="<?php print $login_user_name ;?>">
                                </div>

                                <div class="form_container">
                                    <p class="sub_label2">パスワード<span class="limit">（半角英数字で８文字以上）</span></p>
                                    <div class="password_container">
                                        <input type="<?php print $user_check2;?>" class="password_name_form" name="sign_up_password_1" value="<?php print $sign_up_password_1;?>" >
                                        <img src= <?php print $eye_path;?> class="image">
                                    </div>

                                    <input type="submit" name="eye_check" class="eye_check" value="<?php print $eye_check;?>">
                                    <br>
                                    <div class="checkbox">
                                        <input type="checkbox" name="user_check" value="checked" <?php print $user_check; ?>>次回からユーザー名・パスワード省略する
                                    </div>
                                </div>
                            </div>
                        
                            <input type="submit" class="login_button"  name="login_button" value="ログインする">
                    </form>

                </div>

               <div class="sub_container2">
                 <p class="label_user3">New Customer  <span>新規会員登録</span></p>

                    <div class="sign_up_text">
                        <p class="text">会員登録は無料です。<br>一度ご登録していただきますと、ご注文の際にユーザー名などの<br>入力が不要になり安全かつ簡単にご利用いただけます。</p>
                    </div>
                    <form method="post" action="">
                        <input type="submit" class="sign_up_button"  name="sign_up_button" value="会員登録する">
                    </form>
               </div>


        </div>
     </div>


</body>
</html>
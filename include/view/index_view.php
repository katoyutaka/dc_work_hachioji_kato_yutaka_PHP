
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        
        $(document).ready(function(){

        // トップの自動でフェードする画像
        $('.fade').slick({
            autoplay: true, // 自動再生
            fade: true, // スライドをフェードイン・フェードアウト
            cssEase: 'linear',// アニメーション
            speed: 300, // フェードアニメーションの速度設定
            arrows:false,
            dots: true, // インジケーター
            infinite: true, // 無限ループするかどうか
            pauseOnHover:false,
            pauseOnFocus:false,
            pauseOnDotsHover:false,
        });

        // 横にスライドできる画像
        $('.slider').slick({
            autoplay: true, // 自動再生するかどうか
            autoplaySpeed: 800, // 自動再生する場合のスピード（ms単位）
            arrows: true, // 左右の矢印を表示するかどうか
            dots: false, // ページネーションを表示するかどうか
            infinite: true, // 無限ループするかどうか
            slidesToShow: 5, // 一度に表示するスライドの数
            slidesToScroll: 1 // スライドを1つスクロールするときの数

        });

        });

        // 左右からフェードインする画像
        $(function () { $(window).scroll(function () {
            const windowHeight = $(window).height(); 
            const scroll = $(window).scrollTop(); 
            $('.right_left1').each(function () { 
                const targetPosition = $(this).offset().top; 
                if (scroll > targetPosition - windowHeight + 100) { 
                    $(this).addClass("is-fadein"); } }); 
            });
        });

        $(function () { $(window).scroll(function () {
            const windowHeight = $(window).height(); 
            const scroll = $(window).scrollTop(); 
            $('.right_left2').each(function () { 
                const targetPosition = $(this).offset().top; 
                if (scroll > targetPosition - windowHeight + 100) { 
                    $(this).addClass("is-fadein"); } }); 
            });
        });

        $(function () { $(window).scroll(function () {
            const windowHeight = $(window).height(); 
            const scroll = $(window).scrollTop(); 
            $('.right_left3').each(function () { 
                const targetPosition = $(this).offset().top; 
                if (scroll > targetPosition - windowHeight + 100) { 
                    $(this).addClass("is-fadein"); } }); 
            });
        });

        $(function () { $(window).scroll(function () {
            const windowHeight = $(window).height(); 
            const scroll = $(window).scrollTop(); 
            $('.right_left4').each(function () { 
                const targetPosition = $(this).offset().top; 
                if (scroll > targetPosition - windowHeight + 100) { 
                    $(this).addClass("is-fadein"); } }); 
            });
        });


        //eye check
        document.addEventListener("DOMContentLoaded", function() {
            let eyeCheck = document.getElementById("eye_check");
            let passwordField = document.getElementById("password");

            eyeCheck.addEventListener("click", function() {
                let currentType = passwordField.getAttribute("type");

                if (currentType === "password") {
                    passwordField.setAttribute("type", "text");
                    eyeCheck.src = "img/eye1.png";

                } else {
                    passwordField.setAttribute("type", "password");
                    eyeCheck.src = "img/eye2.png";
                }
            });
        });


        //Cookie Consent
        document.addEventListener("DOMContentLoaded", function() {
            let cookieConsentButton = document.getElementById("cookieConsentButton");
            let cookieConsentBanner = document.getElementById("cookieConsentBanner");

        // 初期状態で、クッキーの同意があればバナーを非表示にする
        if (document.cookie.indexOf("cookieConsent=agree") !== -1) {
            cookieConsentBanner.style.display = "none";
        }

        cookieConsentButton.addEventListener("click", function() {
            // クッキーに同意したという情報を保存
            document.cookie = "cookieConsent=agree; path=/; max-age=" + 60 * 60 * 24 * 30;  // 30日間有効

            // バナーを非表示にする
            cookieConsentBanner.style.display = "none";
            });
        });
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
                    vertical-align: bottom;
                    font-family:"Yu Mincho";
                }

                .label_user{
                    text-align: center;
                    font-weight:bold;
                    background-color: #02235F;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    padding-left:50px;
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
                    height:2600px;
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
                }

                .sub_wrapper{
                    width: 1000px;
                    height: 780px;
                    margin-top: 30px;
                }

                .sub_container1{
                    margin: 0 auto;
                    width: 500px;
                    height: 700px;
                    float: left;
                    text-align: center;
                    margin-top: 30px;
                    

                }
                .sub_container2{
                    width: 460px;
                    height: 500px;
                    float:right;
                    text-align: center;
                    margin-top: 30px;

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
                }

                .login_button{
                    background-color: #000099;
                    color:white;
                    cursor: pointer;
                    height: 50px;
                    width: 380px;
                    float:left;
                    margin-top: 70px;
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
                }

                .checkbox2{
                    float:left;
                    font-size:14px;
                    margin-top:10px;
                }

                .msg{
                    color:red;
                    text-align: left;
                    margin :0 auto;
                    font-weight: bold;;
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
                .agree {
                    color: white;
                    background-color: #000099;
                    padding:0px 10px;
                    margin-left: 20px;
                    font-family: system-ui;
                    letter-spacing: 2px;
                    height:40px;
                }

                .agree:hover{
                    cursor: pointer;
                }

                .limit{
                    font-size: 13px;
                    opacity: 0.7;
                }

                .err{
                    width: 500px;
                    height: 30px;
                    font-size: 16px;
                    text-align: left;
                    margin-top: 30px;
                }

                .image{
                    width: 30px;
                    height:20px;
                   margin-top: 10px;
                }

                .form_container{
                    position: relative;
                    margin-bottom: 20px;
                }

                .password_container{
                    display: flex;
                }

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
                    width: 100vw;
                    height: auto;
                }

                .fade img{
                    width: 100vw;
                    height: auto;
                    /* object-fit: cover; */
                
                }

                .arrival{
                    font-size: 20px;
                    text-align: center;
                    font-weight: bold;
                     letter-spacing: 3px;
                     margin-top: 100px;
                     margin-bottom: 30px;
                    
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

                .validation_error_area{
                    width: 500px;
                    height: 20px;
                    margin: 0;
                }

    </style>     
</head>


<body>
     <p class="label_user">72Sec JEWERY HOMME＋ 銀座本店オープン</p>

     <div class="fade">
        <img src="img/topview2.png" alt="">
        <img src="img/1.png" alt="">
        <img src="img/topview3.png" alt="">
     </div>


     <div class="main_wrapper">
        <p class="arrival">NEW ARRIVAL</p>
        <ul class="slider">
            <li><img src="img/saletag2.png" alt=""></li>
            <li><img src="img/ring5.png" alt=""></li>
            <li><img src="img/ring4.png" alt=""></li>
            <li><img src="img/necklace1.png" alt=""></li>
            <li><img src="img/necklace2.png" alt=""></li>
            <li><img src="img/necklace3.png" alt=""></li>
            <li><img src="img/necklace4.jpg" alt=""></li>
            <li><img src="img/necklace5.png" alt=""></li>
        </ul>
            
        
     
        <div class="right_left_fade_in">
            <div class="right_left_fade_in_container1">
                <img class="right_left1" src="img/jewery3.jpg" alt="">
            </div>

            <div class="right_left_fade_in_container2">
                <img class="right_left2" src="img/fadeimage1.png" alt="">
            </div>

            <div class="right_left_fade_in_container3">
                <img class="right_left3" src="img/fadeimage2.png" alt="">
            </div>

            <div class="right_left_fade_in_container4">
                <img class="right_left4" src="img/jewery24.png" alt="">
            </div>
        </div>

        <div class="sub_wrapper">
            <p class="label_user1">Login</p>

               <div class="sub_container1">
                    <p class="label_user2">Membership  <span>会員</span></p>
                    <p class="text">【 重要なお知らせ 】<br>リニューアル以前に会員登録をされたお客様は、<br>はじめてログインする際、パスワードの再設定が必要です。 </p>
                    <p class="text">【 LINE会員様へ 】<br>オンラインショップ会員と連動しておりません。<br>オンラインショップをご利用の際には新規会員登録をお願い致します。</p>

                
                    <!-- <form method="post" action=""> -->

                            <div class="err">
                                <?php
                                    print "<span class='msg'>$str</span>";
                                ?>
                            </div>

                            <div class= validation_error_area>
                                <?php
                                    if(!empty($validation_error1)){
                                        foreach($validation_error1 as $err1){
                                            print "<p class='msg'>$err1</p>";
                                        }
                                    }
                                ?>
                            </div>
                    <form method="post" action="">
                            <div class="form_container">
                                <p class="sub_label1">ユーザー名<span class="limit">（半角英数字で５文字以上）</span></p>
                                    <input type="text" class="user_name_form" name="login_user_name" value="<?php print $cookie_login_user_name ;?>">
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

                            <div class="form_container">
                                <p class="sub_label2">パスワード<span class="limit">（半角英数字で８文字以上）</span></p>

                                <div class="password_container">

                                
                                        <input type="password"  id="password" class="password_name_form" name="sign_up_password_1" value="<?php print $cookie_sign_up_password_1;?>" >
                                        <img src="img/eye2.png" id="eye_check" class="image" >
                                    

                                </div>
                                <br>
                                <div class="checkbox">
                                    <input type="checkbox" name="user_check" value="checked" <?php print $cookie_user_check; ?>>次回からユーザー名・パスワード省略する
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

     
     <div id="cookieConsentBanner" class="cookie-consent">
        <div class="cookie-text">
            当サイトはクッキー(cookie)を使用します。クッキーはサイト内の一部の機能および、<br>
            サイトの使用状況の分析からマーケティング活動に利用することを目的としています。<br>
            <span class="policy-link">
                <a href="privacy.php">「プライバシーポリシーはこちらから」</a>
            </span>
        </div>

        
        <button id="cookieConsentButton" class="agree">同意する</button>
        
     </div>

</body>
</html>
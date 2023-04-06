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

        $validation_error = array();
        $cookie_display = "visible";
        $sign_up_password_1="";
        $user_check="";
        $cookie_agree= "";
        $login_user_name="";
        $user_check2 = "text";
        $eye_check ="非表示にする";
        $eye_path="img/eye2.png";

?>




<?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST["sign_up_button"])){
                header('Location:membership_terms.php');
                exit();
            }

                //どうやらhiddenで消えてしまうやつの中で変数格納の式を作成しても、消えると変数内がリセットされるようだ。setcookieやセッション変数は消えないようなので
                //今回はセッション変数に格納する方法をとった。
                //「同意する」ボタンが押された時の処理
                //のちに($_SESSION["cookie_display"] === "")も下に追加する。
            if(isset($_POST["cookie_agree"])){
                
                $_SESSION["cookie_display"]="hidden";
                // $cookie_display = "hidden";

                $eye_check="表示する";
                $user_check2="password";
            }
            //上記の波かっこ外で変数を格納
            $cookie_display=$_SESSION["cookie_display"];


            
            if(isset($_POST["login_user_name"])){

                if(!empty($_POST['login_user_name'])){

                    $login_user_name = htmlspecialchars($_POST['login_user_name'], ENT_QUOTES, 'UTF-8');
                    
                    if(!preg_match("/^[a-z0-9]{5,}+$/",$login_user_name)){
                        $validation_error[] = "ユーザー名が半角英数字以外の形式もしくは５文字未満になっています。"."<br>";
                    }

                }else {
                    $validation_error[]="ユーザー名が未入力です"."<br>";
                }
            }

            
            if(isset($_POST["sign_up_password_1"])){

                if(!empty($_POST['sign_up_password_1'])){

                    $sign_up_password_1 = htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');
                    
                    if(!preg_match("/^[a-z0-9]{8,}+$/", $sign_up_password_1)){
                        $validation_error[] = "パスワードが半角英数字以外の形式もしくは８文字未満になっています。"."<br>";
                    }

                }else {
                    $validation_error[]="パスワードが未入力です"."<br>";
                }    
            }


            
            if(isset($_POST["user_check"])){
                $user_check = htmlspecialchars($_POST['user_check'], ENT_QUOTES, 'UTF-8');
                
            }

    
            if(($_POST["eye_check"])==="非表示にする"){
                $user_check2 = "password";
                $eye_check ="表示する";
                $eye_path= "img/eye2.png";
                
            }

            if(($_POST["eye_check"])==="表示する"){
                $user_check2 = "text";
                $eye_check ="非表示にする";
                $eye_path= "img/eye1.png";
            }
  
           
            //「チェック」が押されたときの処理
            if($user_check==="checked"){
                //クッキーの話
                setcookie("user_check",$user_check,$cookie_expiration);
                setcookie("login_user_name",$login_user_name,$cookie_expiration);  
                setcookie("sign_up_password_1",$sign_up_password_1,$cookie_expiration);  
            }


            
            //「ログイン」が押されたときの処理
            if((isset($_POST["login_button"]))){

                //バリデーションチェックでOKならばデータ接続
                if (empty($validation_error) ){

                    $select = 'SELECT * FROM ec_user_table WHERE user_name = "'.$login_user_name.'";';

                    if ($result = $db->query($select)) {
                        while($row = $result->fetch()){
                            $final_password= $row["password"];
                        }
                

                        if($final_password === $sign_up_password_1){

                            //セッションの話
                            $_SESSION["login_user_name"]= $login_user_name;
                            $_SESSION["sign_up_password_1"] = $sign_up_password_1;

                            //↓はショッピングサイト内へ行く
                            // header('Location:XXXXXX.php');
                            // exit();
        
                        } else {
                            $str = "ユーザー名またはパスワードが一致しません";
                            
                        }

                    }
                }
            }

        }
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>

    <!-- slick使うときは➀slick.min.css➁slick-theme.css➂slick.min.jsをr追加する -->
    <!-- <link rel="stylesheet" href="css/plugin/slick.css"> -->
    <!-- <link rel="stylesheet" href="css/plugin/slick-theme.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">



    
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
                    width: 1000px;
                    margin:0 auto;
                    height:2500px;
                    /* background-color: red; */
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
                    font-size: 20px;
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

                   .slick-prev:before{
                    opacity: 1;
                    background-color: blue;
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



    </style>
              
</head>
<body>
     <p class="label_user">72Sec JEWERY HOMME＋ 銀座本店オープン</p>
     <div class="fade">
        <img src="img/jewery15.jpg" alt="">
        <img src="img/jewery8.jpg" alt="">
        <img src="img/jewery10.jpg" alt="">
     </div>

     <!-- //<li>より<div>で囲った方がよいので後で修正すること。 -->
     <div class="main_wrapper">
        <p class="arrival">NEW ARRIVAL</p>
        <ul class="slider">
            <li><img src="img/jewery4.jpg" alt=""></li>
            <li><img src="img/jewery5.jpg" alt=""></li>
            <li><img src="img/jewery3.jpg" alt=""></li>
            <li><img src="img/jewery7.jpg" alt=""></li>
            <li><img src="img/jewery1.jpg" alt=""></li>
            <li><img src="img/jewery6.jpg" alt=""></li>
            <li><img src="img/jewery8.jpg" alt=""></li>
            <li><img src="img/jewery9.jpg" alt=""></li>
        </ul>
            
        
     
        <div class="right_left_fade_in">
            <div class="right_left_fade_in_container1">
                <img class="right_left1" src="img/jewery7.jpg" alt="">
            </div>

            <div class="right_left_fade_in_container2">
                <img class="right_left2" src="img/jewery15.jpg" alt="">
            </div>

            <div class="right_left_fade_in_container3">
                <img class="right_left3" src="img/jewery16.jpg" alt="">
            </div>

            <div class="right_left_fade_in_container4">
                <img class="right_left4" src="img/jewery8.jpg" alt="">
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

     
     <div style="visibility:<?php print $cookie_display;?>;"class="cookie-consent">
        <div class="cookie-text">
            当サイトはクッキー(cookie)を使用します。クッキーはサイト内の一部の機能および、<br>
            サイトの使用状況の分析からマーケティング活動に利用することを目的としています。<br>
            <span class="policy-link">
                <a href="privacy.php">「プライバシーポリシーはこちらから」</a>
            </span>
        </div>

        <form method="post" action="">
            <input type="submit" class="cookie_agree" name="cookie_agree" value="同意する">
        </form>
     </div>

<!-- jsファイルは</body>直前の方が処理速度アップのためここに記載 -->
 <!-- jsファイルを読み込む順番は➀jquery➁slick➂自作のやつ -->
<!-- <script src="js/plugin/jquery-3.6.4.min.js"></script> -->
<!-- <script src="js/plugin/slick.min.js"></script> --> -->
<!-- <script src="js/login_script.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="login_script.js"></script>
</body>
</html>
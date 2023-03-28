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


        $cookie_display = "visible";

?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["sign_up_button"])){
            header('Location:membership_terms.php');
            exit();
        }
        // print "1";



        // if(isset($_POST["login_button"])){
            
        //     $validation_error = array();

        //     $login_user_name ='';
        //     if(!empty($_POST['login_user_name'])){

        //         $login_user_name = htmlspecialchars($_POST['login_user_name'], ENT_QUOTES, 'UTF-8');
               
        //         if(!preg_match("/^[a-zA-Z0-9]+$/",$login_user_name)){
        //             $validation_error[] = "ユーザー名が半角英数字以外の形式になっています。"."<br>";
        //         }

        //     } else {
        //         $validation_error[]="ユーザー名が未入力です"."<br>";
        //     }
        

        //     $sign_up_password_1="";
        //     if(!empty($_POST['sign_up_password_1'])){

        //         $sign_up_password_1 = htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');

        //         if(!preg_match("/^[a-zA-Z0-9]+$/",$sign_up_password_1)){
        //             $validation_error[] = "パスワードが半角英数字以外の形式になっています。"."<br>";
        //         }

        //     } else {
        //         $validation_error[]="パスワードが未入力です"."<br>";
        //     }

        

    //バリデーションチェックOKならばデータベースと照合
            // if (empty($validation_error) ){

            //     $select = "'SELECT * FROM ec_user_table WHERE user_name = '.$login_user_name.'";

            //     if ($result = $db->query($select)) {
            //         while($row = $result->fetch()){
            //             print $row["password"];
            //         }
                        
    
            //         if($row["password"]===$sign_up_password_1){
            //             header('Location:complete_sign_up.php');
            //             exit();
    
            //         } else {
            //             $str = "ユーザーIDまたはパスワードが一致しません";
                           
            //         }

            //     }

     
            



        //     }else{
        //         foreach($validation_error as $err){
        //             print "<span class='msg'>$err</span><br>";
                    
        //         }
        //     }
        // }

                //どうやらhiddenで消えてしまうやつの中で変数格納の式を作成しても、消えると変数内がリセットされるようだ。setcookieやセッション変数は消えないようなので
                //今回はセッション変数に格納する方法をとった。
                //「同意する」ボタンが押された時の処理
                $cookie_agree= "";
                if(isset($_POST["cookie_agree"])){
                    
                    $_SESSION["cookie_display"]="hidden";
                    // $cookie_display = "hidden";
                }
                //上記の波かっこ外で変数を格納
                $cookie_display=$_SESSION["cookie_display"];


                $login_user_name="";
                if(isset($_POST["login_user_name"])){
                    $login_user_name = htmlspecialchars($_POST['login_user_name'], ENT_QUOTES, 'UTF-8');
                  
                }

                $sign_up_password_1="";
                if(isset($_POST["sign_up_password_1"])){
                    $sign_up_password_1 = htmlspecialchars($_POST['sign_up_password_1'], ENT_QUOTES, 'UTF-8');
                }

                $user_check="";
                if(isset($_POST["user_check"])){
                    $user_check = htmlspecialchars($_POST['user_check'], ENT_QUOTES, 'UTF-8');
                    
                }

                // $user_check2="password";
                if(isset($_POST["user_check2"])){
                    $user_check2 = "text";
                    
                }else{
                    $user_check2 = "password";

                }



                //「ログイン」が押されたときの処理
                if((isset($_POST["login_button"]))){
                    //セッションの話
                    $_SESSION["login_user_name"]= $login_user_name;
                    $_SESSION["sign_up_password_1"] = $sign_up_password_1;

                }

                
                //「チェック」が押されたときの処理
                if($user_check==="checked"){
                    //クッキーの話
                    setcookie("user_check",$user_check,$cookie_expiration);
                    setcookie("login_user_name",$login_user_name,$cookie_expiration);  
                    setcookie("sign_up_password_1",$sign_up_password_1,$cookie_expiration);  
                }



        }

        



                
        // if(isset($_COOKIE["login_user_name"])){
        //     $login_user_name = $_COOKIE["login_user_name"];
        //     print $login_user_name;
        // } else {
        //     $login_user_name = "";
        // }


        // if(isset($_COOKIE["user_check"])){
        //     $user_check = "checked";
        //     print $user_check;
        // } else {
        //     $user_check = "";
        // }


 






        
        
    // }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"> -->
    <title>ログイン</title>
    
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
                    height:650px;
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




    </style>
              
</head>
<body>
     <p class="label_user">JEWELRY HOMME 銀座本店オープン</p>
     <div class="main_wrapper">
        
        <div class="err">
            <?php
                if(!empty($validation_error)){
                    foreach($validation_error as $err){
                        print "<p class='msg'>$err</p><br>";
                        
                }
            }
            
            ?>

        </div>
        <?php print "<span class='msg'>$str</span><br>";?>

        <div class="sub_wrapper">
            <p class="label_user1">Login</p>
               <div class="sub_container1">
                    <p class="label_user2">Membership  <span>会員</span></p>
                    <p class="text">【 重要なお知らせ 】<br>リニューアル以前に会員登録をされたお客様は、<br>はじめてログインする際、パスワードの再設定が必要です。 </p>
                    <p class="text">【 LINE会員様へ 】<br>オンラインショップ会員と連動しておりません。<br>オンラインショップをご利用の際には新規会員登録をお願い致します。</p>
                
                    <form method="post" action="">
                        <div class="third_wrapper">
                                <div class="form_container">
                                    <p class="sub_label1">ユーザー名</p>
                                        <input type="text" class="user_name_form" name="login_user_name" value="<?php print $login_user_name ;?>">
                                </div>

                                <div class="form_container">
                                    <p class="sub_label2">パスワード</p>
                                    <input type="<?php print $user_check2;?>" class="password_name_form" name="sign_up_password_1" value="<?php print $sign_up_password_1;?>" >
                                    <!-- <label for="checkPassword" class="fa fa-eye"></label>
                                    <label for="checkPassword" class="fa fa-eye-slash"></label> -->
                                    <br>
                                    <div class="checkbox">
                                        <input type="checkbox"  name="user_check" value="checked" <?php print $user_check; ?>>次回からユーザー名・パスワード省略する
                                    </div>

                                    <br>
                                    <div class="checkbox2">
                                        <input type="checkbox"  name="user_check2" value="checked2" <?php print $user_check; ?>>パスワードを表示させる
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

</body>
</html>
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
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["sign_up_button"])){
            header('Location:sign_up.php');
            exit();
        }



        if(isset($_POST["login_button"])){
            
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

        

    //バリデーションチェックOKならばデータベースと照合
            if (empty($validation_error) ){

                $select = "'SELECT * FROM ec_user_table WHERE user_name = '.$sign_up_user_name.'";

                if ($result = $db->query($select)) {
                    while($row = $result->fetch()){
                        print $row["password"];
                    }
                        
    
                    if($row["password"]===$sign_up_password_1){
                        header('Location:complete_sign_up.php');
                        exit();
    
                    } else {
                        $str = "ユーザーIDまたはパスワードが一致しません";
                           
                    }

                }

     
            



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
                    /* margin-left:20px; */
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
                    /* border:1px solid blue; */
                    width: 460px;
                    height: 600px;
                    float: left;
                    text-align: center;
                    margin-top: 30px;

                }
                .sub_container2{
                    /* border:1px solid blue; */
                    width: 460px;
                    height: 600px;
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

                .msg{
                    color:red;
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
               

                 <div class="third_wrapper">
                    <div class="form_container">
                        <p class="sub_label1">ユーザー名</p>
                        <input type="text" class="user_name_form" name="sign_up_user_name">
                    </div>

                    <div class="form_container">
                        <p class="sub_label2">パスワード</p>
                        <input type="password" class="password_name_form" name="sign_up_password_1" >
                        <br>
                        <div class="checkbox">
                            <input type="checkbox"  class="cookie_confirmation" name="cookie_confirmation" value="checked" <?php print $cookie_check; ?>>ユーザ名を記憶する
                        </div>
                        
                    </div>
                </div> 
                
                <form method="post" action="">
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
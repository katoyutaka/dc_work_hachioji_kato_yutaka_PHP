
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







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ショッピングカート</title>
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
                    font-family: system-ui;
                    letter-spacing: 2px;
                    /* font-family:"Yu Mincho"; */
                    /* letter-spacing: 2px; */
                }

                .label_user{
                    text-align: left;
                    font-size:20px;
                    font-weight:bold;
                    background-color: #eff6fc;
                    height: 100px;
                    line-height: 40px;
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

                span{
                    font-size: 14px;

                }

                .label_user3{
                    font-size: 14px;
                    color:red;
                }


    




    </style>
              
</head>
<body>


<div class="main_wrapper">
        <div class="label_user">ご注文商品 <span>発送予定日  :<?php print date('Ymd')+ 2;?></span>

            <p class="label_user3">※お届け日ではありません。またコンビニ前払いの場合は発送日が異なります。ご注意ください。</p>
    
    
        </div>
       
        <div class="text">「JEWELRY HOMME ONLINE SHOP」入会お申込の前に、以下の会員規約・利用規約を必ずお読み下さい。<br>ご同意いただける方は、「同意する」をクリックして入会お申込フォームへお進み下さい。</div>
        <p class="label_user2">会員規約</p>
</div>
    
</body>
</html>
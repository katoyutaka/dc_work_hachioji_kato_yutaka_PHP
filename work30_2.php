
<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $create_date = date('Ymd');
        $update_date = date('Ymd');
        $error_msg = array();
        $error_msg=[];
        

        $db = new mysqli($host, $login_user, $password, $database);
        $db->set_charset("utf8");
        $select = "SELECT * FROM gallery";
        $result = $db->query($select);
        $db->close();
        
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_2</title>

        <style>
                * {
                    box-sizing:border-box;
                    vertical-align: middle;
                }
              
                h1 {
                    font-size:20px; 
                }

                p {
                    font-size:18px; 
                }


                .box{
                    color: #fff;
                    font-weight: bold; 
                    width: 180px;
                    height:170px;
                    border:1px solid #b7b7b7;
                    margin-right:5px;
                    margin-bottom:5px;
                    text-align: center;
                    
                }  

                .main {
                    margin-left:50px;
                    width:650px;
                }

                .contents-container {
                    display:flex;
                    flex-wrap: wrap;
                    margin-top:10px;

                }

                .contents-container p {
                    text-align: center;
                    font-size:10px;
                
                }
                    
      
                .introduce-image{
                    width:100%;
                    max-width: 128px;
                    max-height: 128px;
                    margin: 0 auto;
                    display: block;
                    
                    
                }
   
                .img-container {
                    height:150px;
                    margin-right:20px;
                    margin-left:20px;
                    margin-top: 5px;
                    margin: 0 auto;
                    width:100%;
                    display: inline;
                    
                }

                .title{
                    display:inline-block;
                    margin-top:2px;
                    margin-bottom:2px;
                    color:#000000;
                }
   
        </style>
        
    </head>



    <body>

        <h1>画像一覧</h1>
        <br>

        <div class=main>
            <div class="contents-container"> 

            <?php
 
                $r = 1;
                while($row = $result->fetch_assoc()){

                    $get_img_url = $row["image_path"];

            ?>

                        <div class="box">
                            <div class= img-container>
                                <p class="title"><?php print $row['image_name'];?></p>
                                <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                            </div>
                        </div>
                       
                
            <?php
                $r++;
                }
            ?>
                                 
            </div>

        </div>

        <br>
        <form>
        <a href="work30_1.php?">画像投稿ページへ</a>
        <form>

    </body>
</html>
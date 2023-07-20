

<?php
       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');

        $create_date = date('Ymd');
        $update_date = date('Ymd');
        $error_msg = array();
        $error_msg=[];
        

    
        try{
            $db=new PDO(DSN,LOGIN_USER,PASSWORD);
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
       
        $select = "SELECT * FROM gallery WHERE public_flg = 0";
        $result = $db->query($select);
        
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK39_2</title>

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
                while($row = $result->fetch()){

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
        <a href="work39_1_controller.php?">画像投稿ページへ</a>
        <form>

    </body>
</html>
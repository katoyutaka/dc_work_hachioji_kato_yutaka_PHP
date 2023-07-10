
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK39_1_view</title>

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
                    height:220px;
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


                .btn-wrapper{
                    margin-bottom:2px;
                }

                .flg-button {
                    display: inline-block;
                    width: 90px;
                    height:20px;
                    font-size:11px;
                }

                .title{
                    display:inline-block;
                    margin-top:2px;
                    margin-bottom:2px;
                    color:#000000;
                }
                .msg{
                    color:red;
                }

                .on_off_button  {
                    display: inline-block;
                    font-size: 12px;
                    text-align: center;
                }

                .button-container {
                    margin-top: 10px;
                    margin-bottom: 10px;

                }

                .img-wrapper{
                    height:170px;
                }

        </style>

    </head>

    <body>
                        
        <h1>画像投稿</h1>
        <form method="post" action="work39_1_controller.php" enctype="multipart/form-data">
            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" name="submit" value="画像投稿"></p>
        </form>

        <form method="get" action="work39_2.php">
        <a href="work39_2.php?">画像一覧ページへ</a>
        </form>
        
        <div class=main>
            <div class="contents-container"> 



            <?php
               
               
                while($row = $result->fetch()){
                    $get_img_url = $row["image_path"];
                    $row_public_flg = $row["public_flg"]; 

                    $a =func_public_flg($row_public_flg);
                    $display=$a[0];
                    $color=$a[1];
                    $img_display=$a[2];


 
            ?>
      
                <div style="background:<?php print $color; ?>;" class="box">
                <div class ="img-wrapper">
                <div style="visibility:<?php print $img_display;?>;" class= img-container>
                    <p class="title"><?php print $row['image_name'];?></p>
                    <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                </div>
                </div>

                <form  class = "button-container" method="post" action="">
                    <input type ="hidden" name="id_value" value ="<?php print $row["image_id"]?>">
                    <input type="submit" name="btn" value="<?php print $display; ?>">
                </form>
                </div>           

       
                       
            <?php
               }
                    
            ?>
                                 
            </div>

        </div>

    
    </body>
</html>
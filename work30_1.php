<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $image_id =
        $image_name = $_POST['input_data'];
        $public_flg =
        $create_date =
        $update_date = date('Ymd');
        
?>






<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_1</title>

        <style>
                h1 {
                    font-size:20px; 
                }

                p {
                    font-size:18px; 
                }


                .box1,
                .box2,
                .box3,
                .box4,
                .box5,
                .box6 {
                    color: #fff;
                    font-weight: bold; 
                    width: 31%;
                    border:1px solid #b7b7b7;
                    margin-right:5px;

                }

                .container {
                    display:flex;
                    flex-wrap: wrap;
                    width:400px;
                    background-color: red;
                }

                .container p {
                    text-align: center;
                    font-size:10px;
                    
                }
                
                .introduce-image {
                    width:100%;

                }
        </style>

    </head>



    <body>

        <form method="post" action="work30_1.php" enctype="multipart/form-data">
            <h1>画像投稿</h1>
            
 


            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>


        <a href="work30_2.php">画像一覧ページへ</a>

        <?php
                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");	
                
                
                //SQL文が送れない（データベースにinsert intoしても反映されない事象が起きた。調査した結果、カラム名「image_id」とかに""を付けてるとダメ。なにも付けないこと！）
                //「 '$image_name'」の「''」を付けないと送信出来るときと出来ない時がある。
                
                $insert = "INSERT INTO gallery ( image_id , image_name, public_flg, create_date, update_date) VALUES ('3', '$image_name', '2', $update_date, '20221010');";
                $result=$db->query($insert);
                $db->close();
        ?>

        <?php
                    if(!isset($_FILES['upload_image'])):
                    print 'ファイル名が入力されていません';
                    exit;
                endif;

                $save = 'img/'.basename($_FILES['upload_image']['name']);

                        if(move_uploaded_file($_FILES['upload_image']['tmp_name'],$save)){
                            print "アップロード完了";
                        }else{
                            print "アップロード失敗";
                        }



        ?>
    
    <?php
            $db = new mysqli($host, $login_user, $password, $database);
            $db->set_charset("utf8");

            $select = "SELECT image_name FROM gallery ;";
            if($result = $db->query($select)){
                // 連想配列を取得
                while ($row = $result->fetch_assoc()) {
                    $get_img_url = 'https://portfolio.dc-itex.com/hachioji/0001/img/'.$row["image_name"];
                    
                }

                $result->close();
            }
            $db->close();	
            
         
    ?>
    



        <div class="container">
            <div class="box1">
            <p><?php print $image_name;?></p>
            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
            </div>

            <div class="box2">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box3">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box4">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box5">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box6">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>
        </div>

    </body>
</html>
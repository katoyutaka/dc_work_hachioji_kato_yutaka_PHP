

<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $image_id = 7777;
        $image_name = $_POST['input_data'];
        $public_flg = 8888;
        $create_date = date('Ymd');
        $update_date = date('Ymd');
        
?>

<!-- 初期化とXSSを防ぐための「エスケープ処理」 2種類（input_data、upload_image）-->
<?php
  $input_data ='';		
  if(isset($_FILES['input_data'])){
    $input_data = htmlspecialchars($_FILES['input_data'], ENT_QUOTES, 'UTF-8');
  }

  $upload_image ='';		
  if(isset($_FILES['upload_image'])){
    $upload_image = htmlspecialchars($_FILES['upload_image'], ENT_QUOTES, 'UTF-8');
  }

?>






<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_1</title>

        <style>
                * {
                    box-sizing:border-box;
              }
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
                    margin-bottom:5px;
                    text-align: center;


                }

                .main {
                    margin-left:50px;
                    width:500px;
                    /* border:1px solid gray; */
                    /* background-color: blue; */
                }

                .contents-container {
                    display:flex;
                    flex-wrap: wrap;
                    /* border:1px solid gray; */
                    margin-top:10px;

                }

                .contents-container p {
                    text-align: center;
                    font-size:10px;
                    
                }
                
                .introduce-image {
                    width:100%;

                }

                .img-container {
                    height:150px;
                    margin-right:20px;
                    margin-left:20px;
                    /* background-color: green; */
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

        </style>

    </head>



    <body>

        <form method="post" action="work30_1.php" enctype="multipart/form-data">
            <h1>画像投稿</h1>

            <!-- エラーメッセージや登録・更新完了メッセージ表示部分 -->
            <?php
                   //「画像名」は半角英数字以外または空白時はエラー表示
                   if(!preg_match("/^[a-zA-Z]+$/",$input_data)|| $input_data==""){
                    $str = "半角英数字以外の形式または入力がされていません";
                    print "<span class='msg'>$str</span>";
                    exit;
                   }
                   //「画像」はjpeg,png以外または空白時はエラー表示
                   if($upload_image==""){
                    $str = "投稿形式が「JPEG」「PNG」以外または画像が選択されていません";
                    print "<span class='msg'>$str</span>";
                    exit;
                   }

                $save = 'img/'.basename($upload_image['name']);

                        if(move_uploaded_file($upload_image['tmp_name'],$save)){
                            $str = "更新完了";
                            print "<span class='msg'>$str</span>";
                        }else{
                            $str = "更新失敗";
                            print "<span class='msg'>$str</span>";
                        }
            ?>
            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>


        <a href="work30_2.php">画像一覧ページへ</a>

        <?php
                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");	
                
                
                //SQL文が送れない（データベースにinsert intoしても反映されない事象が起きた。調査した結果、カラム名「image_id」とかに""を付けてるとダメ。なにも付けないこと！）
                //「 '$image_name'」の「''」を付けないと送信出来るときと出来ない時がある。→変数と文字列なので連結しないと。しかし「'$image_name'」だけ他と連結がちがうのにOKなのはなぜ？
                
                $insert = "INSERT INTO gallery ( image_id, image_name, public_flg, create_date, update_date) VALUES (".$image_id.", '$image_name', ".$public_flg.", ".$create_date." , ".$update_date.");";
                $result=$db->query($insert);
                $db->close();
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
    


        <div class=main>
                <div class="contents-container">
                    <div class="box1">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box2">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box3">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box4">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box5">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box6">
                        <div class=img-container>
                            <p class="title"><?php print $image_name;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                </div>
        </div>
    </body>
</html>
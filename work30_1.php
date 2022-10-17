<!-- 変数の各種詳細 -->
<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $image_id = 7777;
        // $image_name = $input_data;
        $public_flg = 8888;
        $create_date = date('Ymd');
        $update_date = date('Ymd');
        
?>

<!-- 初期化とXSSを防ぐための「エスケープ処理」 2種類（input_data、upload_image）-->
<!-- 「 htmlspecialchars」に配列は使えなく、配列から文字列を取り出して使うようにエラーが出る。 -->
<?php
  $input_data ='';		
  if(isset($_POST['input_data'])){
    $input_data = htmlspecialchars($_POST['input_data'], ENT_QUOTES, 'UTF-8');
}




  $upload_image_name ='';		
  if(isset($_FILES['upload_image']['name'])){
    $upload_image_name = htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
  }

  $upload_image_tmp_name ='';		
  if(isset($_FILES['upload_image']['tmp_name'])){
    $upload_image_tmp_name = htmlspecialchars($_FILES['upload_image']['tmp_name'], ENT_QUOTES, 'UTF-8');
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
                   //「画像名」は半角英数字以外はエラー表示
                   if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data) || $input_data == ""){
                        $str = "「画像名」が半角英数字以外の形式になっています。";
                        print "<span class='msg'>$str</span><br>";
                    //exitをつけると最初からNG状態の表示になり、つけないとマッチ機能が働かない？
                    // exit;
                   }

                   //「画像」はjpeg,png以外はエラー表示
                   if((!preg_match("/\.png$/",$upload_image_name)||!preg_match("/\.jpeg$/",$upload_image_name)) || $upload_image == ""){
                        $str = "「画像」の投稿形式（拡張子）が「JPEG」「PNG」以外になっています。";
                        print "<span class='msg'>$str</span><br>";
                     //exitをつけると最初からNG状態の表示になり、つけないとマッチ機能が働かない？
                    // exit;
                   }


                   //画像のアップロードOK/NGの判定

                   //$upload_imageが配列であることを宣言しないと、$upload_image['tmp_name']の部分で「Illegal string offset」とエラーが出る。
                   //「Illegal string offset」は「配列でない変数に対して、配列のつもりで値を代入してしまうために起こるエラー」のこと。
                //    $upload_image=array();

                   
                   $save = 'img/'.basename($upload_image_name);


                    if(move_uploaded_file($upload_image_tmp_name,$save)){
                        $str = "更新完了しました。";
                        print "<span class='msg'>$str</span><br>";
                    }else{
                        $str = "更新失敗しました。";
                        print "<span class='msg'>$str</span><br>";
                    }
            ?>

            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>


        <a href="work30_2.php">画像一覧ページへ</a>
        
        <!-- データベース（phpmyadmin）にフォームからデータ送信 -->
        <?php
                $db = new mysqli($host, $login_user, $password, $database);
                $db->set_charset("utf8");	
                
                
                //SQL文が送れない（データベースにinsert intoしても反映されない事象が起きた。調査した結果、カラム名「image_id」とかに""を付けてるとダメ。なにも付けないこと！）
                //「 '$image_name'」の「''」を付けないと送信出来るときと出来ない時がある。→変数と文字列なので連結しないと。しかし「'$image_name'」だけ他と連結がちがうのにOKなのはなぜ？
                
                $insert = "INSERT INTO gallery ( image_id, image_name, public_flg, create_date, update_date) VALUES (".$image_id.", '$input_data', ".$public_flg.", ".$create_date." , ".$update_date.");";
                $result=$db->query($insert);
                $db->close();
        ?>


        <!-- データベースからデータを取得して画像表示する -->
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
                            <p class="title"><?php print $input_data;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box2">
                        <div class=img-container>
                            <p class="title"><?php print $input_data;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box3">
                        <div class=img-container>
                            <p class="title"><?php print $input_data;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box4">
                        <div class=img-container>
                            <p class="title"><?php print $input_data;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box5">
                        <div class=img-container>
                            <p class="title"><?php print $input_data;?></p>
                            <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                        </div>
                        <form method="post"  class= "btn-wrapper" action="work30_1.php">
                            <input type="submit" class="flg-button" value="非表示にする" >
                        </form>
                    </div>

                    <div class="box6">
                        <div class=img-container>
                            <p class="title"><?php print $input_data;?></p>
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
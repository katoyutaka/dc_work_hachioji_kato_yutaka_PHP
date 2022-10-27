
<?php
        $host = 'mysql34.conoha.ne.jp'; 
        $login_user = 'bcdhm_hoj_pf0001'; 
        $password = 'Au3#DZ~G';   
        $database = 'bcdhm_hoj_pf0001';

        $public_flg = 0;
        $create_date = date('Ymd');
        $update_date = date('Ymd');
        $error_msg=[];
?>


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

  $image_path ='';		
  if(isset($_FILES['upload_image']['name'])){
    $image_path = 'https://portfolio.dc-itex.com/hachioji/0001/img/'.htmlspecialchars($_FILES['upload_image']['name'], ENT_QUOTES, 'UTF-8');
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

                .box {
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
                    /* background-color: yellowgreen; */

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

 
            <?php
                $db = new mysqli($host, $login_user, $password, $database);
                if($db->connect_error){
                    print $db->connect_error;
                    exit();

                }else{
                    $db->set_charset("utf8");
                }	

                $db->begin_transaction();
                
                if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
                    $str = "「画像名」が半角英数字以外の形式になってるか、入力がされていません。";
                }else{
                    $file=pathinfo($image_path);
                    $filetype=$file["extension"];
                    print $filetype;
                        
                    if(!$filetype==="jpeg"||!$filetype==="png"){
                        $str = "拡張子がJPEGまたはPNG以外の形式になっています。";
                        print "<span class='msg'>$str</span><br>";
                    }else{
                        $insert = "INSERT INTO gallery ( image_name, public_flg, create_date, update_date,image_path) VALUES ('$input_data',".$public_flg.",".$create_date.",".$update_date.",'$image_path');";

                        //ここにすでにデータベースに投稿データがある場合は投稿できないようにするコードを書きたい!!!→トランザクション・ロールバック機能で対応しした。
                        if($result=$db->query($insert)){
                            $save = 'img/'.basename($upload_image_name);
                            move_uploaded_file($upload_image_tmp_name,$save);
                        }else{
                            $error_msg[]="実行エラー".$insert;
                            $db->rollback();
                        }
                        
                        if (count($error_msg) == 0) {
                            $str = "更新成功しました。";
                            print "<span class='msg'>$str</span><br>";
                            $db->commit();

                        }else{
                            $str = "データベースに既に同じファイル名が存在している為か、その他の理由により更新失敗しました。";
                            print "<span class='msg'>$str</span><br>";
                            $db->rollback();

                        }
                    }
                }


                        
                        // $insert = "INSERT INTO gallery ( image_name, public_flg, create_date, update_date) VALUES (".$input_data.", ".$public_flg.", ".$create_date." , ".$update_date.");";
                  
                    
                

                   //画像のアップロードOK/NGの判定

                   //$upload_imageが配列であることを宣言しないと、$upload_image['tmp_name']の部分で「Illegal string offset」とエラーが出る。
                   //「Illegal string offset」は「配列でない変数に対して、配列のつもりで値を代入してしまうために起こるエラー」のこと。
                //    $upload_image=array();
                                        // //「画像」はjpeg,png以外または空白はエラー表示
                        // if((!preg_match("/\.png$/",$upload_image_name)||!preg_match("/\.jpeg$/",$upload_image_name)) || $upload_image == ""){
                        //         $str = "「画像」の投稿形式（拡張子）が「JPEG」「PNG」以外の形式になっているか、選択されていません。";
                        //         print "<span class='msg'>$str</span><br>";
                        //     //  //exitをつけると最初からNG状態の表示になり、つけないとマッチ機能が働かない？
                        //     // exit();
                        // }
                                            
                        //SQL文が送れない（データベースにinsert intoしても反映されない事象が起きた。調査した結果、カラム名「image_id」とかに""を付けてるとダメ。なにも付けないこと！）
                        //「 '$image_name'」の「''」を付けないと送信出来るときと出来ない時がある。→変数と文字列なので連結しないと。しかし「'$image_name'」だけ他と連結がちがうのにOKなのはなぜ？
                        //→→原因判明した！！！まず、$input_dataと$image_pathは文字列なのでシングルまたはダブルクォーテーションをつけなければならないが、$input_dataは先頭でダブルつかっているので、ダブルだと反応してしまうので、シングルでなければならない。
                        //ただし、連結は不要なのか？
                        //update,delete,insertの時は、トランザクション・ロールバック機能をつける。
                        // print "<span class='msg'>$str</span><br>";
                        // exit();
                        //exitをつけると最初からNG状態の表示になり、つけないとマッチ機能が働かない？
                        //                         <!-- 初期化とXSSを防ぐための「エスケープ処理」 2種類（input_data、upload_image）-->
                        // <!-- 「 htmlspecialchars」に配列は使えなく、配列から文字列を取り出して使うようにエラーが出る。 -->


                   

            ?>

            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>


        <a href="work30_2.php">画像一覧ページへ</a>
        



        <div class=main>
            <div class="contents-container"> 
            <!-- データベースからデータを取得して画像表示する -->
            <?php
                    $db = new mysqli($host, $login_user, $password, $database);
                    $db->set_charset("utf8");

                    $select = "SELECT * FROM gallery ;";
                    if($result = $db->query($select)){
                        // 連想配列を取得
                        while ($row = $result->fetch_assoc()) {
                            $get_img_url = $row["image_path"];
                            
            ?>                         
                                <div class="box">
                                    <div class=img-container>
                                        <p class="title"><?php print $row["image_name"];?></p>
                                        <img class="introduce-image" src= "<?php print $get_img_url; ?>" alt="">
                                    </div>

                                    <?php $public_flg = $row["public_flg"];?>
                                    <form method="post"  class= "btn-wrapper" action="work30_1.php">
                                        <?php 
                                        if($public_flg==0){
                                        ?>
                                            <input type="submit" class="flg-button" value="非表示にする" >";
                                        
                                        <?php
                                        }else{
                                        ?>
                                            <input type="submit" class="flg-button" value="表示にする" >";
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </div>     

            <?php
                        }
                        $result->close();
                    }
                    $db->close();	
                    
            ?>
            
            </div>
        </div>
    </body>
</html>
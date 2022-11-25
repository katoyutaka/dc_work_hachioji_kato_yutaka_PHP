
<?php
    
?>



<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_2</title>

        <style>
            h1{
                font-size:20px; 
            }

            p{
            font-size:18px;
            } 
        </style>
        
        
    </head>



    <body>

        <form>
        <h1>画像一覧</h1>



    
        </form>

        <a href="work30_1.php">画像投稿ページへ</a>


    </body>

    
    <!-- 【まとめたらノートに書くメモ部分】 ------------------------------------------------------------------------------------->
     <!-- //$upload_imageが配列であることを宣言しないと、$upload_image['tmp_name']の部分で「Illegal string offset」とエラーが出る。
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
     <!-- 「 htmlspecialchars」に配列は使えなく、配列から文字列を取り出して使うようにエラーが出る。 
     // if (count($validation_errors) == 0 ){だと
// 警告文「Warning: count(): Parameter must be an array or an object that implements Countable」が出る。   -->


</html>
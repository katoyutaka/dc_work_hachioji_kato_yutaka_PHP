<!-- //「画像名」は半角英数字以外または空白はエラー表示
                        if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
                            $str = "「画像名」が半角英数字以外の形式になってるか、入力がされていません。";
                            print "<span class='msg'>$str</span><br>";
                            // exit();
                        //exitをつけると最初からNG状態の表示になり、つけないとマッチ機能が働かない？
                        } -->


<?php

    $input_data=13.5;

    if(!preg_match("/^[a-zA-Z0-9]+$/",$input_data)){
        $str = "「画像名」が半角英数字以外の形式になってるか、入力がされていません。";
        print "<span class='msg'>$str</span><br>";
    }else{
        print "pp";

    }


?>
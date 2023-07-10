
<?php
    $getpage = 0;

    if(isset($_GET["page"])):
        $getpage = $_GET["page"];
    endif;
?>


<?php
    

    $customers = [
        ['name' => '佐藤', 'age' => '10'],
        ['name' => '鈴木', 'age' => '15'],
        ['name' => '高橋', 'age' => '20'],
        ['name' => '田中', 'age' => '25'],
        ['name' => '伊藤', 'age' => '30'],
        ['name' => '渡辺', 'age' => '35'],
        ['name' => '山本', 'age' => '40'],
    ];

//define(); とは定数の設定するメソッドです。
// 定数は、そのプログラム実行中に変化しない値と思ってください。
// 消費税や、円周率など、変わらないような数値を定めます。
// なので、MAXの値を条件によって変える処理はよろしくありません。
    // if($getpage==0||$getpage==1):
    //     define('MAX','3'); 
    // else:
    //     define('MAX','1'); 
    // endif;
    define('MAX','3');


    //下記のページ数を変動させるために使用する変数
    $customers_num = count($customers); // トータルデータ件数

    $max_page = ceil($customers_num / MAX); // トータルページ数



                
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK18</title>
    <style>
        table,
        th,
        td {
            border:solid #333 1px;
        }
    </style>
</head>
    


<body>
    <table>
        <tr>
            <th>名前</th><th>年齢</th>
        </tr>

        <?php
        //配列にない人まで<tr><td></td></tr>が残って表示され変になるので、データがなくなったら、for文から抜けるようにする。
            for($i=0;$i<MAX;$i++):
                if(empty($customers[$getpage*3+$i]["name"])):
                    break;
                endif;
        ?>
        <tr>
            <td><?php print $customers[$getpage*3+$i]["name"]; ?></td>
            <td><?php print $customers[$getpage*3+$i]["age"]; ?></td>
        </tr>
     <?php endfor; ?>
    </table>

<!-- 以下のコードだと「３」と数字が分かっている場合にしか使えないので、変数で作り直す。 -->
<!-- ここで、
 $customers_num = count($customers); // トータルデータ件数
 $max_page = ceil($customers_num / MAX); // トータルページ数を使用する。 -->
 
    <!-- <a href="?page=0">1</a>
    <a href="?page=1">2</a>
    <a href="?page=2">3</a> -->
    <?php for($j=0;$j<$max_page;$j++):?>
            <a href="?page=<?php print $j?>"><?php print $j+1?></a>
         <?php endfor; ?>

         

</body>
</html>
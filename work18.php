

<?php
                // define('MAX','3')をつけて繰り返し文のMAXに設定すると１ページで表示する数を設定できる。検証済み。

                define('MAX','3'); 

                // 【arrayメソッド利用の書き方】
                $customers = [
                    ['name' => '佐藤', 'age' => '10'],
                    ['name' => '鈴木', 'age' => '15'],
                    ['name' => '高橋', 'age' => '20'],
                    ['name' => '田中', 'age' => '25'],
                    ['name' => '伊藤', 'age' => '30'],
                    ['name' => '渡辺', 'age' => '35'],
                    ['name' => '山本', 'age' => '40'],
                ];
                
                //  arrayメソッド利用でも配列初期化利用でもどちらの書き方でもOK！見やすいので配列初期化で書く
                //  【配列の初期化の利用書き方】
                // $customers = array( // 表示データの配列
                //     array('name' => '佐藤', 'age' => '10'),
                //     array('name' => '鈴木', 'age' => '15'),
                //     array('name' => '高橋', 'age' => '20'),
                //     array('name' => '田中', 'age' => '25'),
                //     array('name' => '伊藤', 'age' => '30'),
                //     array('name' => '渡辺', 'age' => '35'),
                //     array('name' => '山本', 'age' => '40'),
                //     );
?>
<?php
                // トータルデータ件数(テキストのcount($books);はcount($customers)では？そもそも$booksとは？)

                $customers_num = count($customers);

                // トータルページ数(テキストのceil($books_num / MAX)はceil($customers_num / MAX)では？そもそも$booksとは？)
                $max_page = ceil($customers_num / MAX); 

                // URLの末尾は「・・・work18.php?page=2」でテキストの「paged=2」は間違いでは？

                // いつもはスーパーグローバル関数を送信する時、<form method="get">として送信していた。今回送る部分がなく、どうやって $_GET['〇〇']をゲットするかというと、
                // URLに「・・・work18.php?page=2」と出るので、そこから取得するということ。具体的には「$GET["page"]」とすればゲット出来る。
                // 「 $_GET['〇〇']」の〇〇が分からなかった！検証した結果、$_GET["paged"]ではNGで$_GET["page"]はOKであった。
                
                // $now_page=$_GET["page"];
                // $prev_page=$now_page-1;
                // $next_page=$now_page+1;

                // 現在のページ数($num),１ページに表示するレコード数($unit),表示対象の全レコード($records)
                // $pagenation['record']・・・現在のページに該当するレコード
                // $pagenation['before']・・・現在のページの前のページ数
                // $pagenation['after']・・・現在のページの後のページ数
                // $pagenation['pagenum']・・・現在のページ数
                // $pagenation['maxpage']・・・全ページ数
                // $pagenation['maxrecord']・・・全レコード数

            
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
    
  <!-- htmlをデザインする方法は３種類あり、１．css作って書く方法。２．headerの中に書く方法。（<style>タグで書く）３．直接書く方法がある。 -->
  <!-- <header>～</header>の中？<head>～</head>の中？自己紹介サイトの時、JavaScriptの<script>～</script>は<head>～</head>の中だった。 -->
  <!-- ちなみに<header>でも<head>でも今回両方試したが、両方ともコーディングできた。 -->


<body>
    <table>
        <tr>
            <th>名前</th><th>年齢</th>
        </tr>

        <?php
            for($i=1;$i<=MAX;$i++):
        ?>
        <tr>
            <td><?php print $customers[$i]["name"]; ?></td>
            <td><?php print $customers[$i]["age"]; ?></td>
        </tr>
     <?php endfor; ?>
    </table>



    <!-- シングルクォーテーションとダブルと区別しないと変なとこで区切られてしまうので注意。 -->
    <!-- もともとは<?php print '<a href="?page=3">3</a>';?>-->

    <?php print '<a href="?page='.($_GET["page"]-1).'">1</a>';?>
    <?php print '<a href="?page='.$_GET["page"].'">2</a>';?>
    <?php print '<a href="?page='.($_GET["page"]+1).'">3</a>';?>

    <?php $data=($_GET["page"]-1)*MAX;
    $slice_data=array_slice($customers,$data,MAX,true);
    // print var_dump($slice_data);

    ?>


    <!-- //   print $prev_page;
    //   print $now_page;
    //   print $next_page;
   
    //   print '<a href="?page=' . $_GET["page"] . '">1</a>';
    //   print '<a href="?page=' . $now_page . '">2</a>';
    //   print '<a href="?page=' . $next_page . '">3</a>';

      //「<<前へ」と「次へ>>」の書き方↓
    //   print '<a href="?page=' . $prev . '">&laquo; 前へ</a>';
    //   print '<a href="?page=' . $next_page . '">次へ &raquo;</a>'; -->


                    


</body>
</html>
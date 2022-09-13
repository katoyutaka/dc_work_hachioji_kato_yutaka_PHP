<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK18</title>
</head>
<body>
<?php
                define('MAX','3'); // 1ページの表示数

                $customers = array( // 表示データの配列
                    array('name' => '佐藤', 'age' => '10'),
                    array('name' => '鈴木', 'age' => '15'),
                    array('name' => '高橋', 'age' => '20'),
                    array('name' => '田中', 'age' => '25'),
                    array('name' => '伊藤', 'age' => '30'),
                    array('name' => '渡辺', 'age' => '35'),
                    array('name' => '山本', 'age' => '40'),
                    );
                    
                // $customers_num = count($books); // トータルデータ件数

                // $max_page = ceil($books_num / MAX); // トータルページ数

                // // データ表示、ページネーションを実装

            ?>

        <table border="1">
            <?php
                 $i = 0;
                 while($i<=7){
             ?>
                    <table border="1">
                    <form method="get">
                    <?php
                        print "<tr><th>".$customers[$i]["name"]."</th><th>".$customers[$i]["age"]."</th></tr>";
                        $i++;
                        }
            ?>
                      <!-- ページのリンク貼るコード -->
                     <?php print '<a href="?page=1">1</a>';?>
                     <?php print '<a href="?page=2">2</a>';?>
                     <?php print '<a href="?page=3">3</a>';?>
                     <?php

            // if(!isset($_GET['page_id'])){ 
            //     $now = 1;
            // }else{
            //     $now = $_GET['page_id'];
            // }
            // for ( $n = 1; $n <= $pages; $n ++){
            //     if ( $n == $now ){
            //         echo "<span style='padding: 5px;'>$now</span>";
            //     }else{
            //         echo "<a href='./home.php?page_id=$n' style='padding: 5px;'>$n</a>";
            //     }
            // }
        ?>
                    </form>
        </table>


<!-- 


         <form method="get">
 
         </form> -->

</body>
</html>
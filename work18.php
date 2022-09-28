
<?php
    $getpage = 0;

    if(isset($_GET["page"])):
        $getpage = $_GET["page"];
    endif;
?>


<?php
    if($getpage==0||$getpage==1):

        define('MAX','3'); 
        $customers = [
            ['name' => '佐藤', 'age' => '10'],
            ['name' => '鈴木', 'age' => '15'],
            ['name' => '高橋', 'age' => '20'],
            ['name' => '田中', 'age' => '25'],
            ['name' => '伊藤', 'age' => '30'],
            ['name' => '渡辺', 'age' => '35'],
            ['name' => '山本', 'age' => '40'],
        ];
    
    else:
        define('MAX','1'); 
        $customers = [
            ['name' => '佐藤', 'age' => '10'],
            ['name' => '鈴木', 'age' => '15'],
            ['name' => '高橋', 'age' => '20'],
            ['name' => '田中', 'age' => '25'],
            ['name' => '伊藤', 'age' => '30'],
            ['name' => '渡辺', 'age' => '35'],
            ['name' => '山本', 'age' => '40'],
        ];

    endif;
                
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
            for($i=0;$i<MAX;$i++):
        ?>
        <tr>
            <td><?php print $customers[$getpage*3+$i]["name"]; ?></td>
            <td><?php print $customers[$getpage*3+$i]["age"]; ?></td>
        </tr>
     <?php endfor; ?>
    </table>


    <a href="?page=0">1</a>
    <a href="?page=1">2</a>
    <a href="?page=2">3</a>
</body>
</html>
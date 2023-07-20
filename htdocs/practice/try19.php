<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY19</title>
</head>
<body>
    <?php
        $fruit = ['りんご', 'ばなな', 'ぶどう', 'もも'];
        $vegetable = ['きゃべつ', 'とまと', 'にんじん', 'なす'];
        $food = array($fruit, $vegetable);
    ?>
    <pre>
        <?php
            print_r($food);
            print($food);
            print $food[0][2];
        ?>
    </pre>
</body>
</html
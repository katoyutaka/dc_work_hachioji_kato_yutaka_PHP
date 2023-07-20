<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY22</title>
</head>
<body>
    <form method="post">
        <?php
            $fp = fopen("file_read.txt", "r");	// ファイルを開く
            // ファイルを一行ずつ取得する
            while ($line = fgets($fp)) {
            print "$line<br>";
        }
            fclose($fp);			// ファイルを閉じる
        ?>
</body>
</html>
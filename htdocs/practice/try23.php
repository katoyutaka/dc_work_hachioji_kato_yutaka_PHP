<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY23</title>
</head>
<body>
    <form method="post">
        <?php
            $fp = fopen("file_write.txt", "w");		// ファイルを開く

            fwrite($fp, 'ファイルへ書き込む');	// ファイルへ書き込む

            fclose($fp);	
        ?>
</body>
</html>
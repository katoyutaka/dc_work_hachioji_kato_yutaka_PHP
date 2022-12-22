
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK100</title>
</head>

<body>
    
<?php
echo '<ul>';
$key=0;
echo '<li>key=0';
echo '<li>empty:'.empty($key);//1
echo '<li>isset:'.isset($key);//1

$key=1;
echo '<li>key=1';
echo '<li>empty:'.empty($key);//何も表示されない。false
echo '<li>isset:'.isset($key);//1

echo '<li>変数が無い';
echo '<li>empty:'.empty($key2);//1
echo '<li>isset:'.isset($key2);//何も表示されない。false
echo '</ul>';
?>
</body>
</html>

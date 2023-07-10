
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



define("DISPLAY","非表示にする");
$DISPLAY = "非表示にする";

print DISPLAY;
print $DISPLAY;

function func(){
    $computer1 = 3;
    $computer2 = 5;


    return array($computer1,$computer2);
}


$a =func();
print $a[0];
print $a[1];




?>

<form  class = "button-container" method="post" action="">
    <input type="submit" name="btn" value="<?php print DISPLAY ?>">
</form>
</body>
</html>

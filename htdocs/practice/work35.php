<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK35</title>
</head>
<body>
    <?php
            $number=rand(1,10);

            function func35($number){
                
                if ($number % 2 == 0){
                    return "偶数であるため10を掛ける".$number*10;
                } else {
                    return "奇数であるため100を掛ける。結果は" .$number*100;
                }
            }
                

       
        $result= func35($number);

        print "乱数の数値は".$number."である。<br>";

        print $result."になります。";

  
    ?>
</body>
</html>
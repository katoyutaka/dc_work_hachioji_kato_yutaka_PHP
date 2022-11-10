<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK35</title>
</head>
<body>
    <?php

            function func35($number){
                
                if ($number % 2 == 0){
                    return $number*10;
                } else {
                    return $number*100;
                }
            }
                

        $number=rand(1,10);
        $result= func35($number);

        print $number."<br>";
        print $result;

  
    ?>
</body>
</html>
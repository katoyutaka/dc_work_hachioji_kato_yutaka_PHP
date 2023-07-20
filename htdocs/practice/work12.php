<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK12</title>
    </head>

    <body>
        <?php
            $number = 1;
            while($number <= 100){

                if($number % 3 == 0){
                    print "Fizz,";
                    $number++;
                }else if($number % 4 == 0){
                     print "Buzz,";
                     $number++;
                }else if($number % 3 == 0 && $number % 4 == 0){
                    print "Fizz Buzz,";
                    $number++;
                } else {
                   print $number.",";
                   $number++;
                } 
            } 
        ?>


        <?php
            $num01 = 1;
            while($num01 <= 9){
                $num02 = 1; 
                while($num02 <= 9){
                    print $num01."*".$num02."=".$num01*$num02.",";
                    $num02++;
                }
                
                $num01++;
                }
        ?>


        <?php
                $i = 1;
                while($i <= 10){
                    print str_repeat("*",$i);
                    print "<p>!</p>";
                    $i++;
                }
        ?>





    </body>
</html>
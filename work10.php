<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK10</title>
    </head>

    <body>
        <?php
            for($number = 1; $number <= 100; $number++){

                if($number % 3 == 0){
                    print "Fizz,";
                } else if($number % 4 == 0){
                     print "Buzz,";
                } else if($number % 3 == 0 && $number % 4 == 0){
                    print "Fizz Buzz,";
                } else {
                   print $number.",";
                }
            }
        ?>

        <?php
            for($num01 = 1; $num01 <= 9; $num01++){
                for($num02 = 1; $num02 <= 9; $num02++){
                    print $num01."*".$num02."=".$num01*$num02.",";
                }
            }
        ?>

        <?php
            for($i = 1; $i <= 10;$i++){
                print str_repeat("*",$i);
                print "<p>!</p>";
            }


        ?>



    </body>
</html>

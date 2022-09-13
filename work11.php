<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK11</title>
    </head>

    <body>
        <?php
            for($number = 1; $number <= 100; $number++):

                if($number % 3 == 0):
                    print "Fizz,";
                elseif($number % 4 == 0):
                     print "Buzz,";
                elseif($number % 3 == 0 && $number % 4 == 0):
                    print "Fizz Buzz,";
                else:
                   print $number.",";
                endif;
            endfor;
        ?>

        <?php
            for($num01 = 1; $num01 <= 9; $num01++):
                for($num02 = 1; $num02 <= 9; $num02++):
                    print $num01."*".$num02."=".$num01*$num02.",";
                endfor;
            endfor;
        ?>

        <?php
            for($i = 1; $i <= 10;$i++):
                print str_repeat("*",$i);
                print "<p>!</p>";
            endfor;


        ?>



    </body>
</html>

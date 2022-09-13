<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK14</title>
    </head>

    <body>
        <?php
            $number = array();

            $i = 0;
            while($i <= 4):
                $number[$i] = rand(1,100);
                print $number[$i].",";
                array_push($number,$number[$i]);
                $i++;
            endwhile;

            // print "<p> $number[0] </p>";
            // print "<p> $number[1] </p>";
            // print "<p> $number[2] </p>";
            // print "<p> $number[3] </p>";
            // print "<p> $number[4] </p>";

           print"<p>------------</p>";
            $i = 0;
            while($i <= 4):
                $number[$i] = rand(1,100);

                if($number[$i] % 2 == 0){
                    print $number[$i]."(偶数),";
                    array_push($number,$number[$i]);
                    $i++;  
                }else{
                    print $number[$i]."(奇数),";
                    array_push($number,$number[$i]);
                    $i++;  
                }
            endwhile;
        ?>
    </body>
</html>
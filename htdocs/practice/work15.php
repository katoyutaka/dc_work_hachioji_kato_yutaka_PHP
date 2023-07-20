<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK15</title>
    </head>

    <body>
        <?php
            $class01 = ["tokugawa","oda","toyotomi","takeda"];
            $class02 = ["minamoto","taira","sugawara","fujiwara"];

            $i = 0;
            while($i <= 3){
                $class01[$i] = rand(1,100);
                $i++;
            }

            $j = 0;
            while($j <= 3){
                $class02[$j] = rand(1,100);
                $j++;
            }
        ?>

        <?php
            $school = array($class01,$class02);

        ?>

        <pre>
            <?php

                if ($school[0][1] > $school[1][2]){
                    print"oda".$school[0][1];
                }else if($school[0][1] < $school[1][2]){
                    print"sugawara".$school[1][2]; 
                }else{
                    print"odaとsugawaraは同点です".$shool[0][1];
                }
            ?>
        </pre>

        <?php
            $mean01 = ($school[0][0] + $school[0][1] + $school[0][2] +$school[0][3]) / 4;
            $mean02 = ($school[1][0] + $school[1][1] + $school[1][2] +$school[1][3]) / 4;

            print "<p>$mean01</p>";
            print "<p>$mean02</p>";
        ?>
    </body>
</html>
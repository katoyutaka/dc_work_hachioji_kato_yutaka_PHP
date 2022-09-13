<!DOCTYPE html>
<html lang="ja">
  
    <head>
        <meta charset="UTF-8">
        <title>TRY11</title>
    </head>

    <body>
            <?php 
                $score = rand(0,100);
                print "<p>\$score:".$score."</p>";
                print '<p>$score == 100 : ';

                var_dump($score == 100);
                print ' </p>';
                print '<p>$score >= 60 : ';
                var_dump($score >= 60);
        
                print '</p>';

                if ($score == 100):
                    print '<p>満点です。</p>';
                elseif ($score >= 60):
                    print '<p>合格です。</p>';
                else:
                    print '<p>不合格です</p>';
                endif;
            ?>
 

    </body>
</html>

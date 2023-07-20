<!DOCTYPE html>
<html lang="ja">
  
    <head>
        <meta charset="UTF-8">
        <title>TRY12</title>
    </head>

    <body>
            <?php 
                $score = rand(0,100);
            ?>
            <p>$score:<?php print $score ?></p>
            <p>$score == 100: <?php var_dump($score == 100);?></p>
            <p>$score >= 60: <?php var_dump($score >= 60);?></p>

            <?php if ($score == 100):?>
                <p>満点です。</p>
            <?php elseif ($score >= 60):?>  
                <p>合格です。</p>   
            <?php else:?>  
                <p>不合格です。</p> 
            <?php endif; ?>


    </body>
</html>

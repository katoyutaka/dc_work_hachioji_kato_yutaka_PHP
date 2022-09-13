<!DOCTYPE html>
<html lang="ja">
  
    <head>
        <meta charset="UTF-8">
        <title>TRY14</title>
    </head>


    <body>
            <?php
                $random = rand(0,4);
                
            ?>

            <p>$random:<?php print $random ?></p>

            <?php switch($random):
                    case 1:?>
                        <p>変数$randomの値は1です。</p>

                <?php 
                    break;
                    case 2:
                ?>

                        <p>変数$randomの値は2です。 </p>
                <?php break; 	//switch文の処理を終了する
                    default: ?>
                        <p>変数$randomの値は1,2ではありません。</p>
      
      
                <?php endswitch; ?>
     </body>
</html>

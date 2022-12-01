<!DOCTYPE html> 
 <html lang="ja"> 
     <head> 
         <meta charset="UTF-8"> 
         <title>OK1130</title>
                <?php 
                $number=$_POST["hidden"];
                ?>


      <style>

            
      </style>
     </head>

    <body>


        <?php
            $i = 1; 
            while($i<=7){
                switch($i){
                    case($number):
                        $flag = "非表示"; 
            
            ?>
                        <div class ="box<?php print $i;?>">
                            <form method ="post" action ="">
                                <input type ="hidden" name="hidden" value ="<?php print $i;?>">
                                <input type="submit" name="btn" value="<?php print $flag; ?>">
                            </form>
                        </div>
                        <?php break;?>

                    <?php 
                    case(!$number):
                        $flag = "表示";
                    ?>
                        <div class ="box<?php print $i;?>">
                            <form method ="post" action ="">
                                <input type ="hidden" name="hidden" value ="<?php print $i;?>">
                                <input type="submit" name="btn" value="<?php print $flag; ?>">
                            </form>
                        </div>
                        <?php break;?>
            <?php
                }
            $i++;
            }
        ?>

    </body>
</html>
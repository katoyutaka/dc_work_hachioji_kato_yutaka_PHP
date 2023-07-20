 
<?php 
    $number=$_POST["hidden"];
    print "非表示にするのは".$number."番です"."<br>";

    if(!empty($number)){
        $color = "";

    } else {
        $color = "red";
    }
    print $color;
?>
        






 <!DOCTYPE html> 
 <html lang="ja"> 
     <head> 
         <meta charset="UTF-8"> 
         <title>test1130</title>



        <style>

  


            <?php

            
            while($j<=3){
            ?>
                .box<?php print $j;?>{
                 background-color:<?php print $color;?>;
            }

           <?php
            $j++;
            $number = "";
        
           }
            ?>




        </style>
     </head>

    <body>

    



        <?php
        $i = 1; 
        while($i<=7){
        ?>

            <div class ="box<?php print $i;?>">

                <form method ="post" action ="">
                <input type ="hidden" name="hidden" value ="<?php print $i;?>">
                <input type="submit" name="btn" value="ひょうじする">
                </form>
                
            </div>
        <?php
        $i++;
        }
        ?>

    </body>
</html>
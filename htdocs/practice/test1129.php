

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>test1129</title>

         <style>
             <?php 
             $i = 4;
             ?>

        .box<?php print $i;?>{
            background-color:red;
        }
        </style>

        

        
    </head>



    <body>



    <div class="box<?php print $i;?>">
        <?php
            $test = $_POST["hidden"];
            print $test;
        ?>

        <form method = "post" action = "">
        <input type = "hidden" name = "hidden" value = "あ">
        <input type = "submit" name = "test" value ="ボタン">
        </form>


    </div>


    </body>

</html>
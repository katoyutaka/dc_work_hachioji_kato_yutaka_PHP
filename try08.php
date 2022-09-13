<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>TRY08</title>
    </head>

    <body>
        <?php
         $fruit01 = "りんご";
         $fruit02 = "バナナ";

         if($fruit01 == "りんご" && $fruit02 == "バナナ"){

            print "<p>fruit01はりんごで、かつ、fruit02バナナです!</p>";
         }

         if($fruit01 == "りんご" || $fruit02 == "バナナ"){

            print "<p>fruit01はりんごで、あるいは、fruit02はバナナです!</p>";
         }

         if($fruit01 == "りんご" && $fruit02 == "バナナ"){

            print "<p>fruit01はりんごで、かつ、バナナです!</p>";
         }

         if(!($fruit01 == "バナナ")){

            print "<p>fruit01はバナナではありません。</p>";
         }

        ?>
        
    </body>
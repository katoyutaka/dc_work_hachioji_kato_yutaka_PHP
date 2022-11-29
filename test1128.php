
<!-- 取得の最大値がMAXとする時 -->

<?php 
 const MAX = 3;
 ?>

<?php

$i =0;
while($i <MAX){


        if($_POST['"on_btn'.$i.'"']=="表示"){
            $bk.$i = "white";
            $msg.$i = "非表示";
        }

        if($_POST['"on_btn'.$i.'"']=="非表示"){
          $bk.$i = "white";
          $msg.$i = "非表示";
         

      }

    $i++;
}

$msg3 = "非表示"
 ?>




<!DOCTYPE html> 
<html lang="ja"> 
  <head> 
    <meta charset="UTF-8"> 
    <title>try1122_1</title>
    <style>


     <?php
     $j =3;

     ?>

      .box1{
       background-color:<?php print $bk1;?>;
      }
     .box2{
       background-color:<?php print $bk2;?>;
      }

     .box3{
       background-color:<?php print $bk3;?>;
      }


      .box1 .box2 .box3{
       display:flex;
       }
    </style>
  </head>
  <body>

<?php


while($i<MAX){
$i = 0;
?>


<div class='"box'.<?php $i; ?>.'"'>
<h1>こんにちは</h1>
</div>


<form method ="post" action ="">
<input type = "submit" name ='"on_btn'.<?php $i; ?> .'"' value ="<?php print $msg.$i; ?>">
</form>

<?php
$i++;
}

?>

<






  </body>
</html>
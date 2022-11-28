

<?php 
$i=1;
while ($i<4){
    $bk.$i="";
    $msg.$i="非表示";
    $i++;
    
} 

?>

<?php 
if($_POST["on_btn1"]=="表示"){
    $bk1 = "white";
    $msg1 = "非表示";
}

if($_POST["on_btn1"]=="非表示"){
    $bk1 = "gray";
    $msg1 = "表示";
}


 ?>


<?php 
if($_POST["on_btn2"]=="表示"){
    $bk2 = "white";
    $msg2 = "非表示";
}

if($_POST["on_btn2"]=="非表示"){
    $bk2 = "gray";
    $msg2 = "表示";
}

 ?>



<?php 
if($_POST["on_btn3"]=="表示"){
    $bk3 = "white";
    $msg3 = "非表示";
}

if($_POST["on_btn3"]=="非表示"){
    $bk3 = "gray";
    $msg3 = "表示";
}
 ?>


<!DOCTYPE html> 
<html lang="ja"> 
  <head> 
    <meta charset="UTF-8"> 
    <title>try1122_1</title>
    <style>
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

<div class="box1">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn1" value ="<?php print $msg1; ?>">
</form>

<div class="box2">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn2" value ="<?php print $msg2; ?>">
</form>


<div class="box3">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn3" value ="<?php print $msg3; ?>">
</form>





   
  </body>
</html>
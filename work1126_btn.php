

<?php 
$i=1;
$bk = array();

while ($i<4){
    $bk[$i]="";
    $msg[$i]="非表示";
    $i++;
    
} 

?>

<?php 
if($_POST["on_btn1"]=="表示"){
    $bk[1]= "white";
    $msg[1]= "非表示";
}

if($_POST["on_btn1"]=="非表示"){
    $bk[1] = "gray";
    $msg[1] = "表示";
}


 ?>


<?php 
if($_POST["on_btn2"]=="表示"){
    $bk[2] = "white";
    $msg[2] = "非表示";
}

if($_POST["on_btn2"]=="非表示"){
    $bk[2] = "gray";
    $msg[2] = "表示";
}

 ?>



<?php 
if($_POST["on_btn3"]=="表示"){
    $bk[3]= "white";
    $msg[3] = "非表示";
}

if($_POST["on_btn3"]=="非表示"){
    $bk[3] = "gray";
    $msg[3] = "表示";
}
 ?>


<!DOCTYPE html> 
<html lang="ja"> 
  <head> 
    <meta charset="UTF-8"> 
    <title>try1122_1</title>
    <style>
     .box1{
       background-color:<?php print $bk[1];?>;
      }

     .box2{
       background-color:<?php print $bk[2];?>;
      }

     .box3{
       background-color:<?php print $bk[3];?>;
      }


      /* /* .box1 .box2 .box3{
       /* display:flex; */
      
    </style>
  </head>
  <body>

<div class="box1">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn1" value ="<?php print $msg[1]; ?>">
</form>

<div class="box2">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn2" value ="<?php print $msg[2]; ?>">
</form>


<div class="box3">
<h1>こんにちは</h1>
</div>

<form method ="post" action ="">
<input type = "submit" name ="on_btn3" value ="<?php print $msg[3]; ?>">
</form>





   
  </body>
</html>
<?php
  $check_data ='';		// 初期化
  if(isset($_POST['check_data'])){
    $check_data = htmlspecialchars($_POST['check_data'], ENT_QUOTES, 'UTF-8');
  }

  $check_data2 ='';		// 初期化
  if(isset($_POST['check_data2'])){
    $check_data2 = htmlspecialchars($_POST['check_data2'], ENT_QUOTES, 'UTF-8');
  }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK21</title>
</head>

<body>
    <form method="post">
        <div>半角アルファベットの大文字と小文字のみ（数字や全角文字などはNG）</div>
        <input type="text" name="check_data" value=<?php print $check_data ?>>
        <input type="submit" value="送信">
    </form>



    <?php 
        if(!preg_match("/^[a-zA-Z]+$/",$check_data)|| $check_data==""){
            print "<div>正しい入力形式ではありません</div>";
        }

        if(preg_match('/dc/',$check_data)){
            print "<div>ディーキャリアが含まれています</div>";
        }

        if(preg_match('/end$/',$check_data)){
            print "<div>終了です！</div>";
        }

    ?>



    <p>-----------------------------------------------</p>
        
    <form method="post">
            <div>携帯電話番号の形式のみ（ハイフンで3文字-4文字-4文字かつ「090 」「080」「070」のみ）</div>
            <input type="text" name="check_data2" value=<?php print $check_data2 ?>>
            <input type="submit" value="送信">
    </form>


    <?php 
            if(!preg_match("/^0[7-9]0-[0-9]{4}-[0-9]{4}$/" ,$check_data2)){
                print "<div>携帯電話番号の形式ではありません</div>";
            }

        ?>
                                  

         
</body>
</html>
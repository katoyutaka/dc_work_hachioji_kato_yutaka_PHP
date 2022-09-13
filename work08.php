<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK08</title>
    </head>

    <body>
        <?php
         $number = rand(1,100);
         print $number;

         switch($number){
            case $number%3 == 0 && $number%6 == 0:
                print "<p>「3と6の倍数です」</p>";
                break;

            case $number%3 == 0 && $number%6 != 0:
                print "<p>「3の倍数で、6の倍数ではありません」</p>";
                break;

            case !$number%3 == 0:
                print "<p>「3の倍数ではありません」</p>";
                break;
            }
         ?>
      
         <?php print "----------------------"; ?>

        <?php
         $random01 = rand(1,10);
         $random02 = rand(1,10);

         if($random01 == $random02){
            switch($random01){
                case $random01 % 3 == 0:
                    print "<p>random01 =".$random01.",random02 =".$random02."です。2つは同じ数です。2つの数字の中には3の倍数が2つ含まれています。</p>";
                    break;

                default:
                    print "<p>random01 =".$random01.",random02 =".$random02."です。2つは同じ数です。2つの数字の中に3の倍数が含まれていません。</p>";
            }
                

         } else {
            switch($random01){
                case $random01 %3 ==0:
                    if($random02 %3 == 0){
                        if($random01 > $random02){
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random01の方が大きいです。2つの数字の中には3の倍数が2つ含まれています。</p>"; 
                        } else {
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random02方が大きいです。2つの数字の中には3の倍数が2つ含まれています。</p>"; 
                        }
                    } else {
                        if($random01 > $random02){ 
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random01の方が大きいです。2つの数字の中には3の倍数が1つ含まれています。</p>"; 
                        } else { 
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random02方が大きいです。2つの数字の中には3の倍数が1つ含まれています。</p>"; 
                        } 
                    }

                default:
                    if($random02 %3 == 0 ){
                        if($random01 > $random02){ 
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random01の方が大きいです。2つの数字の中には3の倍数が1つ含まれています。</p>"; 
                        } else { 
                            print "<p>random01 =".$random01.",random02 =".$random02."です。random02方が大きいです。2つの数字の中には3の倍数が1つ含まれています。</p>"; 
                        } 

                }





        
                }
                
            } else if (!$random01 %3 == 0 && ){
       
            
            } else {
                if($random01 > $random02){ 
                    print "<p>random01 =".$random01.",random02 =".$random02."です。random01の方が大きいです2つの数字の中に3の倍数が含まれていません。</p>"; 
                } else { 
                print "<p>random01 =".$random01.",random02 =".$random02."です。random02方が大きいです。2つの数字の中に3の倍数が含まれていません。</p>"; 
            }

        }
         
    }
        ?> 
        
    </body>

</html>
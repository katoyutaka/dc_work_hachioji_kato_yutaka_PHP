<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_2</title>

        <style>
            h1{
                font-size:20px; 
            }

            p{
            font-size:18px;
            } 
        </style>
        
        
    </head>



    <body>

        <form>
        <h1>画像一覧</h1>

        <?php
            if(!isset($_FILES['upload_image'])):
                print 'ファイルが送信されていません。';
                exit;
            endif;

            print $_FILES['upload_image']['name'];

            $save = 'img/'.basename($_FILES['upload_image']['name']);

                    if(move_uploaded_file($_FILES['upload_image']['tmp_name'],$save)){
                        print "完了";
                    }else{
                        print "失敗";
                    }

        ?>
        </form>

        <a href="work30_1.php">画像投稿ページへ</a>


    </body>
</html>
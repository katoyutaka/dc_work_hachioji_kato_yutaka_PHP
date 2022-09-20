<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
    <body>
    <?php
        //ファイルが送信されていない場合はエラー
        if(!isset($_FILES['upload_image'])){
            print 'ファイルが送信されていません。';
            exit;
        }

        $save = 'img/' . basename($_FILES['upload_image']['name']);

        //ファイルを保存先ディレクトリに移動させる
        if(move_uploaded_file($_FILES['upload_image']['tmp_name'], $save)){
            print 'アップロード成功しました。';
        }else{
            print 'アップロード失敗しました。';
        }
    ?>
    </body>
</html>
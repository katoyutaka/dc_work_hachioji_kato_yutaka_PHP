<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK30_1</title>

        <style>
                h1 {
                    font-size:20px; 
                }

                p {
                    font-size:18px; 
                }


                .box1,
                .box2,
                .box3,
                .box4,
                .box5,
                .box6 {
                    color: #fff;
                    font-weight: bold; 
                    width: 31%;
                    border:1px solid #b7b7b7;
                    margin-right:5px;

                }

                .container {
                    display:flex;
                    flex-wrap: wrap;
                    width:400px;
                    background-color: red;
                }

                .container p {
                    text-align: center;
                    font-size:10px;
                    
                }
        </style>

    </head>



    <body>

        <form method="post" action="work30_2.php" enctype="multipart/form-data">
            <h1>画像投稿</h1>
            <p>画像名：<input type="text" name="input_data"></p>
            <p>画像 : <input type="file" name="upload_image"></p>
            <p><input type="submit" value="画像投稿"></p>
        </form>

        <a href="work30_2.php">画像一覧ページへ</a>


        <div class="container">
            <div class="box1">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box2">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box3">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box4">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box5">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>

            <div class="box6">
            <p>ここに文章</p>
            <img class="introduce-image" src="絶対パス付きファイル名" alt="">
            </div>
        </div>

    </body>
</html>
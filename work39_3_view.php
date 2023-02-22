

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>WORK39_3_view</title>

        <style>
                table,
                th,
                td {
                    border:solid #333 1px;
                }

                table {
                   width: 150px;
                }

                caption {
                    text-align: left;
                }

        </style>

    </head>

    <body>
        <table>
            <caption>商品一覧</caption>

            <tr>
                <th>商品名</th><th>価格</th>
            </tr>

            <?php
              foreach($product_data as $value){  
            ?>
                    <tr>
                        <td><?php print $value["product_name"]; ?></td>
                        <td><?php print $value["price"]; ?></td>
                    </tr>              
            <?php
              }
            ?>
        </table>
    </body>
</html>
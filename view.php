<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>TRY56</title>
  <style type="text/css">
    table, td, th {
      border: solid black 1px;
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
      <th>商品名</th>
      <th>価格</th>
    </tr>
<?php foreach ($product_data as $value) { ?>
    <tr>
      <td><?php print $value['product_name']; ?></td>
      <td><?php print $value['price']; ?></td>
    </tr>
<?php } ?>
  </table>
</body>
</html>
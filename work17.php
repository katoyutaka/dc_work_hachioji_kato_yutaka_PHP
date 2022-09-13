<?php
    $check_box = '';
    if (isset($_POST['check'])) {
        $check_box = htmlspecialchars($_POST["check"], ENT_QUOTES, 'UTF-8');
    }
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WORK17</title>
</head>
<body>
    <form method="post">
        <input type="textbox" name="name_box">
        <br>
        <input type="checkbox" name="check" value="選択肢01" <?php if ($check_box === '選択肢01') { print 'checked'; } ?>>選択肢01
        <input type="checkbox" name="check" value="選択肢02" <?php if ($check_box === '選択肢02') { print 'checked'; } ?>>選択肢02
        <input type="checkbox" name="check" value="選択肢03" <?php if ($check_box === '選択肢03') { print 'checked'; } ?>>選択肢03
        <br>
        <input type="submit" value="送信">
    </form>



    <?php if($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div>選択したチェックボックスは「<?php echo $check_box; ?>」です。</div>
    <?php endif; ?>
</body>
</html>
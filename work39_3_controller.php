

<?php
    require_once("work39_3_model.php");


    $db1 = get_connection();

    $list = get_product_list($db1);

    $db1 = $list[0];
    $sql = $list[1];
    
    $data2 = get_sql_result($db1,$sql);


    include_once("work39_3_view.php");
?>

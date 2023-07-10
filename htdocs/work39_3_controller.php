

<?php
    require_once("work39_3_model.php");

    get_connection();

    get_product_list();

    get_sql_result($db,$sql);

    $product_data = h_array($data);


    include_once("work39_3_view.php");
?>

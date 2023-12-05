<?php
    require_once __DIR__.'/../../include/config/config.php';

    //ログイン状態でcatalog_pageに行くようにセッション変数を入れておく
     $login_user_name = $_SESSION["login_user_name"];
     $sign_up_password_1 = $_SESSION["sign_up_password_1"];

    
    include_once __DIR__.'/../../include/view/complete_sign_up_view.php';

?>
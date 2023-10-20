<?php
    require_once '../include/config/config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

       if(isset($_POST["agree-button"])){
           header('Location:sign_up.php');
           exit();
       }

       if(isset($_POST["resist-button"])){
           header('Location:index.php');
           exit();
       }

   }

    include_once '../../include/view/membership_terms_view.php';

?>

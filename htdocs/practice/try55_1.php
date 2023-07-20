<?php

    session_start();
    $_SESSION["mail"]="abc";
    print session_unset();
    print $_SESSION["mail"];



?>
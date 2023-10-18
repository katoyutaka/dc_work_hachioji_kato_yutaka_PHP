
<?php
       session_start();

       define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
       define("LOGIN_USER",'bcdhm_hoj_pf0001');
       define("PASSWORD",'Au3#DZ~G');
       define("EXPIRATION_PERIOD", 1);

       $cookie_expiration= time()+EXPIRATION_PERIOD*60*60*24;
       $login_user_name = $_SESSION["login_user_name"];


        // function get_connect(){

        //     try{
        //         $db=new PDO(DSN,LOGIN_USER,PASSWORD);
        //         $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //     } catch (PDOException $e){
        //         print $e->getMessage();
        //         exit();
        //     }
        //     return $db;
        // }

?>

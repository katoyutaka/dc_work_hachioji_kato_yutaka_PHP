

<?php
    require_once __DIR__.'/../config/config.php';
    
    //何故かconfig.phpに以下の関数(function get_connect)を持ってくるとエラーになる。なぜ？
        function get_connect(){
            try{
                $db=new PDO(DSN,LOGIN_USER,PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e){
                print $e->getMessage();
                exit();
            }
            return $db;
        }

        
        function logout_delete_cart(){
            $db = get_connect();
            $delete ="DELETE FROM ec_cart_table;";
            $db->query($delete);
        }
                

?>


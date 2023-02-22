
<?php


     function get_connection(){
        define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
        define("LOGIN_USER",'bcdhm_hoj_pf0001');
        define("PASSWORD",'Au3#DZ~G');

        global $db;
             try{
                 $db=new PDO(DSN,LOGIN_USER,PASSWORD);
             } catch (PDOException $e){
                 echo $e->getMessage();
                 exit();
             }
        }


        function get_product_list(){
            global $sql;
            $sql = "SELECT * FROM product";
        }

         function get_sql_result($db,$sql){
            global $result;
            global $data;
          
            $result = $db->query($sql);
            while($row = $result->fetch()){
                $data[]= $row;
            }
         }

         function h($str) {
            return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
          }
       
        function h_array($array) {
            foreach ($array as $keys => $values) {
                foreach ($values as $key => $value) {
                    $array[$keys][$key] = h($value);
                }
            }
            return $array;
        }

    
?>

<?php

?>



<?php


     function get_connection(){
        define("DSN",'mysql:dbname=bcdhm_hoj_pf0001;host=mysql34.conoha.ne.jp');
        define("LOGIN_USER",'bcdhm_hoj_pf0001');
        define("PASSWORD",'Au3#DZ~G');

             try{
                 $db=new PDO(DSN,LOGIN_USER,PASSWORD);
                 return $db;
             } catch (PDOException $e){
                 echo $e->getMessage();
                 exit();
             }
        }


        function get_product_list($db1){
            $sql = "SELECT * FROM product";
            $list[0]=$db1;
            $list[1]=$sql;
            return $list;

        }

         function get_sql_result($db1,$sql){
            $result = $db1->query($sql);
            while($row = $result->fetch()){
                $data1[]= $row;
            }
       
            return $data1;
         }
       

    
?>

<?php

?>


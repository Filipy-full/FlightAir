
<?php
   $db = new SQLite3('../DataBase/aviones.db');


   if(!$db){
       die("Error en connectar a la base de dades");
   }
?>
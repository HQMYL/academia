<?php 

try {

  $con = new PDO("mysql:dbname=alumnos;host=localhost", "root","");
  #$con->query("SET NAMES 'utf-8'");

} catch (Exception $e) {
    echo "No se ha podido conectar con la base de datos";
    exit;
}

return $con;
?>
<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';
$fallo = "Hubo un error inténtalo nuevamente";
$exito = "El tipo de trabajo ha sido registrado exitosamente";
 
$response = "";
$response = array(
    'status' => 0,
    'message' => $fallo
);

$tipo = "";
if(isset($_POST['tipo'])) 
{
    $tipo = $_POST["tipo"];
}

      $stmt = $DB_con->prepare('INSERT INTO tipos_trabajo(tipo_trabajo) VALUES(:tipo)');
      $stmt->bindParam(':tipo',$tipo);
      if($stmt->execute())
      {
        $response['status'] = 1;
    $response['message'] = $exito;
    echo  json_encode($response);
        
      }
      else
      {
        $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
      }








?>

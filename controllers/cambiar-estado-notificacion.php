<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';
$usuario = "";
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];
}

$response = "";
$response = array(
    'status' => 0,
    'message' => 'el envío ha fallado intentalo nuevamente'
);


$id_cotizacion = "";
if(isset($_POST['id_cotizacion'])) 
{
  $id_cotizacion = $_POST['id_cotizacion']; 
}


$leido = "";
$leido = "Si";


  $sql = "UPDATE notificaciones SET leido=:leido WHERE cotizacion_id=:id_cotizacion";

$stmt = $con->prepare($sql);
$stmt->bindParam(':leido', $leido, PDO::PARAM_STR);
$stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_STR);

if ($stmt->execute()) 
{
  $response['status'] = 1;
$response['message'] = "La notificacion ha sido actualizada exitosamente";
}

else 
{

  $response['status'] = 0;
$response['message'] = "Hubo un error,inténtalo nuevamente";

}


 







echo  json_encode($response);




?>

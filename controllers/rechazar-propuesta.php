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


$id_propuesta = "";
if(isset($_POST['id'])) 
{
  $id_propuesta = $_POST['id']; 
}

$id_cotizacion = "";
if(isset($_POST['id_cotizacion'])) 
{
  $id_cotizacion = $_POST['id_cotizacion']; 
}


$estado = "";
$estado = "Rechazada";

$estado_cotizacion = "";
$estado_cotizacion = "Rechazada";


  $sql = "UPDATE solicitudes SET estado_solicitud=:estado WHERE id_solicitud=:id_propuesta";

$stmt = $con->prepare($sql);
$stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
$stmt->bindParam(':id_propuesta', $id_propuesta, PDO::PARAM_STR);

if ($stmt->execute()) 
{

  $sql = "UPDATE cotizaciones SET estado_cotizacion=:estado_cotizacion WHERE id_cotizacion=:id_cotizacion";

$stmt = $con->prepare($sql);
$stmt->bindParam(':estado_cotizacion', $estado_cotizacion, PDO::PARAM_STR);
$stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_STR);

  if ($stmt->execute()) 
{

  $response['status'] = 1;
$response['message'] = "La cotización ha sido rechazada exitosamente";

}
else 
{
  $response['status'] = 0;
$response['message'] = "Hubo un error,inténtalo nuevamente";
}


  
}

else 
{

  $response['status'] = 0;
$response['message'] = "Hubo un error,inténtalo nuevamente";

}
?>
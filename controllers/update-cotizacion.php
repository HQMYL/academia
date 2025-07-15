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


$tiempo_entrega = "";
if(isset($_POST['tiempo_entrega'])) 
{
  $tiempo_entrega = $_POST['tiempo_entrega']; 
}

$costo_total = "";
if(isset($_POST['costo_total'])) 
{
  $costo_total = $_POST['costo_total']; 
}

$detalles = "";
if(isset($_POST['detalles'])) 
{
  $detalles = $_POST['detalles']; 
}


$detalles_estudiante = "";
if(isset($_POST['detalles_estudiante'])) 
{
  $detalles_estudiante = $_POST['detalles_estudiante']; 
}

$titulo_cotizacion = "";
if(isset($_POST['titulo_cotizacion'])) 
{
  $titulo_cotizacion = $_POST['titulo_cotizacion']; 
}

$creador_id = "";
if(isset($_POST['creador_id'])) 
{
  $creador_id = $_POST['creador_id']; 
}

$usuario_id = "";
if(isset($_POST['usuario_id'])) 
{
  $usuario_id = $_POST['usuario_id']; 
}

$propuesta_id = "";
if(isset($_POST['propuesta_id'])) 
{
  $propuesta_id = $_POST['propuesta_id']; 
}

$leido = "";
$leido = "No";

$id = "";
if(isset($_POST['id'])) 
{
    $id = $_POST['id']; 
}

  $sql = "UPDATE cotizaciones SET tiempo_entrega=:tiempo_entrega,costo_total=:costo_total,detalles=:detalles,detalles_estudiante=:detalles_estudiante WHERE id_cotizacion=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':tiempo_entrega', $tiempo_entrega, PDO::PARAM_STR);
$stmt->bindParam(':costo_total', $costo_total, PDO::PARAM_STR);
$stmt->bindParam(':detalles', $detalles, PDO::PARAM_STR);
$stmt->bindParam(':detalles_estudiante', $detalles_estudiante, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);

if ($stmt->execute()) 
{

  $sql = "INSERT INTO notificaciones(creador_id,usuario_id,solicitud_id,cotizacion_id,leido) VALUES (:creador_id,:usuario_id,:propuesta_id,:id,:leido)";

$stmt = $con->prepare($sql);
$stmt->bindParam(':creador_id', $creador_id, PDO::PARAM_STR);
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
$stmt->bindParam(':propuesta_id', $propuesta_id, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->bindParam(':leido', $leido, PDO::PARAM_STR);
if ($stmt->execute()) 
{
  $response['status'] = 1;
$response['message'] = "Los detalles de la cotización han sido actualizados exitosamente";
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


 







echo  json_encode($response);




?>

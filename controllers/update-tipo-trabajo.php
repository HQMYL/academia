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


$tipo = "";
if(isset($_POST['tipo'])) 
{
  $tipo = $_POST['tipo']; 
}

$id = "";
if(isset($_POST['id'])) 
{
    $id = $_POST['id']; 
}

  $sql = "UPDATE tipos_trabajo SET tipo_trabajo=:tipo WHERE id_tipo_trabajo=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

 
$response['status'] = 1;
$response['message'] = "El tipo de trabajo ha sido actualizado exitosamente";


echo  json_encode($response);




?>

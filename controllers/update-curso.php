<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';

$usuario = "";
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];
}

$response = "";
$response = array(
    'status' => 0,
    'message' => 'el envío ha fallado intentalo nuevamente'
);


$nombre = "";
if(isset($_POST['nombre'])) 
{
  $nombre = $_POST['nombre']; 
}

$descripcion = "";
if(isset($_POST['descripcion'])) 
{
  $descripcion = $_POST['descripcion']; 
}

$duracion = "";
if(isset($_POST['duracion'])) 
{
  $duracion = $_POST['duracion']; 
}

$asignado = "";
if(isset($_POST['asignado'])) 
{
  $asignado = $_POST['asignado']; 
}

$id = "";
if(isset($_POST['id'])) 
{
    $id = $_POST['id']; 
}

  $sql = "UPDATE cursos SET nombre_curso=:nombre,descripcion_curso=:descripcion,duracion=:duracion,profesor_asignado=:asignado WHERE id_curso=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
$stmt->bindParam(':duracion', $duracion, PDO::PARAM_STR);
$stmt->bindParam(':asignado', $asignado, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

 
$response['status'] = 1;
$response['message'] = "El curso ha sido actualizado exitosamente";


echo  json_encode($response);




?>

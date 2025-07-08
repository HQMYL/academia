<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
$usuario = "";
if (isset($_SESSION["usuario"])) 
{
  $usuario = $_SESSION["usuario"];
}

$response = "";
$response = array(
    'status' => 0,
    'message' => 'el envío ha fallado intentalo nuevamente'
);


$materia = "";
if(isset($_POST['materia'])) 
{
  $materia = $_POST['materia']; 
}

$id = "";
if(isset($_POST['id'])) 
{
    $id = $_POST['id']; 
}

  $sql = "UPDATE materias SET materia=:materia WHERE id_materia=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':materia', $materia, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

 
$response['status'] = 1;
$response['message'] = "La materia ha sido actualizado exitosamente";


echo  json_encode($response);




?>

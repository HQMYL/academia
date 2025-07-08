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


$nivel = "";
if(isset($_POST['nivel'])) 
{
  $nivel = $_POST['nivel']; 
}

$id = "";
if(isset($_POST['id'])) 
{
    $id = $_POST['id']; 
}

  $sql = "UPDATE niveles_educativos SET nivel_educativo=:nivel WHERE id_nivel=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

 
$response['status'] = 1;
$response['message'] = "El nivel educativo ha sido actualizado exitosamente";


echo  json_encode($response);




?>

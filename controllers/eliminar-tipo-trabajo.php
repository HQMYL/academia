<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';

if (isset($_POST['id'])) 
{
	$id = $_POST['id'];
}

$sql = "DELETE FROM tipos_trabajo WHERE id_tipo_trabajo=:id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_STR); 
$stmt->execute();



?>
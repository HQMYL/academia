<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';

if (isset($_POST['id'])) 
{
	$id = $_POST['id'];
}

$sql = "DELETE FROM solicitudes WHERE id_solicitud=:id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_STR); 
$stmt->execute();



?>
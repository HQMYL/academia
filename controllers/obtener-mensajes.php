<?php
session_start();
var_dump($_SESSION['id_propuesta']);
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexiones.php';
require_once ROOT_PATH .  'config/dbConfig.php';
#require_once ROOT_PATH .  'models/Pagination.class.php';
$whereSQL = "WHERE (a.emisor_id =".$usuario_id." OR a.receptor_id = ".$usuario_id.") AND (a.emisor_id =".$_SESSION['receptor_id']." OR a.receptor_id =".$_SESSION['receptor_id']." ) AND a.id_propuesta = ".$_SESSION['id_propuesta']." ";
$query = "SELECT * FROM mensajes a LEFT JOIN users b ON a.emisor_id = b.id_usuario  $whereSQL ORDER BY a.id_mensaje DESC";
$result = $db->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);  // Send messages as JSON
?>
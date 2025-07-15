<?php
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexiones.php';
require_once ROOT_PATH .  'config/dbConfig.php';
#require_once ROOT_PATH .  'models/Pagination.class.php';
#$whereSQL = "WHERE emisor_id ='".$usuario_id."' OR receptor_id = '".$usuario_id."'";
$query = "SELECT * FROM mensajes a LEFT JOIN users b ON a.emisor_id = b.id_usuario ORDER BY a.id_mensaje DESC";
$result = $db->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);  // Send messages as JSON
?>
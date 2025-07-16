<?php
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexiones.php';
require_once ROOT_PATH .  'config/dbConfig.php';
#require_once ROOT_PATH .  'models/Pagination.class.php';
$query = "SELECT * FROM messages WHERE  ORDER BY id DESC LIMIT 10";
$result = $conn->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);  // Send messages as JSON
?>
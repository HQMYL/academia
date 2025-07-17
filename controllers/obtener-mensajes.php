<?php
session_start();
#var_dump($_SESSION['id_propuesta']);
#var_dump($_SESSION['receptor_id']);
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexiones.php';
require_once ROOT_PATH .  'config/config-chat.php';
#require_once ROOT_PATH .  'models/Pagination.class.php';
#$whereSQL = "WHERE (a.emisor_id =".$usuario_id.") OR (a.receptor_id = ".$usuario_id.")";
#$whereSQL = "WHERE mensajes.emisor_id = {$usuario_id} OR mensajes.receptor_id = {$usuario_id} ";
#$whereSQL = "WHERE (a.emisor_id =".$usuario_id." OR a.receptor_id = ".$usuario_id.") AND (a.emisor_id =".$_SESSION['receptor_id']." OR a.receptor_id =".$_SESSION['receptor_id']." ) AND a.id_propuesta = ".$_SESSION['id_propuesta']." ";
$outgoing_id = $usuario_id;
$incoming_id = $_SESSION['receptor_id'];
  $messages = [];
  $sql = "SELECT * FROM mensajes LEFT JOIN users ON users.id_usuario = mensajes.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY id_mensaje";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) 
        {
           
           $messages[] = $row;
            
        }
    } 

echo json_encode($messages);  // Send messages as JSON
?>
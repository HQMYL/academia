<?php
$conn = new mysqli('localhost', 'root', '', 'alumnos');

$query = "SELECT * FROM mensajes ORDER BY id DESC LIMIT 10";
$result = $conn->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);  // Send messages as JSON
?>
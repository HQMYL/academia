<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'alumnos');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $user = $_POST['user'];

    $query = "INSERT INTO mensajes (emisor_id, mensaje) VALUES ('$user', '$message')";
    $conn->query($query);
}
?>
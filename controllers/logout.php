<?php
	session_start();
include("conexion.php");

$usuario = "";
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];

  
}
else {
   header('Location: ./');
}


session_destroy();

  header("Location: ./");
?>
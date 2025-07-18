<?php
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbConfig.php'; 
$rol = "";
$usuario_id = "";
$foto_perfil = "";
$sth = $con->prepare("SELECT * FROM users WHERE usuario = ?");
$sth->bindParam(1, $_SESSION["usuario"]);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 

   $rol = $row["id_tipo"];
   $usuario_id = $row["id_usuario"];
   $foto_perfil = $row["img"];
   
}
}

$total = "";
$leido = "";
$leido = "No";
$sth = $con->prepare("SELECT COUNT(*) as total FROM notificaciones WHERE usuario_id = ? AND leido = ?");
$sth->bindParam(1, $usuario_id);
$sth->bindParam(2, $leido);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
   $total = $row["total"];
}
}

$activos = "";
$estado_solicitud = "";
$estado_solicitud = "En progreso";
$sth = $con->prepare("SELECT COUNT(*) as total FROM solicitudes WHERE id_asesor = ? OR id_estudiante = ? AND estado_solicitud = ?");
$sth->bindParam(1, $usuario_id);
$sth->bindParam(2, $usuario_id);
$sth->bindParam(3, $estado_solicitud);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
   $activos = $row["total"];
}
}

$total_mensajes = "";
$leido = "";
$leido = "No";
$sth = $con->prepare("SELECT COUNT(*) as total FROM mensajes WHERE
 (outgoing_msg_id OR incoming_msg_id = ?) AND estado = ?
  GROUP BY id_propuesta ");
$sth->bindParam(1, $usuario_id);
$sth->bindParam(2, $leido);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
   $total_mensajes = $row["total"];
}
}


/*if ($rol == "2") 
{
$sth = $con->prepare("SELECT * FROM notificaciones WHERE asesor_id = ?");
$sth->bindParam(1, $usuario_id);

}
elseif ($rol == "3") 
{
   $sth = $con->prepare("SELECT * FROM notificaciones WHERE estudiante_id = ?");
$sth->bindParam(1, $usuario_id);
}

$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 

}
}*/

$logo = "";
$sth = $con->prepare("SELECT * FROM logotipo");
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
   $logo = $row["img"];
}
}


$anno = "";
$anno = date("Y");

?>
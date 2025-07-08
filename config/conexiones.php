<?php
 
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
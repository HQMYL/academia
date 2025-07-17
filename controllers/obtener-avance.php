<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';

$response = "";
$response = array(
    'status' => 0,
    'archivo' => ''
);


$id_asesor = "";
if(isset($_POST['id_asesor'])) 
{
  $id_asesor = $_POST['id_asesor']; 
}

$id_estudiante = "";
if(isset($_POST['id_estudiante'])) 
{
  $id_estudiante = $_POST['id_estudiante']; 
}

$id_propuesta = "";
if(isset($_POST['id_propuesta'])) 
{
  $id_propuesta = $_POST['id_propuesta']; 
}
$archivos = array();
$sth = $con->prepare("SELECT * FROM avances_profesor WHERE id_profesor = ? AND id_estudiante = ? AND id_trabajo = ?");
$sth->bindParam(1, $id_asesor);
$sth->bindParam(2, $id_estudiante);
$sth->bindParam(3, $id_propuesta);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
  $archivos[] = $row["archivo"];
}
}

#$response['archivo'] = $archivos;
echo  json_encode($archivos);

?>

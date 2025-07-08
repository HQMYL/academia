<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';

$usuario = "";
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];
}

$response = "";
$response = array(
    'status' => 0,
    'message' => 'el envío ha fallado intentalo nuevamente'
);


$titulo = "";
if(isset($_POST['titulo'])) 
{
  $titulo = $_POST['titulo']; 
}

$descripcion = "";
if(isset($_POST['descripcion'])) 
{
  $descripcion = $_POST['descripcion']; 
}

$nivel_educativo = "";
if(isset($_POST['cmbnivel'])) 
{
  $nivel_educativo = $_POST['cmbnivel']; 
}

$tipo_trabajo = "";
if(isset($_POST['cmbtipo'])) 
{
  $tipo_trabajo = $_POST['cmbtipo']; 
}

$materia = "";
if(isset($_POST['cmbmateria'])) 
{
  $materia = $_POST['cmbmateria']; 
}

$fecha_limite = "";
if(isset($_POST['fecha'])) 
{
  $fecha_limite = $_POST['fecha']; 
}

$id_asesor = "";
if(isset($_POST['cmbasesor'])) 
{
  $id_asesor = $_POST['cmbasesor']; 
}

$id_estudiante = "";
if(isset($_POST['id_estudiante'])) 
{
  $id_estudiante = $_POST['id_estudiante']; 
}


$id = "";
if(isset($_POST['id_solicitud'])) 
{
    $id = $_POST['id_solicitud']; 
}

  $sql = "UPDATE solicitudes SET titulo=:titulo,nivel_educativo=:nivel_educativo,tipo_trabajo_id=:tipo_trabajo,materia_relacionada=:materia,fecha_limite=:fecha_limite,descripcion=:descripcion,id_asesor=:id_asesor,id_estudiante=:id_estudiante WHERE id_solicitud=:id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
$stmt->bindParam(':nivel_educativo', $nivel_educativo, PDO::PARAM_STR);
$stmt->bindParam(':tipo_trabajo', $tipo_trabajo, PDO::PARAM_STR);
$stmt->bindParam(':materia', $materia, PDO::PARAM_STR);
$stmt->bindParam(':fecha_limite', $fecha_limite, PDO::PARAM_STR);
$stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
$stmt->bindParam(':id_asesor', $id_asesor, PDO::PARAM_STR);
$stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

 
$response['status'] = 1;
$response['message'] = "La solicitud ha sido actualizada exitosamente";


echo  json_encode($response);




?>

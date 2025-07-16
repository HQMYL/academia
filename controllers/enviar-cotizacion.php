<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/dbconfig2.php';

$response = "";
$response = array(
    'status' => 0,
    'message' => 'el envío ha fallado intentalo nuevamente'
);


$tiempo_entrega = "";
if(isset($_POST['tiempo_entrega'])) 
{
  $tiempo_entrega = $_POST['tiempo_entrega']; 
}

$costo_total = "";
if(isset($_POST['costo_total'])) 
{
  $costo_total = $_POST['costo_total']; 
}



$detalles = "";
if(isset($_POST['detalles'])) 
{
  $detalles = $_POST['detalles']; 
}

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
if(isset($_POST['id'])) 
{
    $id_propuesta = $_POST['id']; 
}

$estado = "";
$estado = "Pendiente";


  $stmt = $DB_con->prepare('INSERT INTO cotizaciones(asesor_id,estudiante_id,id_propuesta,estado_cotizacion,tiempo_entrega,costo_total,detalles) VALUES(:id_asesor,:id_estudiante,:id_propuesta,:estado,:tiempo_entrega,:costo_total,:detalles)');
      $stmt->bindParam(':id_asesor',$id_asesor);
      $stmt->bindParam(':id_estudiante',$id_estudiante);
      $stmt->bindParam(':id_propuesta',$id_propuesta);
      $stmt->bindParam(':estado',$estado);
      $stmt->bindParam(':tiempo_entrega',$tiempo_entrega);
      $stmt->bindParam(':costo_total',$costo_total);
      $stmt->bindParam(':detalles',$detalles);
      if($stmt->execute())
      {
        $response['status'] = 1;
        $response['message'] = "La cotización ha sido enviada exitosamente";
        echo  json_encode($response);
        
      }
      else
      {
        $response['status'] = 0;
        $response['message'] = "hubo un error,inténtalo nuevamente";
        echo  json_encode($response);
      }


?>

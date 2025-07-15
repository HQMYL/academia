<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH .  'config/dbconfig2.php';
$fallo = "Hubo un error inténtalo nuevamente";
$exito = "El tipo de trabajo ha sido registrado exitosamente";
 
$response = "";
$response = array(
    'status' => 0,
    'message' => $fallo
);

$emisor_id = "";
if(isset($_POST['emisor_id_chat'])) 
{
    $emisor_id = $_POST["emisor_id_chat"];
}


$receptor_id = "";
if(isset($_POST['receptor_id_chat'])) 
{
    $receptor_id = $_POST["receptor_id_chat"];
}

$id_propuesta = "";
if(isset($_POST['id_propuesta'])) 
{
    $id_propuesta = $_POST["id_propuesta"];
}

$mensaje = "";
if(isset($_POST['mensaje'])) 
{
    $mensaje = $_POST["mensaje"];
}

#var_dump($emisor_id);
#var_dump($receptor_id);
#var_dump($mensaje);
#exit();

$fecha = "";
$fecha = date("Y-m-d");
$estado = "";
$estado = "No";


      $stmt = $DB_con->prepare('INSERT INTO mensajes(emisor_id,receptor_id,fecha,mensaje,id_propuesta,estado) VALUES(:emisor_id,:receptor_id,:fecha,:mensaje,:id_propuesta,:estado)');
      $stmt->bindParam(':emisor_id',$emisor_id);
      $stmt->bindParam(':receptor_id',$receptor_id);
      $stmt->bindParam(':fecha',$fecha);
      $stmt->bindParam(':mensaje',$mensaje);
      $stmt->bindParam(':id_propuesta',$id_propuesta);
      $stmt->bindParam(':estado',$estado);
      if($stmt->execute())
      {
        $response['status'] = 1;
    $response['message'] = $exito;
    #echo  json_encode($response);
        
      }
      else
      {
        $response['status'] = 0;
    $response['message'] = $fallo;
    #echo  json_encode($response);
      }








?>

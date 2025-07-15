<?php
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
#require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';

$usuario = "";
if (isset($_SESSION["usuario"])) 
{
    $usuario = $_SESSION["usuario"];
}

$fallo = "Hubo un error inténtalo nuevamente";
$exito = "El archivo ha sido eliminado correctamente";
$response = array(
  'status' => 0,
  'message' => $fallo
);

// If form is submitted
$errMsg = '';
$valid = 1;


$id = "";
if (isset($_POST["id"])) 
{
   $id = $_POST["id"];
}

$archivo_actual = "";
if (isset($_POST["archivo_actual"])) 
{
   $archivo_actual = $_POST["archivo_actual"];
}

$original = "";

$stmt_edit = $DB_con->prepare('SELECT id_solicitud,archivos FROM solicitudes WHERE id_solicitud =:id');
    $stmt_edit->execute(array(':id'=>$id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);

$original = $edit_row["archivos"];

$original = explode(",", $original);

foreach ($original as  $clave=>$valor) 
{
  if($valor == $archivo_actual) unset($original[$clave]);
}

$original = implode(",", $original);
  # CODIGO PARA ACTUALIZAR

         $stmt = $DB_con->prepare('UPDATE solicitudes 
        
        SET archivos=:original WHERE id_solicitud=:id');
          $stmt->bindParam(':original', $original);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute())
      {
        
        $response['status'] = 1;
        $response['message'] = $exito;

        if ($archivo_actual != "") 
{
unlink("assets/dashboard/dist/img/documentos/".$archivo_actual); 
}
  
  echo  json_encode($response);

    }
  else
    {
    $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
    }


  ?>
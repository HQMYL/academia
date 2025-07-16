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
$exito = "El archivo ha sido actualizado correctamente";
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


  # CODIGO PARA ACTUALIZAR

$imgFile = $_FILES['archivo']['name'];
$tmp_dir = $_FILES['archivo']['tmp_name'];
$imgSize = $_FILES['archivo']['size'];
          
    if($imgFile)
    {
      $carpeta = 'assets/dashboard/dist/img/documentos/';
     if (!file_exists($carpeta)) 
     {
    mkdir($carpeta,0777);
     }
      $upload_dir = $carpeta; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('pdf', 'txt', 'docx', 'pptx','zip','rar','xlsx','jpg','jpeg','png','gif','jfif'); // valid extensions
      $userpic = rand(1000,1000000).".".$imgExt;
      if(in_array($imgExt, $valid_extensions))
      {     
        if($imgSize < 5000000)
        {
          #unlink($upload_dir.$edit_row['img']);
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else
        {
          $errMSG = "El tamaño del archivo debe ser máximo de 5MG";
        }
      }
      else
      {
        $errMSG = "Solo se permiten archivos PDF,TXT,DOCX,PPTX,ZIP,RAR,JPG,JPEG,GIF,PNG,JFIF";    
      } 

       
      $userpic = explode(",", $userpic);
      $final = array();
      $final = array_merge($original,$userpic);
      $final = implode(",", $final);
         $stmt = $DB_con->prepare('UPDATE solicitudes 
        
        SET archivos=:final WHERE id_solicitud=:id');
          $stmt->bindParam(':final', $final);
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


    }


  ?>
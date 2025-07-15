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
$exito = "El archivo ha sido agregado correctamente";
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

$original = "";

$stmt_edit = $DB_con->prepare('SELECT id_solicitud,archivos FROM solicitudes WHERE id_solicitud =:id');
    $stmt_edit->execute(array(':id'=>$id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);

$original = $edit_row["archivos"];
/*$original = "";
$sth = $con->prepare("SELECT * FROM solicitudes WHERE id_solicitud = ?");
 $sth->bindParam(1, $id);
 $sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) {  

  $original = $row["archivos"];

}
}*/
$original = explode(",", $original);


if (empty($original[0]) ) 
{ #SI NO SE HAN AGREGADO ARCHIVOS
  
   
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
      $valid_extensions = array('pdf', 'txt', 'docx','pptx','zip','rar','xlsx','jpg','jpeg','png','gif','jfif'); // valid extensions
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
        $errMSG = "Solo se permiten archivos PDF,TXT,DOCX,PPTX,ZIP,RAR";    
      } 

       # ACTUALIZACIÓN SI SE ENVÍA IMAGEN

         $stmt = $DB_con->prepare('UPDATE solicitudes 
        
        SET archivos=:userpic WHERE id_solicitud=:id');
          $stmt->bindParam(':userpic', $userpic);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute()){
        
                $response['status'] = 1;
$response['message'] = $exito;

echo  json_encode($response);



                
      }
      else
      {
        $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
      }


    }



} #SI NO SE HAN AGREGADO ARCHIVOS

else 
{ # SI YA EXISTEN ARCHIVOS

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
        echo  json_encode($response);

    }
  else
    {
    $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
    }


    }




}# SI YA EXISTEN ARCHIVOS


  ?>
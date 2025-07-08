<?php
session_start();

require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';
$fallo = "Huboun error inténtalo nuevamente";
  $fallo2 = "El tamaño de la foto debe ser máximo de 5MG";
  $fallo3 = "Solo se permiten imágenes JPG,JPEG,PNG,JFIF";
  
 $exito = "El curso ha sido registrado exitosamente";
 
$response = "";
$response = array(
    'status' => 0,
    'message' => $fallo
);

$codigo = "";
$codigo = mt_rand(1000,1000000);


$nombre = "";
if(isset($_POST['nombre'])) 
{
    $nombre = $_POST["nombre"];
}

$descripcion = "";
if(isset($_POST['descripcion'])) 
{
    $descripcion = $_POST["descripcion"];
}


$duracion = "";
if(isset($_POST['duracion'])) 
{
    $duracion = $_POST["duracion"];
}

$profesor_asignado = "";
if(isset($_POST['cmbusuario'])) 
{
    $profesor_asignado = $_POST["cmbusuario"];
}

#if(isset($_POST['btnsave']))
 # {
    
    
    /*else if(empty($imgFile)){
      $errMSG = "Please Select Image File.";
    }*/
    #else
    #{
    /* $imgFile = $_FILES['archivo']['name'];
    $tmp_dir = $_FILES['archivo']['tmp_name'];
    $imgSize = $_FILES['archivo']['size'];
    $carpeta = 'dist/img/cursos/';
     if (!file_exists($carpeta)) 
     {
       mkdir($carpeta,0777);
     }
      $upload_dir = $carpeta; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','jfif'); // valid extensions
    
      // rename uploading image
      $userpic = mt_rand(1000,1000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions))
      {     
        // Check file size '5MB'
        if($imgSize < 5000000)
        {
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else
        {
            $response['status'] = 0;
            $response['message'] = $fallo2;
            echo  json_encode($response);
        }
      }
      else
      {
        $errMSG = "Solo se permiten  archivos JPG,JPEG,PNG,GIF,JFIF";    
      }
    #}
    
    if (empty($imgFile)) 
    {
      $userpic = "user-default.png";
    } */
    
    /* if(!isset($errMSG))
    { */
      $stmt = $DB_con->prepare('INSERT INTO cursos(nombre_curso,descripcion_curso,duracion,profesor_asignado) VALUES(:nombre,:descripcion,:duracion,:profesor_asignado)');
      $stmt->bindParam(':nombre',$nombre);
      $stmt->bindParam(':descripcion',$descripcion);
      $stmt->bindParam(':duracion',$duracion);
      $stmt->bindParam(':profesor_asignado',$profesor_asignado);
      if($stmt->execute())
      {
        $response['status'] = 1;
    $response['message'] = $exito;
    echo  json_encode($response);
        #$successMSG = "new record succesfully inserted ...";
        #header("refresh:5;index.php"); // redirects image view page after 5 seconds.

       
     
    
      }
      else
      {
        $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
      }
    /* } */
  #}








?>

<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexion.php");
include("dbconfig2.php");


$usuario = "";
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
}

$fallo = "Hubo un error inténtalo nuevamente";
$exito = "El evento ha sido actualizado correctamente";
$response = array(
  'status' => 0,
  'message' => $fallo
);

// If form is submitted
$errMsg = '';
$valid = 1;

$album = "";
if(isset($_POST['album']) ) 
{

    $album = $_POST['album'];
 
}

$imagen_actual = "";
if (isset($_POST["imagen_actual"])) 
{
   $imagen_actual = $_POST["imagen_actual"];
}

$id = "";
if (isset($_POST["id"])) 
{
   $id = $_POST["id"];
}


/*$stmt_edit = $DB_con->prepare('SELECT id,img FROM users WHERE id =:uid');
    $stmt_edit->execute(array(':uid'=>$id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);*/

# CODIGO PARA ACTUALIZAR

$imgFile = $_FILES['archivo']['name'];
$tmp_dir = $_FILES['archivo']['tmp_name'];
$imgSize = $_FILES['archivo']['size'];
          
    if($imgFile)
    {
      $carpeta = 'img/albumes/';
     if (!file_exists($carpeta)) 
     {
    mkdir($carpeta,0777);
     }
      $upload_dir = $carpeta; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','jfif'); // valid extensions
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
          $errMSG = "El tamaño de la foto debe ser máximo de 5MG";
        }
      }
      else
      {
        $errMSG = "Solo se permiten archivos JPG,JPEG,GIF,PNG,JFIF";    
      } 

       # ACTUALIZACIÓN SI SE ENVÍA IMAGEN

         $stmt = $DB_con->prepare('UPDATE albumes 
        
        SET album=:album,img=:userpic WHERE id=:id');
          $stmt->bindParam(':album', $album);
          $stmt->bindParam(':userpic', $userpic);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute()){
        
                $response['status'] = 1;
$response['message'] = $exito;

echo  json_encode($response);
if ($imagen_actual != "") 
{
unlink("img/albumes/$imagen_actual"); 
}


                
      }
      else{
        $response['status'] = 0;
    $response['message'] = $fallo;
    echo  json_encode($response);
      }



       #ACTUALIZACIÓN SI SE ENVÍA IMAGEN 
      



    }
    else
    { // ACTUALIZACIÓN SI NO SE ENVÍA IMAGEN 

      $stmt = $DB_con->prepare('UPDATE albumes 
        
        SET album=:album WHERE id=:id');
          $stmt->bindParam(':album', $album);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute()){
        
                $response['status'] = 1;
$response['message'] = $exito;

echo  json_encode($response);



                
      }
      else{
        $response['status'] = 0;
    $response['message'] = $fallo2;
    echo  json_encode($response);
      }



      
    } // ACTUALIZACIÓN SI NO SE ENVÍA IMAGEN 
            
    
    
  
?>
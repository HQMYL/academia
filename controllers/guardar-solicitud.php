<?php
session_start();

require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';

$uploadDir = 'assets/dashboard/dist/img/documentos/';
$allowTypes = array('pdf','xlsx','pptx','docx','txt','zip','rar');
$fallo = "Huboun error inténtalo nuevamente";
  $fallo2 = "El tamaño del archivo debe ser máximo de 5MG";
  $fallo3 = "Solo se permiten archivos PDF,DOCX,XLSX,PPTX,ZIP,RAR,TXT";
  
 $exito = "La solicitud ha sido registrada exitosamente";
 
$response = "";
$response = array(
    'status' => 0,
    'message' => $fallo
);

$codigo = "";
$codigo = mt_rand(1000,1000000);


$titulo = "";
if(isset($_POST['titulo'])) 
{
    $titulo = $_POST["titulo"];
}

$nivel_educativo = "";
if(isset($_POST['cmbnivel'])) 
{
    $nivel_educativo = $_POST["cmbnivel"];
}

$tipo_trabajo = "";
if(isset($_POST['cmbtipo'])) 
{
    $tipo_trabajo = $_POST["cmbtipo"];
}

$materia = "";
if(isset($_POST['cmbmateria'])) 
{
    $materia = $_POST["cmbmateria"];
}

$fecha_limite = "";
if(isset($_POST['fecha'])) 
{
    $fecha_limite = $_POST["fecha"];
}

$descripcion = "";
if(isset($_POST['descripcion'])) 
{
    $descripcion = $_POST["descripcion"];
}

$id_estudiante = "";
if(isset($_POST['id_estudiante'])) 
{
    $id_estudiante = $_POST["id_estudiante"];
}

$filesArr = $_FILES["archivo"];

 $fileNames = array_filter($filesArr['name']);
        
       
        $uploadedFile = '';
        if(!empty($fileNames)){ //SUBIDA DE ARCHIVOS
          $uploadStatus = 1;
            foreach($filesArr['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($filesArr['name'][$key]);
                $imgExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                 
                 $fileName = mt_rand(1000,1000000).".".$imgExt; 
                $targetFilePath = $uploadDir . $fileName; 
                 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to server 
                    if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){ 
                        $uploadedFile .= $fileName.',';
                    }else{ 
                        $uploadStatus = 0;
                        $response['message'] = 'Lo Sentimos hubo un error al subir tu Archivo.';
                    } 
                }else{ 
                    $uploadStatus = 0;
                    $response['message'] = "Solo se permiten archivos JPG,JPEG,GIF,PNG y JFIF";
                } 
            } 
        } //SUBIDA DE FOTOS DE USUARIOS

       $uploadedFileStr = trim($uploadedFile, ',');
if($uploadStatus == 1)
{ #SI LA SUBIDA FUE EXITOSA

  $stmt = $DB_con->prepare('INSERT INTO solicitudes(titulo,nivel_educativo,tipo_trabajo_id,materia_relacionada,fecha_limite,descripcion,id_estudiante,archivos) VALUES(:titulo,:nivel_educativo,:tipo_trabajo,:materia,:fecha_limite,:descripcion,:id_estudiante,:uploadedFileStr)');
      $stmt->bindParam(':titulo',$titulo);
      $stmt->bindParam(':nivel_educativo',$nivel_educativo);
      $stmt->bindParam(':tipo_trabajo',$tipo_trabajo);
      $stmt->bindParam(':materia',$materia);
      $stmt->bindParam(':fecha_limite',$fecha_limite);
      $stmt->bindParam(':descripcion',$descripcion);
      $stmt->bindParam(':id_estudiante',$id_estudiante);
      $stmt->bindParam(':uploadedFileStr',$uploadedFileStr);
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


} #SI LA SUBIDA FUE EXITOSA


      
    ?>
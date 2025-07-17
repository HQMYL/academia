<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH .  'config/conexiones.php';
require_once ROOT_PATH .  'config/dbconfig2.php';
require_once ROOT_PATH .  'models/mpdf/autoload.php';

$id_profesor = "";
if (isset($_REQUEST["id_profesor"])) 
{
  $id_profesor = $_REQUEST["id_profesor"];
}

$id_estudiante = "";
if (isset($_REQUEST["id_estudiante"])) 
{
  $id_estudiante = $_REQUEST["id_estudiante"];
}

$id_propuesta = "";
if (isset($_REQUEST["id_propuesta"])) 
{
  $id_propuesta = $_REQUEST["id_propuesta"];
}

$imgFile = $_FILES['archivo']['name'];
    $tmp_dir = $_FILES['archivo']['tmp_name'];
    $imgSize = $_FILES['archivo']['size'];
    $carpeta = 'assets/dashboard/dist/avances/';
     if (!file_exists($carpeta)) 
     {
       mkdir($carpeta,0777);
     }
      $upload_dir = $carpeta; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('pdf'); // valid extensions
    
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
        $errMSG = "Solo se permiten  archivos PDF";    
      }

    if (!isset($errMSG)) 
    { #SI NO HUBO ERROR EN LA SUBIDA DEL ARCHIVO
      
     $stmt = $DB_con->prepare('INSERT INTO avances_profesor(id_profesor,id_estudiante,id_trabajo,archivo) VALUES(:id_profesor,:id_estudiante,:id_propuesta,:userpic)');
      $stmt->bindParam(':id_profesor',$id_profesor);
      $stmt->bindParam(':id_estudiante',$id_estudiante);
      $stmt->bindParam(':id_propuesta',$id_propuesta);
      $stmt->bindParam(':userpic',$userpic);
      if($stmt->execute())
      {
        $response['status'] = 1;
    $response['message'] = "El avance ha sido registrado correctamente";
    echo  json_encode($response);
        
      }
      else
      {
        $response['status'] = 0;
    $response['message'] = "Hubo un error,inténtalo nuevamente";
    echo  json_encode($response);
      }



    }#SI NO HUBO ERROR EN LA SUBIDA DEL ARCHIVO
     



// Cargar el archivo PDF existente
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$pagecount = $mpdf->SetSourceFile($carpeta.$userpic);

// Importar todas las páginas
for ($i = 1; $i <= $pagecount; $i++) {
    $tplId = $mpdf->ImportPage($i);
    $size = $mpdf->getTemplateSize($tplId);
    $mpdf->addPage('P', '', '', '', '',
        $size['width'], $size['height'], 0, 0, 0, 0);
    #$mpdf->addPage();
    $mpdf->UseTemplate($tplId);

    // Configurar la marca de agua
    $mpdf->SetWatermarkText('TEXTO DE PRUEBA'); // Texto de la marca de agua
    $mpdf->watermarkTextAlpha = 0.5; // Ajustar la transparencia (0.1 = 10%)
    $mpdf->showWatermarkText = true; // Mostrar la marca de agua
    $mpdf->watermarkImageAlpha = 0.5;
}
// ÚLTIMA SECCIÓN
$mpdf->Output($carpeta.$userpic.'.pdf',\Mpdf\Output\Destination::FILE);
#$mpdf->Output($comprador.'.pdf','I');
?>
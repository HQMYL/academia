<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH .  'config/conexiones.php';
require_once ROOT_PATH .  'models/mpdf/autoload.php';

$id = "";
if (isset($_REQUEST["id"])) 
{
  $id = $_REQUEST["id"];
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
      
     $stmt = $DB_con->prepare('INSERT INTO avances_profesor(id_profesor,id_trabajo,archivo) VALUES(:id_profesor,id_trabajo,userpic)');
      $stmt->bindParam(':id_profesor',$id_profesor);
      $stmt->bindParam(':id_trabajo',$id_trabajo);
      $stmt->bindParam(':userpic',$userpic);
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



    }#SI NO HUBO ERROR EN LA SUBIDA DEL ARCHIVO
     



// Cargar el archivo PDF existente
$pagecount = $mpdf->SetSourceFile('ruta/al/archivo.pdf');

// Importar todas las páginas
for ($i = 1; $i <= $pagecount; $i++) {
    $tplId = $mpdf->ImportPage($i);
    $size = $mpdf->getTemplateSize($tplId);
    $mpdf->addPage('P', '', '', '', '',
        $size['w'], $size['h'], 0, 0, 0, 0);
    $mpdf->UseTemplate($tplId);

    // Configurar la marca de agua
    $mpdf->SetWatermarkText('Borrador'); // Texto de la marca de agua
    $mpdf->watermarkTextAlpha = 0.1; // Ajustar la transparencia (0.1 = 10%)
    $mpdf->showWatermarkText = true; // Mostrar la marca de agua
    $mpdf->watermarkImageAlpha = 0.5;
}
// ÚLTIMA SECCIÓN
$mpdf->Output('uploads/compras/'.$comprador.'.pdf',\Mpdf\Output\Destination::FILE);
#$mpdf->Output($comprador.'.pdf','I');
?>
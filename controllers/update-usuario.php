<?php
session_start();

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbconfig2.php';
$usuario = "";
if (isset($_SESSION["usuario"])) 
{
    $usuario = $_SESSION["usuario"];
}

$response = array(
  'status' => 0,
  'message' => "El envío ha Fallado, inténtalo nuevamente"
);

// If form is submitted
#$errMSG = '';
$valid = 1;

$nombre = "";
if(isset($_POST['nombre'])) 
{
    $nombre = $_POST["nombre"];
}

$apellidos = "";
if(isset($_POST['apellidos'])) 
{
    $apellidos = $_POST["apellidos"];
}


$dir = "";
if(isset($_POST['dir'])) 
{
    $dir = $_POST["dir"];
}

$correo = "";
if(isset($_POST['correo'])) 
{
    $correo = $_POST["correo"];
}

$tel = "";
if(isset($_POST['tel'])) 
{
    $tel = $_POST["tel"];
}

$movil = "";
if(isset($_POST['movil'])) 
{
    $movil = $_POST["movil"];
}

$user = "";
if(isset($_POST['user'])) 
{
    $user = $_POST['user'];
}

$pass = "";
if(isset($_POST['pass11'])) 
{
    $pass = $_POST['pass11'];
    $pass = md5($pass);
}

if (empty($_POST['pass11'])) 
{
  $pass = $_POST['pass'];
}


$rol = "";
if(isset($_POST['cmbrol'])) 
{
    $rol = $_POST['cmbrol'];
}

$estado = "";
if(isset($_POST['cmbestado'])) 
{
    $estado = $_POST['cmbestado'];
}



$id = "";
if (isset($_POST["id"])) 
{
   $id = $_POST["id"];
}

$imagen_actual = "";
if (isset($_POST["imagen_actual"])) 
{
   $imagen_actual = $_POST["imagen_actual"];
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
       #ACTUALIZACIÓN SI SE ENVÍA IMAGEN 
    {  
      $upload_dir = 'assets/dashboard/dist/img/users/'; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','jfif'); // valid extensions
      $userpic = mt_rand(1000,1000000).".".$imgExt;
      if(in_array($imgExt, $valid_extensions))
      {     
        if($imgSize < 5000000)
        {
          #unlink($upload_dir.$edit_row['img']);
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else
        {
          $errMSG = "El archivo debe ser máximo de 5 MG";
        }
      }
      else
      {
        $errMSG = "Solo se permiten archivos JPG, JPEG, PNG & GIF";    
      }

if(!isset($errMSG))
    { #INICIO !ISSET ERRMSG
     
     $stmt = $DB_con->prepare('UPDATE users 
        
        SET nombre=:nombre,apellidos=:apellidos,direccion=:dir,correo=:correo,telefono=:tel,movil=:movil,usuario=:user,pass=:pass,id_tipo=:rol,id_estado_usuario=:estado,img=:userpic WHERE id_usuario=:id');
          $stmt->bindParam(':nombre', $nombre);
          $stmt->bindParam(':apellidos', $apellidos);
          $stmt->bindParam(':dir', $dir);
          $stmt->bindParam(':correo',$correo);
          $stmt->bindParam(':tel', $tel);
          $stmt->bindParam(':movil',$movil);
          $stmt->bindParam(':user', $user);
          $stmt->bindParam(':pass', $pass);
          $stmt->bindParam(':rol', $rol);
          $stmt->bindParam(':estado', $estado);
          $stmt->bindParam(':userpic', $userpic);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute()){
        
                $response['status'] = 1;
$response['message'] = 'Usuario actualizado correctamente';


if ($imagen_actual != "") 
{
unlink("assets/dashboard/dist/img/users/".$imagen_actual); 
}


                
      }
      else{
        $response['status'] = 0;
    $response['message'] = "Hubo un error inténtalo nuevamente";
    
      }


  echo  json_encode($response);


    } #FINAL !ISSET ERRMSG



} # ACTUALIZACIÓN SI SE ENVÍA IMAGEN

else
    { // ACTUALIZACIÓN SI NO SE ENVÍA IMAGEN 

      $stmt = $DB_con->prepare('UPDATE users 
        
        SET nombre=:nombre,apellidos=:apellidos,direccion=:dir,correo=:correo,telefono=:tel,movil=:movil,usuario=:user,pass=:pass,id_tipo=:rol,id_estado_usuario=:estado WHERE id_usuario=:id');
          $stmt->bindParam(':nombre', $nombre);
          $stmt->bindParam(':apellidos', $apellidos);
          $stmt->bindParam(':dir', $dir);
          $stmt->bindParam(':correo',$correo);
          $stmt->bindParam(':tel', $tel);
          $stmt->bindParam(':movil',$movil);
          $stmt->bindParam(':user', $user);
          $stmt->bindParam(':pass', $pass);
          $stmt->bindParam(':rol', $rol);
          $stmt->bindParam(':estado', $estado);
          $stmt->bindParam(':id', $id);
        
      if($stmt->execute())
      {    
        $response['status'] = 1;
        $response['message'] = 'Usuario actualizado correctamente';         
      }
      else
      {
        $response['status'] = 0;
        $response['message'] = "Hubo un error inténtalo nuevamente";
      }


        echo  json_encode($response);


      
    } // ACTUALIZACIÓN SI NO SE ENVÍA IMAGEN
    

?>
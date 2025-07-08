<?php
require_once __DIR__ . '/../init.php';                 // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';        // Carga la conexión
$status = "En linea";

$mensaje = "";
$mensaje = "El usuario y/o contraseña son incorrectos, ingrésalos nuevamente";

$response = "";
$response = array(
    'status' => 0,
    'message' => "",
    'identificador' => "",
    'nombre_usuario' => ""
);


$usuario = "";

if (isset($_POST["user"])) 
{
$usuario = $_POST["user"];
}

$pass = "";
if (isset($_POST["pass"])) 
{
    $pass = $_POST["pass"];
    $pass = md5($pass);
}

$estado = "";
$estado = "1";

 $x = $con->prepare("SELECT * FROM users WHERE usuario= ? AND pass= ? AND id_estado_usuario = ?");
$x->bindParam(1, $usuario);
$x->bindParam(2, $pass);
$x->bindParam(3, $estado);

$x->execute();

if ($x->rowCount() > 0) {
       session_start();
       $_SESSION["usuario"] = $usuario;
       $response['status'] = 1;
       
       echo  json_encode($response);


}

else {
    $_SESSION["mensaje"] = $mensaje;
    $response['status'] = 0;
    $response['message'] = $mensaje;
    echo  json_encode($response);
}
    
exit();

?>


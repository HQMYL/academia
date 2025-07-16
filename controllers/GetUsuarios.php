<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbConfig.php';
require_once ROOT_PATH .  'models/Pagination.class.php';
$usuario = "";

if (isset($_SESSION["usuario"])) 
{
  $usuario = $_SESSION["usuario"];
}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php


#if ($rol == "Administrador") {  VALIDACIÓN SI EL USUARIO ES ADMINISTRADOR
  if(isset($_POST['page'])){
    // Include pagination library file
    
  // Set some useful configuration
  $baseURL = BASE_URL .'getUsuario';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND (nombre LIKE '%".$_POST['keywords']."%' || apellidos LIKE '%".$_POST['keywords']."%' || correo LIKE '%".$_POST['keywords']."%' || movil LIKE '%".$_POST['keywords']."%')  ";
    }

    if(!empty($_POST['rol']))
    {
        $whereSQL = $whereSQL." AND id_tipo LIKE '%".$_POST['rol']."%' ";
    }

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM users ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainer',
    'link_func' => 'searchFilter_usuario'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT a.*,b.* FROM users a LEFT JOIN roles b ON a.id_tipo = b.id_rol  $whereSQL ORDER BY id_usuario ASC LIMIT $offset,$limit");
?>
    <!-- Data list container -->
    
    
        <?php
        if($query->num_rows > 0){?>

          <table class="table table-hover table-bordered">
    <thead>
<tr>
<th>Nombre</th>
<th>Correo</th>
<th>Móvil</th>
<th>Tipo</th>
<th>Editar</th>
<th>Eliminar</th>
</tr>
</thead>
<tbody>
      <?php
            while($row = $query->fetch_assoc()){
                $offset++
        ?>
<tr>
<td><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></td>
<td><?= $row["correo"]; ?></td>
<td><?= $row["movil"]; ?></td>
<td><?= $row["rol"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_usuario" data-id="<?= $row['id_usuario'];?>" data-nombre="<?= $row['nombre'];?>" data-apellidos="<?= $row['apellidos'];?>" data-dir="<?= $row['direccion'];?>" data-correo="<?= $row['correo'];?>" data-tel="<?= $row['telefono'];?>" data-movil="<?= $row['movil'];?>" data-usuario="<?= $row['usuario'];?>" data-pass="<?= $row['pass'];?>" data-rol="<?= $row['id_tipo'];?>" data-estado="<?= $row['id_estado_usuario'];?>" data-img="<?= $row['img'];?>"><i class='fas fa-edit'></i></button></td>
<td><button type="button" class="btn btn-danger delete_usuario"  data-id="<?= $row['id_usuario'];?>"><i class='fas fa-trash-alt'></i></button></td>
</tr>
            <?php
                    }
        
        }
        else
        {
            echo '<tr><td colspan="6"><h2>No hay registros</h2></td></tr>';
        }
        ?>
    </tbody>
    </table>

  <script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_usuario").on("click",function()
 {

  var id = $(this).attr("data-id");
  var codigo = $(this).attr("data-codigo");
  var nombre = $(this).attr("data-nombre");
  var apellidos = $(this).attr("data-apellidos");
  var dir = $(this).attr("data-dir");
  var correo = $(this).attr("data-correo");
  var tel = $(this).attr("data-tel");
  var movil = $(this).attr("data-movil");
  var usuario = $(this).attr("data-usuario");
  var pass = $(this).attr("data-pass");
  var rol = $(this).attr("data-rol");
   var estado = $(this).attr("data-estado");
   var img = $(this).attr("data-img");
   
  //numeros_contacto = numeros_contacto.split(',');
  
  
  $("#id_usuario").val(id);
  $("#nombre").val(nombre);
  $("#apellidos").val(apellidos);
  $("#dir").val(dir);
  $("#correo").val(correo);
  $("#tel").val(tel);
  $("#movil").val(movil);
  $("#user2").val(usuario);
  $("#pass0").val(pass);
  $('#cmbrol option[value="'+rol+'"]').attr("selected", true);
  $('#cmbestado option[value="'+estado+'"]').attr("selected", true);
  $("#img").attr("src","assets/dashboard/dist/img/users/"+img);
  $("#imagen_actual").val(img);
  

  $("#myModalActualizarUsuario").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_usuario").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este usuario ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#bb414d', 
    cancelButtonColor:  '#337AFF',
    cancelButtonText: 'Cerrar',
    confirmButtonText: 'Eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({

           type: "POST",
           url: BASE_URL + 'eliminar-user',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Usuario eliminado correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});



});
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#user").keyup(function(){

          var id = $("#user").val();
    
       $.ajax({

           type: "POST",
           url:"comprobacion.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {
            
            $("#comprobar").html(response);
            
            
            }


         });

    });

   
});    
</script>


<script type="text/javascript">

$(document).ready(function() {
   
  $("#pass2").keyup(function()
  {
          
      var cla1=$("#pass1").val();
      var cla2=$("#pass2").val();
      
      
    if (cla1 != cla2) {
      $("#respuesta").css("display","block"); 
    
    }
else {
    $("#respuesta").css("display","none"); 
  
}


});

$("#pass12").keyup(function(){
          
      var cla11=$("#pass11").val();
      var cla12=$("#pass12").val();
      
      
    if (cla11 != cla12) {
      $("#respuesta2").css("display","block"); 
    
    }
else {
    $("#respuesta2").css("display","none"); 
  
}


});
});  
</script>    
    <!-- Display pagination links -->
    <?= $pagination->createLinks(); ?>
<?php
}

#}  VALIDACIÓN SI EL USUARIO ES ADMINISTRADOR


?>


</body>
</html>

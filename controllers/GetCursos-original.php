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
  <script>
  const BASE_URL = "<?= BASE_URL ?>";
</script>
</head>
<body>
<?php


#if ($rol == "Administrador") {  VALIDACIÓN SI EL USUARIO ES ADMINISTRADOR
  if(isset($_POST['page'])){
    // Include pagination library file
    
  
  // Set some useful configuration
  $baseURL = 'controllers/GetCursos.php';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND (nombre_curso LIKE '%".$_POST['keywords']."%' || descripcion_curso LIKE '%".$_POST['keywords']."%' || duracion LIKE '%".$_POST['keywords']."%')  ";
    }

    if(!empty($_POST['asignado']))
    {
        $whereSQL = $whereSQL." AND profesor_asignado LIKE '%".$_POST['asignado']."%' ";
    }

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM cursos ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainer',
    'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT a.*,b.* FROM cursos a LEFT JOIN users b ON a.profesor_asignado= b.id_usuario  $whereSQL ORDER BY a.id_curso ASC LIMIT $offset,$limit");
?>
    <!-- Data list container -->
    
    
        <?php
        if($query->num_rows > 0){?>

          <table class="table table-hover table-bordered">
    <thead>
<tr>
<th>Curso</th>
<th>Descripción</th>
<th>Duración</th>
<th>Profesor Asignado</th>
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
<td><?= $row["nombre_curso"]; ?></td>
<td><?= $row["descripcion_curso"]; ?></td>
<td><?= $row["duracion"]; ?></td>
<td><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></td>
<td><button type="button" class="btn btn-info actualizar" data-id="<?= $row['id_curso'];?>" data-nombre="<?= $row['nombre_curso'];?>" data-descripcion="<?= $row['descripcion_curso'];?>" data-duracion="<?= $row['duracion'];?>" data-asignado="<?= $row['profesor_asignado'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete"  data-id="<?= $row['id_curso'];?>">Eliminar</button></td>
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
  const BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/pages/dashboard3.js"></script>
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/sweetalert2@10.js"></script>

  <script>
// Load content from external file
$(document).ready(function() {
$(".actualizar").on("click",function()
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
  $("#img").attr("src","dist/img/users/"+img);
  $("#imagen_actual").val(img);
  

  $("#myModalActualizar").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este curso ?',
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
           url:"eliminar-curso.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar Curso',
  text: 'Curso eliminado correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
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

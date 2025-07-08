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
  $baseURL = 'GetSolicitudes.php';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND (titulo LIKE '%".$_POST['keywords']."%' || descripcion LIKE '%".$_POST['keywords']."%') ";
    }

    if(!empty($_POST['asesor']))
    {
        $whereSQL = $whereSQL." AND id_asesor LIKE '%".$_POST['asesor']."%' ";
    }

    if(!empty($_POST['trabajo']))
    {
        $whereSQL = $whereSQL." AND tipo_trabajo_id LIKE '%".$_POST['trabajo']."%' ";
    }

    if(!empty($_POST['nivel_educativo']))
    {
        $whereSQL = $whereSQL." AND nivel_educativo LIKE '%".$_POST['nivel_educativo']."%' ";
    }

    if(!empty($_POST['materia']))
    {
        $whereSQL = $whereSQL." AND materia_relacionada LIKE '%".$_POST['materia']."%' ";
    }

    if(!empty($_POST['fecha_inicial']))
    {
        $whereSQL = $whereSQL." AND fecha_limite >= '".$_POST['fecha_inicial']."' ";
    }

    if(!empty($_POST['fecha_final']))
    {
        $whereSQL = $whereSQL." AND fecha_limite <= '".$_POST['fecha_final']."' ";
    }

    

    

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM solicitudes ".$whereSQL);
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
    $query = $db->query("SELECT * FROM solicitudes a LEFT JOIN users b ON a.id_estudiante = b.id_usuario LEFT JOIN tipos_trabajo c ON a.tipo_trabajo_id = c.id_tipo_trabajo LEFT JOIN materias d ON a.materia_relacionada = d.id_materia $whereSQL ORDER BY a.id_solicitud ASC LIMIT $offset,$limit");
?>
    <!-- Data list container -->
    
    
        <?php
        if($query->num_rows > 0){?>

          <table class="table table-hover table-bordered">
    <thead>
<tr>
<th>Estudiante</th>
<th>Título</th>
<th>Tipo trabajo</th>
<th>Materia relacionada</th>
<th>Fecha límite</th>
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
<td><?= $row["titulo"]; ?></td>
<td><?= $row["tipo_trabajo"]; ?></td>
<td><?= $row["materia"]; ?></td>
<td><?= $row["fecha_limite"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_solicitud" data-id="<?= $row['id_solicitud'];?>" data-titulo="<?= $row['titulo'];?>" data-nivel="<?= $row['nivel_educativo'];?>" data-tipo_trabajo="<?= $row['tipo_trabajo_id'];?>" data-materia="<?= $row['materia_relacionada'];?>" data-fecha="<?= $row['fecha_limite'];?>" data-descripcion="<?= $row['descripcion'];?>" data-id_asesor="<?= $row['id_asesor'];?>" data-id_estudiante="<?= $row['id_estudiante'];?>" data-archivos="<?= $row['archivos'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete_solicitud"  data-id="<?= $row['id_usuario'];?>">Eliminar</button></td>
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
    
    <!-- Display pagination links -->
    <?= $pagination->createLinks(); ?>
<?php
}



?>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_solicitud").on("click",function()
 {

  var id = $(this).attr("data-id");
  var titulo = $(this).attr("data-titulo");
  var nivel_educativo = $(this).attr("data-nivel");
  var tipo_trabajo_id = $(this).attr("data-tipo_trabajo");
  var materia = $(this).attr("data-materia");
  var fecha_limite = $(this).attr("data-fecha");
  var descripcion = $(this).attr("data-descripcion");
  var id_asesor = $(this).attr("data-id_asesor");
  //console.log(id_asesor);
  var id_estudiante = $(this).attr("data-id_estudiante");
  var archivos = $(this).attr("data-archivos");
   archivos = archivos.split(',');
   
   /*for (let i = 0; i < archivos.length; i++)
   {
    console.log(archivos[i]); 
   }*/
  //numeros_contacto = numeros_contacto.split(',');
  
  
  $("#id_solicitud").val(id);
  $("#titulo").val(titulo);
  $('#cmbnivel option[value="'+nivel_educativo+'"]').attr("selected", true);
  $('#cmbtipo option[value="'+tipo_trabajo_id+'"]').attr("selected", true);
  $('#cmbmateria option[value="'+materia+'"]').attr("selected", true);
  $("#fecha_limite").val(fecha_limite);
  $("#descripcion_solicitud").val(descripcion);
  $('#cmbprof2 option[value="'+id_asesor+'"]').attr("selected", true);
  $("#id_estudiante").val(id_estudiante);
  

  $("#myModalActualizarSolicitud").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este nivel educativo ?',
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
           url:"eliminar-nivel-educativo.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar nivel educativo',
  text: 'Nivel educativo eliminado correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});

});
</script>

</body>
</html>

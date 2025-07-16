<?php 
session_start();
require_once __DIR__ . '/../init.php';  // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH .  'config/dbConfig.php';
require_once ROOT_PATH .  'config/conexiones.php';
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



  if(isset($_POST['page'])){

  $baseURL = BASE_URL . 'GetCotizacionesEstudiante';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE a.estudiante_id = "'.$usuario_id.'"';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND (a.estado_cotizacion LIKE '%".$_POST['keywords']."%' || a.tiempo_entrega LIKE '%".$_POST['keywords']."%' || a.costo_total LIKE '%".$_POST['keywords']."%' || a.detalles LIKE '%".$_POST['keywords']."%' || a.detalles_estudiante LIKE '%".$_POST['keywords']."%') ";
    }

    if(!empty($_POST['asesor']))
    {
        $whereSQL = $whereSQL." AND a.asesor_id LIKE '%".$_POST['asesor']."%' ";
    }

    
    $query   = $db->query("SELECT COUNT(*) as rowNum FROM cotizaciones a LEFT JOIN users b ON a.asesor_id = b.id_usuario LEFT JOIN solicitudes c  ON a.id_propuesta = c.id_solicitud ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainercotizacionesestudiante',
    'link_func' => 'searchFilter_solicitudes_estudiante'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT * FROM cotizaciones a LEFT JOIN users b ON a.asesor_id = b.id_usuario LEFT JOIN solicitudes c  ON a.id_propuesta = c.id_solicitud $whereSQL ORDER BY a.id_cotizacion ASC LIMIT $offset,$limit");
?>
    <!-- Data list container -->
    
    
        <?php
        if($query->num_rows > 0){?>

          <table class="table table-hover table-bordered">
    <thead>
<tr>
<th>Asesor</th>
<th>Solicitud</th>
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
<td><button type="button" class="btn btn-info actualizar_cotizacion" data-id="<?= $row['id_cotizacion'];?>" data-titulo="<?= $row['titulo'];?>" data-tiempo-entrega="<?= $row['tiempo_entrega'];?>" data-costo-total="<?= $row['costo_total'];?>" data-asesor_id="<?= $row['asesor_id'];?>" data-estudiante_id="<?= $row['estudiante_id'];?>" data-id_propuesta="<?= $row['id_propuesta'];?>" data-estado="<?= $row['estado_cotizacion'];?>" data-detalles="<?= $row['detalles'];?>" data-detalles_estudiante="<?= $row['detalles_estudiante'];?>"><i class='fas fa-edit'></i></button></td>
<td><button type="button" class="btn btn-danger delete_cotizacion"  data-id="<?= $row['id_usuario'];?>"><i class='fas fa-trash-alt'></i></button></td>
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
$(".actualizar_cotizacion").on("click",function()
 {

  var id = $(this).attr("data-id");
  var titulo = $(this).attr("data-titulo");
  var tiempo_entrega = $(this).attr("data-tiempo-entrega");
  var costo_total = $(this).attr("data-costo-total");
  var asesor_id = $(this).attr("data-asesor_id");
  var estudiante_id = $(this).attr("data-estudiante_id");
  var id_propuesta = $(this).attr("data-id_propuesta");
  var estado = $(this).attr("data-estado");
  var detalles = $(this).attr("data-detalles");
  var detalles_estudiante = $(this).attr("data-detalles_estudiante");
  var usuario_id = $("#usuario_id").val();
  //numeros_contacto = numeros_contacto.split(',');
  $.ajax({

           type: "POST",
           url: BASE_URL + 'cambiar-estado-notificacion',
           data: {"id_cotizacion":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) 
           {
            
           }

         });
  
  $("#id_cotizacion_solicitud2").val(id);
  $("#titulo_cotizacion").html(titulo);
  $("#titulo_cotizacion2").val(titulo);
  $("#tiempo_entrega2").val(tiempo_entrega);
  $("#costo_total2").val(costo_total);
  $("#detalles2").val(detalles);
  $("#detalles_estudiante").val(detalles_estudiante);
  if (usuario_id == asesor_id) 
  {
    $("#creador_id").val(asesor_id);
    $("#usuario_id_cotizacion").val(estudiante_id);  
  }
  else 
  {
    $("#creador_id").val(estudiante_id);
    $("#usuario_id_cotizacion").val(asesor_id);
  }
  
  $("#propuesta_id_cotizacion").val(id_propuesta);
  
  $("#myModalActualizarCotizacion").modal({show:true});
  
});



});
</script>

</body>
</html>

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
  $baseURL = BASE_URL .'GetTiposTrabajo';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND tipo_trabajo LIKE '%".$_POST['keywords']."%'";
    }

    

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM tipos_trabajo ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainertrabajo',
    'link_func' => 'searchFilter_trabajo'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT * FROM tipos_trabajo $whereSQL ORDER BY id_tipo_trabajo ASC LIMIT $offset,$limit");
?>
    <!-- Data list container -->
    
    
        <?php
        if($query->num_rows > 0){?>

          <table class="table table-hover table-bordered">
    <thead>
<tr>
<th>Nombre</th>
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
<td><?= $row["tipo_trabajo"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_tipo" data-id="<?= $row['id_tipo_trabajo'];?>" data-tipo="<?= $row['tipo_trabajo'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete_tipo"  data-id="<?= $row['id_tipo_trabajo'];?>">Eliminar</button></td>
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
$(".actualizar_tipo").on("click",function()
 {

  var id = $(this).attr("data-id");
  var tipo = $(this).attr("data-tipo");
  
  $("#id_tipo_trabajo").val(id);
  $("#tipo").val(tipo);

  $("#myModalActualizarTipo").modal({show:true});
  
});



});
</script>

</body>
</html>

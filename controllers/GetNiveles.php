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
  $baseURL = BASE_URL .'GetNiveles';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND nivel_educativo LIKE '%".$_POST['keywords']."%'";
    }

    

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM niveles_educativos ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainerniveles',
    'link_func' => 'searchFilter_niveles'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT * FROM niveles_educativos $whereSQL ORDER BY id_nivel ASC LIMIT $offset,$limit");
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
<td><?= $row["nivel_educativo"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_nivel" data-id="<?= $row['id_nivel'];?>" data-nivel="<?= $row['nivel_educativo'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete_nivel" data-id="<?= $row['id_nivel'];?>">Eliminar</button></td>
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
$(".actualizar_nivel").on("click",function()
 {

  var id = $(this).attr("data-id");
  var nivel = $(this).attr("data-nivel");
  
  $("#id_nivel").val(id);
  $("#nivel").val(nivel);

  $("#myModalActualizarNivel").modal({show:true});
  
});

});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_nivel").on("click",function(){

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
           url: BASE_URL + 'eliminar-nivel-educativo',
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

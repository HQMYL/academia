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
  $baseURL = BASE_URL .'GetMaterias';
  $offset = !empty($_POST['page'])?$_POST['page']:0;
  $limit = 5;
  
    
  // Set conditions for search
  
    $whereSQL = 'WHERE TRUE';
    if(!empty($_POST['keywords']))
    {
        $whereSQL = $whereSQL." AND materia LIKE '%".$_POST['keywords']."%'";
    }

    

    $query   = $db->query("SELECT COUNT(*) as rowNum FROM materias ".$whereSQL);
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];
  
  // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainermaterias',
    'link_func' => 'searchFilter_materias'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
    $query = $db->query("SELECT * FROM materias $whereSQL ORDER BY id_materia ASC LIMIT $offset,$limit");
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
<td><?= $row["materia"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_materia" data-id="<?= $row['id_materia'];?>" data-materia="<?= $row['materia'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete_materia"  data-id="<?= $row['id_materia'];?>">Eliminar</button></td>
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
$(".actualizar_materia").on("click",function()
 {

  var id = $(this).attr("data-id");
  var materia = $(this).attr("data-materia");
  
  $("#id_materia").val(id);
  $("#materia").val(materia);

  $("#myModalActualizarMateria").modal({show:true});
  
});



});
</script>

<script>
// Load content from external file
$(document).ready(function() {
$(".delete_materia").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar esta materia ?',
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
           url: BASE_URL + 'eliminar-materia',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar materia',
  text: 'Materia eliminada correctamente'
  
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

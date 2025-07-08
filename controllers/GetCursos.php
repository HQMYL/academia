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

#if ($rol == "Administrador") {  VALIDACIÓN SI EL USUARIO ES ADMINISTRADOR
  if(isset($_POST['page'])){
    // Include pagination library file
    
  
  // Set some useful configuration
  $baseURL = BASE_URL . 'getCurso';
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
    'contentDiv' => 'dataContainercurso',
    'link_func' => 'searchFilter_curso'
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
  // Load content from external file
  $(document).ready(function() {
    $(".actualizar_curso").on("click", function() {

      var id = $(this).attr("data-id");
      var nombre = $(this).attr("data-nombre");
      var descripcion = $(this).attr("data-descripcion");
      var duracion = $(this).attr("data-duracion");
      var profesor_asignado = $(this).attr("data-asignado");

      $("#id").val(id);
      $("#nombre_curso").val(nombre);
      $("#descripcion").val(descripcion);
      $("#duracion").val(duracion);
      $('#asignado option[value="' + profesor_asignado + '"]').attr("selected", true);

      $("#myModalActualizarCurso").modal({show:true});

    });



  });
</script>
<!-- Eliminar-curso -->
<script>
  // Load content from external file
  $(document).ready(function() {
    $(".delete_curso").on("click", function() {
      var id = $(this).attr("data-id");

      Swal.fire({
        title: 'Desea eliminar este curso ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#bb414d',
        cancelButtonColor: '#337AFF',
        cancelButtonText: 'Cerrar',
        confirmButtonText: 'Eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: BASE_URL + 'eliminar-curso',
            data: {
              "id": id
            }, // Adjuntar los campos del formulario enviado.

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

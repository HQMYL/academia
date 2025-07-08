<?php
session_start();
 
require_once __DIR__ . '../../../init.php'; // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH . 'config/conexiones.php';    
require_once ROOT_PATH .  'config/dbConfig.php';
require_once ROOT_PATH .  'models/Pagination.class.php';
$usuario = "";
 
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];
} else {
  header('Location: ./');
}
 
require_once ROOT_PATH . 'include/dashboard/header.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12"> <!-- INICIO COL-LG-12 -->
            <!-- <div class="card"> -->
             
                <!--<div class="row"> INICIO ROW -->
<div class="card-body"><!-- INICIO CARD BODY -->
<?php 
if ($rol == "1") 
{ ?>
<button type="button" class="btn btn-info agregar_materia"><i class="fa fa-solid fa-plus"></i> Agregar materia</button>
<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-6">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_materias" onkeyup="searchFilter_materias();"><br>
<input type="button" class="btn btn-primary" value="Buscar" onclick="searchFilter_materias();">
<a href="<?= BASE_URL ?>listado-materias" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>Limpiar</a>
</div>
</div>

</div>
<!-- ESPACIO PARA FILTROS -->

<div class="datalist-wrapper">
<!-- Loading overlay -->
<div class="loading-overlay" style="display: none;"><div class="overlay-content">Cargando...</div></div>

<!-- Data list container -->

<!-- ESPACIO PARA TABLA ORIGINAL-->
<?php
$baseURL = 'GetMaterias.php';
$limit = 5;

// Count of all records
#$mar = "208";
#$whereSQL = "WHERE users.id = establecimientos.id_usuario ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM materias ");
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainermaterias',
'link_func' => 'searchFilter_materias'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM materias ORDER BY id_materia ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainermaterias">
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
?>
<tr>
<td><?= $row["materia"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_materia" data-id="<?= $row['id_materia'];?>" data-materia="<?= $row['materia'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete_materia"  data-id="<?= $row['id_materia'];?>">Eliminar</button></td>
</tr>
<?php
}

} else{
echo '<tr><td colspan="6"><h2>No hay registros</h2></td></tr>';
}
?>
</tbody>
</table>

<!-- Display pagination links -->
<?= $pagination->createLinks(); ?>
</div>
</div>
<?php }
?>


</div> <!-- FINAL CARD BODY -->
               <!--  </div> -->
             
            <!--</div>-->
            
          </div><!-- FINAL COL-LG-12 -->
          
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
      
    </div><!-- /.content -->
    
  </div><!-- /.content-wrapper -->

<!-- jQuery -->
<?php require_once ROOT_PATH .  'models/modales.php'; ?>

<!-- jQuery -->
<?php require_once ROOT_PATH .  'include/dashboard/footer.php'; ?>
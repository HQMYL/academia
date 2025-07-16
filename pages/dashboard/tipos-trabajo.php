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
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin">Inicio</a></li>
              <li class="breadcrumb-item active">Tipos de trabajo</li>
            </ol>
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

<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_trabajo" onkeyup="searchFilter_trabajo();"><br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4"></label>
<a href="<?= BASE_URL ?>tipos-trabajo" class="btn btn-success cot"><i class="fa fa-fw fa-sync"></i></a>
</div>
</div>

</div>
<!-- ESPACIO PARA FILTROS -->
<button type="button" class="btn btn-info agregar_tipo"><i class="fa fa-solid fa-plus"></i> Agregar tipo de trabajo</button>
<div class="datalist-wrapper">
<!-- Loading overlay -->
<div class="loading-overlay" style="display: none;"><div class="overlay-content">Cargando...</div></div>

<!-- Data list container -->

<!-- ESPACIO PARA TABLA ORIGINAL-->
<?php
$baseURL = 'GetTiposTrabajo.php';
$limit = 5;

// Count of all records
#$mar = "208";
#$whereSQL = "WHERE users.id = establecimientos.id_usuario ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM tipos_trabajo ");
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainertrabajo',
'link_func' => 'searchFilter_trabajo'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM tipos_trabajo ORDER BY id_tipo_trabajo ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainertrabajo">
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
<td><?= $row["tipo_trabajo"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_tipo" data-id="<?= $row['id_tipo_trabajo'];?>" data-tipo="<?= $row['tipo_trabajo'];?>"><i class="fas fa-edit"></i></button></td>
<td><button type="button" class="btn btn-danger delete_tipo"  data-id="<?= $row['id_tipo_trabajo'];?>"><i class="fas fa-trash"></i></button></td>
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
  

  <!-- Control Sidebar -->
  
<!-- ./wrapper -->
<?php require_once ROOT_PATH .  'models/modales.php'; ?>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php require_once ROOT_PATH .  'include/dashboard/footer.php'; ?>
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
            <h4 class="px-4">Cotizaciones</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin">Inicio</a></li>
              <li class="breadcrumb-item active">Cotizaciones</li>
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
if ($rol == "2") 
{ ?>
<!--<button type="button" class="btn btn-info agregar_solicitud"><i class="fa fa-solid fa-plus"></i> Agregar solicitud</button>-->
<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-4">
<div class="form-group">
<label class="d-label" for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_cotizaciones" onkeyup="searchFilter_cotizaciones();"><br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="d-label" for="inputPassword4">Filtrar por estudiante</label>
<select class="form-control form-control-sm" name="cmbestudiante" id="cmbestudiante" onchange="searchFilter_cotizaciones();">
                  <option value="">Seleccione...</option>
                  <?php
                  $estudiante = "";
                  $estudiante = "3"; 
$sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ?");
$sth->bindParam(1, $estudiante);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?>  <?= $row["apellidos"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label class="d-label" for="inputPassword4"></label>


<a href="<?= BASE_URL ?>cotizaciones" class="btn btn-primary cot"><i class="fa fa-fw fa-sync"></i></a>
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
$baseURL = 'GetCotizaciones.php';
$limit = 5;

// Count of all records
#$mar = "208";
$whereSQL = "WHERE  a.asesor_id = '".$usuario_id."' ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM cotizaciones a LEFT JOIN users b ON a.estudiante_id = b.id_usuario LEFT JOIN solicitudes c ON a.id_propuesta = c.id_solicitud ".$whereSQL);
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainercotizaciones',
'link_func' => 'searchFilter_cotizaciones'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM cotizaciones a LEFT JOIN users b ON a.estudiante_id = b.id_usuario LEFT JOIN solicitudes c ON a.id_propuesta = c.id_solicitud $whereSQL ORDER BY a.id_cotizacion ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainercotizaciones">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th>Estudiante</th>
<th>Solicitud</th>
<th>Estado</th>
<th>Editar</th>
<th>Eliminar</th>

</tr>
</thead>
<tbody>

<?php
while($row = $query->fetch_assoc()){
?>
<tr>
<td><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></td>
<td><?= $row["titulo"]; ?></td>
<td><?= $row["estado_cotizacion"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_cotizacion" data-id="<?= $row['id_cotizacion'];?>" data-titulo="<?= $row['titulo'];?>" data-tiempo-entrega="<?= $row['tiempo_entrega'];?>" data-costo-total="<?= $row['costo_total'];?>" data-asesor_id="<?= $row['asesor_id'];?>" data-estudiante_id="<?= $row['estudiante_id'];?>" data-id_propuesta="<?= $row['id_propuesta'];?>" data-estado="<?= $row['estado_cotizacion'];?>" data-detalles="<?= $row['detalles'];?>" data-detalles_estudiante="<?= $row['detalles_estudiante'];?>"><i class='fas fa-edit'></i></button></td>
<td><button type="button" class="btn btn-danger delete_cotizacion"  data-id="<?= $row['id_usuario'];?>"><i class='fas fa-trash-alt'></i></button></td>

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

<?php 
if ($rol == "3") 
{ ?>

<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="hidden" class="form-control form-control-sm" name="id_usuario" id="user_id_estudiante" value="<?= $usuario_id; ?>">
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_cotizacion_estudiante" onkeyup="searchFilter_cotizaciones_estudiante();"><br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por asesor</label>
<select class="form-control form-control-sm" name="cmbasesor" id="cmbasesor_cotizacion" onchange="searchFilter_cotizaciones_estudiante();">
                  <option value="">Seleccione...</option>
                  <?php
                  $asesor = "";
                  $asesor = "2"; 
$sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ?");
$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?>  <?= $row["apellidos"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<a href="<?= BASE_URL ?>cotizaciones" class="btn btn-info cot"><i class="fa fa-fw fa-sync"></i></a>
</div>
</div>
<!-- ESPACIO PARA FILTROS -->

<div class="datalist-wrapper">
  
<!-- Loading overlay -->
<div class="loading-overlay" style="display: none;"><div class="overlay-content">Cargando...</div></div>

<!-- Data list container -->

<!-- ESPACIO PARA TABLA ORIGINAL-->
<?php
$baseURL = 'GetCotizacionesEstudiante.php';
$limit = 5;

// Count of all records
#$mar = "208";
$whereSQL = "WHERE a.estudiante_id = '".$usuario_id."'";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM cotizaciones a LEFT JOIN users b ON a.asesor_id = b.id_usuario LEFT JOIN solicitudes c  ON a.id_propuesta = c.id_solicitud ".$whereSQL);
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainercotizacionestudiante',
'link_func' => 'searchFilter_cotizaciones_estudiante'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM cotizaciones a LEFT JOIN users b ON a.asesor_id = b.id_usuario LEFT JOIN solicitudes c  ON a.id_propuesta = c.id_solicitud $whereSQL ORDER BY a.id_cotizacion ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainercotizacionesestudiante">
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
?>
<tr>
<td><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></td>
<td><?= $row["titulo"]; ?></td>
<td><button type="button" class="btn btn-info actualizar_cotizacion" data-id="<?= $row['id_cotizacion'];?>" data-titulo="<?= $row['titulo'];?>" data-tiempo-entrega="<?= $row['tiempo_entrega'];?>" data-costo-total="<?= $row['costo_total'];?>" data-asesor_id="<?= $row['asesor_id'];?>" data-estudiante_id="<?= $row['estudiante_id'];?>" data-id_propuesta="<?= $row['id_propuesta'];?>" data-estado="<?= $row['estado_cotizacion'];?>" data-detalles="<?= $row['detalles'];?>" data-detalles_estudiante="<?= $row['detalles_estudiante'];?>"><i class='fas fa-edit'></i></button></td>
<td><button type="button" class="btn btn-danger delete_cotizacion"  data-id="<?= $row['id_usuario'];?>"><i class='fas fa-trash-alt'></i></button></td>
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


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php require_once ROOT_PATH .  'models/modales.php'; ?>

<!-- jQuery -->
<?php require_once ROOT_PATH .  'include/dashboard/footer.php'; ?>
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
if ($rol == "1" OR $rol == "2") 
{ ?>
<!--<button type="button" class="btn btn-info agregar_solicitud"><i class="fa fa-solid fa-plus"></i> Agregar solicitud</button>-->
<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_solicitudes" onkeyup="searchFilter_solicitudes();"><br>
<input type="button" class="btn btn-primary" value="Buscar" onclick="searchFilter_solicitudes();">
<a href="<?= BASE_URL ?>solicitudes" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>Limpiar</a>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por asesor</label>
<select class="form-control form-control-sm" name="cmbasesor" id="cmbprof" onchange="searchFilter_solicitudes();">
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
<div class="form-group">
<label for="inputPassword4">Filtrar por tipo de trabajo</label>
<select class="form-control form-control-sm" name="cmbtrabajo" id="cmbtrabajo" onchange="searchFilter_solicitudes();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM tipos_trabajo ");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_tipo_trabajo"]; ?>"><?= $row["tipo_trabajo"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por nivel educativo</label>
<select class="form-control form-control-sm" name="cmbnivel" id="cmbeducativo" onchange="searchFilter_solicitudes();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM niveles_educativos");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_nivel"]; ?>"><?= $row["nivel_educativo"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por materia relacionada</label>
<select class="form-control form-control-sm" name="cmbmat" id="cmbmat" onchange="searchFilter_solicitudes();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM materias ");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_materia"]; ?>"><?= $row["materia"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Fecha inicio</label>
<input type="text" class="form-control form-control-sm" name="fecha_inicial" id="fecha_inicial" onchange="searchFilter_solicitudes();">
<br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Fecha fin</label>
<input type="text" class="form-control form-control-sm" name="fecha_final" id="fecha_final" onchange="searchFilter_solicitudes();"><br>

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
$baseURL = 'GetSolicitudes.php';
$limit = 5;

// Count of all records
#$mar = "208";
$whereSQL = "WHERE  = establecimientos.id_usuario ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM solicitudes ");
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainersolicitudes',
'link_func' => 'searchFilter_solicitudes'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM solicitudes a LEFT JOIN users b ON a.id_estudiante = b.id_usuario LEFT JOIN tipos_trabajo c ON a.tipo_trabajo_id = c.id_tipo_trabajo LEFT JOIN materias d ON a.materia_relacionada = d.id_materia ORDER BY a.id_solicitud ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainersolicitudes">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th>Estudiante</th>
<th>Título</th>
<th>Tipo trabajo</th>
<th>Materia relacionada</th>
<th>Fecha límite</th>
<th>Asignar/aceptar</th>
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
<td><?= $row["tipo_trabajo"]; ?></td>
<td><?= $row["materia"]; ?></td>
<td><?= $row["fecha_limite"]; ?></td>
<?php 
if (empty($row["id_asesor"])) 
{ ?>
  <td><button type="button" class="btn btn-warning">Sin asignar</button></td>
<?php }

if (!empty($row["id_asesor"])) 
{ ?>
  <td><button type="button" class="btn btn-success">Asignado</button></td>
<?php }
?>
<td><button type="button" class="btn btn-info actualizar_solicitud" data-id="<?= $row['id_solicitud'];?>" data-titulo="<?= $row['titulo'];?>" data-nivel="<?= $row['nivel_educativo'];?>" data-tipo_trabajo="<?= $row['tipo_trabajo_id'];?>" data-materia="<?= $row['materia_relacionada'];?>" data-fecha="<?= $row['fecha_limite'];?>" data-descripcion="<?= $row['descripcion'];?>" data-id_asesor="<?= $row['id_asesor'];?>" data-id_estudiante="<?= $row['id_estudiante'];?>" data-archivos="<?= $row['archivos'];?>">Detalles</button></td>
<td><button type="button" class="btn btn-danger delete_solicitud"  data-id="<?= $row['id_usuario'];?>">Eliminar</button></td>

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
<button type="button" class="btn btn-info agregar_solicitud"><i class="fa fa-solid fa-plus"></i> Agregar solicitud</button>
<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords_estudiante" onkeyup="searchFilter_solicitudes_estudiante();"><br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por asesor</label>
<select class="form-control form-control-sm" name="cmbasesor" id="cmbasesor" onchange="searchFilter_solicitudes_estudiante();">
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
<div class="form-group">
<label for="inputPassword4">Filtrar por tipo de trabajo</label>
<select class="form-control form-control-sm" name="cmbtrabajo" id="cmbtrabajo_estudiante" onchange="searchFilter_solicitudes_estudiante();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM tipos_trabajo ");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_tipo_trabajo"]; ?>"><?= $row["tipo_trabajo"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por nivel educativo</label>
<select class="form-control form-control-sm" name="cmbnivel" id="cmbeducativo_estudiante" onchange="searchFilter_solicitudes_estudiante();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM niveles_educativos");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_nivel"]; ?>"><?= $row["nivel_educativo"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Filtrar por materia relacionada</label>
<select class="form-control form-control-sm" name="cmbmat" id="cmbmat_estudiante" onchange="searchFilter_solicitudes_estudiante();">
                  <option value="">Seleccione...</option>
                  <?php
                  
$sth = $con->prepare("SELECT * FROM materias ");
#$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_materia"]; ?>"><?= $row["materia"]; ?></option>
   
<?php }

}
?>
</select>

</div>

</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Fecha inicio</label>
<input type="text" class="form-control form-control-sm" name="fecha_inicial" id="fecha_inicial_estudiante" onchange="searchFilter_solicitudes_estudiante();">
<br>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="inputPassword4">Fecha fin</label>
<input type="text" class="form-control form-control-sm" name="fecha_final" id="fecha_final_estudiante" onchange="searchFilter_solicitudes_estudiante();">
<input type="hidden" class="form-control form-control-sm" name="id_usuario" id="user_id" value="<?= $usuario_id; ?>">
<br>

</div>

</div>

<div class="col-md-4">

<input type="button" class="btn btn-primary" value="Buscar" onclick="searchFilter_solicitudes_estudiante();">
<a href="<?= BASE_URL ?>solicitudes" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>Limpiar</a>
</div>
</div>
<!-- ESPACIO PARA FILTROS -->

<div class="datalist-wrapper">
  
<!-- Loading overlay -->
<div class="loading-overlay" style="display: none;"><div class="overlay-content">Cargando...</div></div>

<!-- Data list container -->

<!-- ESPACIO PARA TABLA ORIGINAL-->
<?php
$baseURL = 'GetSolicitudesEstudiante.php';
$limit = 5;

// Count of all records
#$mar = "208";
$whereSQL = "WHERE a.id_estudiante = '".$usuario_id."'";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM solicitudes a LEFT JOIN tipos_trabajo c ON a.tipo_trabajo_id = c.id_tipo_trabajo LEFT JOIN materias d ON a.materia_relacionada = d.id_materia ".$whereSQL);
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainerestudiante',
'link_func' => 'searchFilter_solicitudes_estudiante'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT * FROM solicitudes a LEFT JOIN tipos_trabajo c ON a.tipo_trabajo_id = c.id_tipo_trabajo LEFT JOIN materias d ON a.materia_relacionada = d.id_materia $whereSQL ORDER BY a.id_solicitud ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainerestudiante">
<table class="table table-hover table-bordered">
<thead>
<tr>

<th>Título</th>
<th>Tipo trabajo</th>
<th>Materia relacionada</th>
<th>Fecha límite</th>
<th>Asignado</th>
<th>Editar</th>
<th>Eliminar</th>

</tr>
</thead>
<tbody>

<?php
while($row = $query->fetch_assoc()){
?>
<tr>
  <td><?= $row["titulo"]; ?></td>
<td><?= $row["tipo_trabajo"]; ?></td>
<td><?= $row["materia"]; ?></td>
<td><?= $row["fecha_limite"]; ?></td>
<?php 
if (empty($row["id_asesor"])) 
{ ?>
  <td><button type="button" class="btn btn-warning">Sin asignar</button></td>
<?php }

if (!empty($row["id_asesor"])) 
{ ?>
  <td><button type="button" class="btn btn-success">Asignado</button></td>
<?php }
?>
<td><button type="button" class="btn btn-info actualizar_solicitud" data-id="<?= $row['id_solicitud'];?>" data-titulo="<?= $row['titulo'];?>" data-nivel="<?= $row['nivel_educativo'];?>" data-tipo_trabajo="<?= $row['tipo_trabajo_id'];?>" data-materia="<?= $row['materia_relacionada'];?>" data-fecha="<?= $row['fecha_limite'];?>" data-descripcion="<?= $row['descripcion'];?>" data-id_asesor="<?= $row['id_asesor'];?>" data-id_estudiante="<?= $row['id_estudiante'];?>" data-archivos="<?= $row['archivos'];?>">Detalles</button></td>
<td><button type="button" class="btn btn-danger delete_solicitud"  data-id="<?= $row['id_solicitud'];?>">Eliminar</button></td>
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
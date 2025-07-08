<?php
session_start(); 
include("conexion.php");
include("Pagination.class.php");    
include("dbConfig.php");
$usuario = "";

if (isset($_SESSION["usuario"])) 
{
  $usuario = $_SESSION["usuario"];

  
}
else {
   header('Location: ./');
}


$rol = "";
$usuario_id = "";
$foto_perfil = "";
$sth = $con->prepare("SELECT * FROM users WHERE usuario = ?");
$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 

   $rol = $row["id_tipo"];
   $usuario_id = $row["id_usuario"];
   $foto_perfil = $row["img"];
   
}
}

$logo = "";
$sth = $con->prepare("SELECT * FROM logotipo");
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ 
   $logo = $row["img"];
}
}

$anno = "";
$anno = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema académico</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/nueva.css">
  
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <!-- <i class="far fa-bell"></i> -->
          Bienvenido: <?= $usuario; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            Mi perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
             Cerrar sesión 
          </a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin.php" class="brand-link">
      <img src="dist/img/logo/<?= $logo; ?>" alt="sistema logotipo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema académico</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/users/<?= $foto_perfil; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $usuario; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php include('menu.php'); ?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
<button type="button" class="btn btn-info agregar_usuario"><i class="fa fa-solid fa-plus"></i> Agregar usuario</button>
<label for="inputEmail4"></label>
<div class="row align-items-stretch mb-5">
<div class="col-md-6">
<div class="form-group">
<label for="inputPassword4">Filtrar</label>
<input type="text" class="form-control form-control-sm" name="keywords" id="keywords" onkeyup="searchFilter();"><br>
<input type="button" class="btn btn-primary" value="Buscar" onclick="searchFilter();">
<a href="<?= $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i>Limpiar</a>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="inputPassword4">Filtrar por rol</label>
<select class="form-control form-control-sm" name="cmbrol" id="cmbrol" onchange="searchFilter();">
                  <option value="">Seleccione...</option>
                  <?php 
$sth = $con->prepare("SELECT * FROM roles ");
#$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_rol"]; ?>"><?= $row["rol"]; ?></option>
   
<?php }

}
?>
              </select>

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
$baseURL = 'GetUsuarios.php';
$limit = 5;

// Count of all records
#$mar = "208";
#$whereSQL = "WHERE users.id = establecimientos.id_usuario ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM users ");
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
'baseURL' => $baseURL,
'totalRows' => $rowCount,
'perPage' => $limit,
'contentDiv' => 'dataContainer',
'link_func' => 'searchFilter'
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the limit
$query = $db->query("SELECT a.*,b.* FROM users a LEFT JOIN roles b ON a.id_tipo = b.id_rol  ORDER BY a.id_usuario ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainer">
<table class="table table-hover table-bordered">
<thead>
<tr>

<th>Nombre</th>
<th>Correo</th>
<th>Móvil</th>
<th>Tipo</th>
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
<td><?= $row["correo"]; ?></td>
<td><?= $row["movil"]; ?></td>

<td><?= $row["rol"]; ?></td>

<td><button type="button" class="btn btn-info actualizar" data-id="<?= $row['id_usuario'];?>" data-nombre="<?= $row['nombre'];?>" data-apellidos="<?= $row['apellidos'];?>" data-dir="<?= $row['direccion'];?>" data-correo="<?= $row['correo'];?>" data-tel="<?= $row['telefono'];?>" data-movil="<?= $row['movil'];?>" data-usuario="<?= $row['usuario'];?>" data-pass="<?= $row['pass'];?>" data-rol="<?= $row['id_tipo'];?>" data-estado="<?= $row['id_estado_usuario'];?>" data-img="<?= $row['img'];?>">Editar</button></td>
<td><button type="button" class="btn btn-danger delete"  data-id="<?= $row['id_usuario'];?>">Eliminar</button></td>
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


</div>
               <!--  </div> -->
             
            <!--</div>-->
            
          </div><!-- FINAL COL-LG-12 -->
          
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
      
    </div><!-- /.content -->
    
  </div><!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Sistema académico.</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<!-- Modal 1 -->
<div class="modal fade" id="myModalAgregar" role="dialog" style="overflow-y: scroll;">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: #337AFF;">
<p class="modal-title" style="color: #fff;">Agregar usuario</p>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form id="fupForm">
<div class="row">
<div class="col-md-4">
<label>Nombre</label>
<input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre">
</div>

<div class="col-md-4">
<label>Apellidos</label>
<input type="text" class="form-control form-control-sm" name="apellidos" placeholder="Apellidos">
</div>

<div class="col-md-4">
<label>Dirección</label>
<input type="text" class="form-control form-control-sm" name="dir" placeholder="Dirección">
</div>

<div class="col-md-4">
<label>Correo</label>
<input type="text" class="form-control form-control-sm" name="correo" placeholder="Correo">
</div>

<div class="col-md-4">
<label>Teléfono</label>

<input type="text" class="form-control form-control-sm" name="tel" placeholder="Teléfono">

</div>

<div class="col-md-4">
<label>Móvil</label>
<input type="text" class="form-control form-control-sm" name="movil" placeholder="Móvil">
</div>

<div class="col-md-4">
<label>Usuario</label>
<input type="text" class="form-control form-control-sm" name="user" id="user" placeholder="Usuario">
<h3 id="comprobar"></h3>

</div>

<div class="col-md-4">
<label>Contraseña</label>
<input class="form-control form-control-sm" type="password" name="pass" id="pass1">
</div>

<div class="col-md-4">

<label for="cat">Confirmar contraseña:</label>

<input class="form-control form-control-sm" type="password" id="pass2">

<div id="respuesta" style="display: none;"><h3>Las contraseñas introducidas no son iguales</h3></div>
</div>

<div class="col-md-4">
<label>Tipo de usuario</label>
<select class="form-control form-control-sm" name="cmbrol">
<option value="">Seleccione...</option>
<?php 
$sth = $con->prepare("SELECT * FROM roles ");
#$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id_rol"]; ?>"><?= $row["rol"]; ?></option>

<?php }

}
?>
</select>

</div>

<div class="col-md-4">

<label for="cat">Estado:</label>
<select class="form-control form-control-sm" name="cmbestado">
<option value="">Seleccione...</option>
<?php 
$sth = $con->prepare("SELECT * FROM estados ");
#$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id"]; ?>"><?= $row["estado"]; ?></option>

<?php }

}
?>
</select>

</div>

<div class="col-md-4">

<label for="cat">Foto de perfil:</label>

<input class="form-control form-control-sm" type="file" name="archivo">
<br>
</div>

</div> <!--FINAL ROW-->
<div class="row">

<!-- /.col -->
<div class="col-4">
<input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtn" value="Guardar"/>
<!--<button type="submit" class="btn btn-secondary">Guardar</button>-->


</div>

<!-- /.col -->
</div>
<div class="statusMsg"></div>
</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
<!--<input  type="submit"  name="submit" class="btn btn-primary btn-rounded submitBtn" value="Guardar">-->

</div>  
</div>

</div>
</div>
<!-- Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="myModalActualizar" role="dialog" style="overflow-y: scroll;">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: #337AFF;">
<p class="modal-title" style="color: #fff;">Actualizar usuario</p>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form id="fupForm2">
<div class="row">
<div class="col-md-4">
<label>Nombre</label>
<input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombre">
</div>

<div class="col-md-4">
<label>Apellidos</label>
<input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" placeholder="Apellidos">
</div>

<div class="col-md-4">
<label>Dirección</label>
<input type="text" class="form-control form-control-sm" name="dir" id="dir" placeholder="Dirección">
</div>

<div class="col-md-4">
<label>Correo</label>
<input type="text" class="form-control form-control-sm" name="correo" id="correo" placeholder="Correo">
</div>

<div class="col-md-4">
<label>Teléfono</label>

<input type="text" class="form-control form-control-sm" name="tel" id="tel" placeholder="Teléfono">

</div>

<div class="col-md-4">
<label>Móvil</label>
<input type="text" class="form-control form-control-sm" name="movil" id="movil" placeholder="Móvil">
</div>

<div class="col-md-4">
<label>Usuario</label>
<input type="text" class="form-control form-control-sm" name="user" id="user2" placeholder="Usuario">
<h3 id="comprobar"></h3>

</div>

<div class="col-md-4">
<label>Contraseña</label>
<input class="form-control form-control-sm" type="hidden" name="pass" id="pass0">
<input class="form-control form-control-sm" type="password" name="pass11" id="pass11">
</div>

<div class="col-md-4">

<label for="cat">Confirmar contraseña:</label>

<input class="form-control form-control-sm" type="password" id="pass12">

<div id="respuesta2" style="display: none;"><h3>Las contraseñas introducidas no son iguales</h3></div>
</div>

<div class="col-md-4">
<label>Tipo de usuario</label>
<select class="form-control form-control-sm" name="cmbrol" id="cmbrol">
<option value="">Seleccione...</option>
<?php 
$sth = $con->prepare("SELECT * FROM roles ");
#$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id_rol"]; ?>"><?= $row["rol"]; ?></option>

<?php }

}
?>
</select>

</div>

<div class="col-md-4">

<label for="cat">Estado:</label>
<select class="form-control form-control-sm" name="cmbestado" id="cmbestado">
<option value="">Seleccione...</option>
<?php 
$sth = $con->prepare("SELECT * FROM estados ");
#$sth->bindParam(1, $usuario);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id"]; ?>"><?= $row["estado"]; ?></option>

<?php }

}
?>
</select>

</div>
<div class="col-md-4">

<label for="cat">Foto de perfil actual:</label>
<img src="" id="img" width="150"; height="150";>
</div>
<div class="col-md-4">

<label for="cat">Foto de perfil:</label>

<input class="form-control form-control-sm" type="file" name="archivo">
<img src="" name="imagen_actual" id="imagen_actual">
<input class="form-control form-control-sm" type="hidden" name="id" id="id_usuario">
<br>
</div>

</div> <!--FINAL ROW-->
<div class="row">

<!-- /.col -->
<div class="col-4">
<input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtn2" value="Actualizar"/>
<!--<button type="submit" class="btn btn-secondary">Guardar</button>-->


</div>

<!-- /.col -->
</div>
<div class="statusMsg2"></div>
</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
<!--<input  type="submit"  name="submit" class="btn btn-primary btn-rounded submitBtn" value="Guardar">-->

</div>  
</div>

</div>
</div>
<!-- Modal 2 -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
<script src="dist/js/sweetalert2@10.js"></script>
<script>
// Custom function to handle search and filter operations
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var rol = $('#cmbrol').val();
    
    $.ajax({
        type: 'POST',
        url: 'GetUsuarios.php',
        data:'page='+page_num+'&keywords='+keywords+'&rol='+rol,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<script type="text/javascript">
 $(document).ready(function() { 

 $(".agregar_usuario").on("click",function(){

  $("#myModalAgregar").modal({show:true});
  
  
}); 

});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#user").keyup(function(){

          var id = $("#user").val();
    
       $.ajax({

           type: "POST",
           url:"comprobacion.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {
            
            $("#comprobar").html(response);
            
            
            }


         });

    });

   
});    
</script>


<script type="text/javascript">

$(document).ready(function() {
   
  $("#pass2").keyup(function()
  {
          
      var cla1=$("#pass1").val();
      var cla2=$("#pass2").val();
      
      
    if (cla1 != cla2) {
      $("#respuesta").css("display","block"); 
    
    }
else {
    $("#respuesta").css("display","none"); 
  
}


});

$("#pass12").keyup(function(){
          
      var cla11=$("#pass11").val();
      var cla12=$("#pass12").val();
      
      
    if (cla11 != cla12) {
      $("#respuesta2").css("display","block"); 
    
    }
else {
    $("#respuesta2").css("display","none"); 
  
}


});
});  
</script>

<script type="text/javascript">
  // Si pulsamos tecla en un Input
$("input").keydown(function (e){
  
  var keyCode= e.which;
  
  if (keyCode == 13){
    event.preventDefault();
    
    return false;
  }
});
</script>
<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupForm").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'guardar-usuario.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtn').attr("disabled","disabled");
        $('#fupForm').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsg').html('');
        if(response.status == 1){
          $('#fupForm')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsg').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupForm').css("opacity","");
        $(".submitBtn").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupForm2").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'update-usuario.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtn2').attr("disabled","disabled");
        $('#fupForm2').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsg2').html('');
        if(response.status == 1){
          $('#fupForm2')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsg2').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsg2').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupForm2').css("opacity","");
        $(".submitBtn2").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar").on("click",function()
 {

  var id = $(this).attr("data-id");
  var codigo = $(this).attr("data-codigo");
  var nombre = $(this).attr("data-nombre");
  var apellidos = $(this).attr("data-apellidos");
  var dir = $(this).attr("data-dir");
  var correo = $(this).attr("data-correo");
  var tel = $(this).attr("data-tel");
  var movil = $(this).attr("data-movil");
  var usuario = $(this).attr("data-usuario");
  var pass = $(this).attr("data-pass");
  var rol = $(this).attr("data-rol");
   var estado = $(this).attr("data-estado");
   var img = $(this).attr("data-img");
   
  //numeros_contacto = numeros_contacto.split(',');
  
  
  $("#id_usuario").val(id);
  $("#nombre").val(nombre);
  $("#apellidos").val(apellidos);
  $("#dir").val(dir);
  $("#correo").val(correo);
  $("#tel").val(tel);
  $("#movil").val(movil);
  $("#user2").val(usuario);
  $("#pass0").val(pass);
  $('#cmbrol option[value="'+rol+'"]').attr("selected", true);
  $('#cmbestado option[value="'+estado+'"]').attr("selected", true);
  $("#img").attr("src","dist/img/users/"+img);
  $("#imagen_actual").val(img);
  

  $("#myModalActualizar").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este usuario ?',
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
           url:"eliminar-user.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Usuario eliminado correctamente'
  
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title : 'AcademiaLink - Flujo del Proyecto' ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/dashboard/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/dashboard/jquery-ui/jquery-ui.css">

  <link rel="stylesheet" href="<?= BASE_URL ?>assets/dashboard/dist/css/nueva.css">

  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style-dasboard.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/root.css">

  
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
     
     <?php 
      if ($activos > 0) 
        { ?>
        <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?= $total_mensajes; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php 
            
$sth = $con->prepare("SELECT * FROM mensajes a LEFT JOIN users b ON a.emisor_id = b.id_usuario LEFT JOIN solicitudes c ON a.id_propuesta = c.id_solicitud WHERE a.receptor_id = ?");
$sth->bindParam(1, $usuario_id);
$sth->execute();

if ($sth->rowCount() > 0) 
{

foreach ($sth as $row ) 
{ ?>
          <a href="<?= BASE_URL ?>sala-chat" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <!--<i class="fas fa-solid fa-trash img-size-50 img-circle mr-3"></i>-->
              
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?= $row["nombre"]; ?> <?= $row["apellidos"]; ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-solid fa-trash"></i></span>
                </h3>
                <p class="text-sm"><?= $row["titulo"]; ?></p>
                <!--<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>-->
              </div>
            </div>
            <!-- Message End -->
          </a>
          <?php }
          } 
          ?>
          
          <div class="dropdown-divider"></div>
          <a href="<?= BASE_URL ?>sala-chat" class="dropdown-item dropdown-footer">Ver todos</a>
        </div>
      </li>
      <?php }
     ?>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?= $total; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?= $total; ?> Notificaciones</span>
          <div class="dropdown-divider"></div>
          <?php 
            
$sth = $con->prepare("SELECT * FROM notificaciones a LEFT JOIN solicitudes b ON a.solicitud_id = b.id_solicitud WHERE a.usuario_id = ?");
$sth->bindParam(1, $usuario_id);
$sth->execute();

if ($sth->rowCount() > 0) 
{

foreach ($sth as $row ) 
{ ?>

<a href="<?= BASE_URL ?>cotizaciones" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              
              <div class="media-body">
                <h3 class="dropdown-item-title <?php $resultado = ($row["leido"] == "No") ? "negrita" : ""; ?><?= $resultado; ?>">
                  Tienes novedades en tu cotización
                  <span class="float-right text-sm text-muted"><i class="fas fa-solid fa-trash"></i></span>
                </h3>
                <p class="text-center <?php $resultado = ($row["leido"] == "No") ? "negrita" : ""; ?> <?= $resultado; ?>"><?= $row["titulo"]; ?></p>
                
              </div>
            </div>
            <!-- Message End -->
          </a>
<!--<a href="#" class="dropdown-item">
<i class="fas fa-envelope mr-2"></i> Tienes novedades en tu cotización sobre la solicitud <?= $row["titulo"]; ?>

</a>
<div class="dropdown-divider"></div>-->
<?php }
}

?>
<div class="dropdown-divider"></div>

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

          Bienvenido
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            Mi perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= BASE_URL ?>logout" class="dropdown-item">
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
    <a href="<?= BASE_URL ?>admin" class="brand-link">
      <img src="<?= BASE_URL ?>assets/dashboard/dist/img/logo/<?= $logo; ?>" alt="sistema logotipo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema academia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= BASE_URL ?>assets/dashboard/dist/img/users/<?= $foto_perfil; ?>" class="img-circle elevation-2" alt="User Image">
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
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php require_once ROOT_PATH . 'include/dashboard/menu.php';?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
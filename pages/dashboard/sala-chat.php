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

$emisor_id = "";
if (isset($_GET['emisor_id'])) 
{
  $emisor_id = $_GET['emisor_id'];
}

$receptor_id = "";
if (isset($_GET['receptor_id'])) 
{
  $receptor_id = $_GET['receptor_id'];
}

$id_propuesta = "";
if (isset($_GET['id_propuesta'])) 
{
  $id_propuesta = $_GET['id_propuesta'];
}
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
<div class="col-lg-12">
 <div class="col-lg-4">
  <?php 
  $sth = $con->prepare("SELECT * FROM mensajes a LEFT JOIN users b ON a.emisor_id = b.id_usuario OR a.receptor_id = b.id_usuario LEFT JOIN solicitudes c ON a.id_propuesta = c.id_solicitud WHERE emisor_id = ? OR receptor_id = ?");
$sth->bindParam(1, $usuario_id);
$sth->bindParam(2, $usuario_id);

$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>
   <a href="#"><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></a><br>
   
<?php }
}

  ?>
</div>
<div class="col-lg-8" id="chatBox"></div> 
</div>

<div>
  <form id="fupFormMensaje">
<div class="row">
<div class="col-md-4">
<label>Mensaje</label>
<input type="text" class="form-control form-control-sm" name="mensaje" placeholder="Escribe tu mensaje">

</div>

<input type="text" class="form-control form-control-sm" name="emisor_id_chat" id="emisor_id_chat" value="<?= $emisor_id; ?>">
  <input type="text" class="form-control form-control-sm" name="receptor_id_chat" id="receptor_id_chat" value="<?= $receptor_id; ?>">
  <input type="text" class="form-control form-control-sm" name="id_propuesta" id="id_propuesta" value="<?= $id_propuesta; ?>">
  
    

</div> <!--FINAL ROW-->
<div class="row">

<!-- /.col -->
<div class="col-4">
<input type="submit" name="submit" class="btn btn-primary btn-rounded submitBtnmensaje" value="Guardar"/>
<!--<button type="submit" class="btn btn-secondary">Guardar</button>-->


</div>

<!-- /.col -->
</div>
<div class="statusMsgmensaje"></div>
</form>
  
</div>


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
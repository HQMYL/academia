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

$_SESSION['emisor_id'] = "";
if (isset($_GET['emisor_id'])) {
  $_SESSION['emisor_id'] = $_GET['emisor_id'];
}

$_SESSION['receptor_id'] = "";
if (isset($_GET['receptor_id'])) {
  $_SESSION['receptor_id'] = $_GET['receptor_id'];
}

$_SESSION['id_propuesta'] = "";
if (isset($_GET['id_propuesta'])) {
  $_SESSION['id_propuesta'] = $_GET['id_propuesta'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container">
    <div class="content container-fluid bootstrap snippets bootdey">
      <div class="row row-broken">

        <div class="col-sm-3 col-xs-12">
          <div class="col-inside-lg decor-default chat" style="overflow: hidden; outline: none;" tabindex="5000">
            <div class="col-12 title-chat">
              <div class="buttons-off">
                <button type="button" class="btn btn-info"><i class="fa fa-chevron-left"></i></button>
              </div>
              <h6>Salir del chat</h6>
            </div>
            <div class="chat-users">

              <div class="user">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status off"></div>
                </div>
                <div class="name">User name</div>
                <div class="mood">User mood</div>
              </div>
              <div class="user">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status online"></div>
                </div>
                <div class="name">User name</div>
                <div class="mood">User mood</div>
              </div>
              <div class="user">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User name">
                  <div class="status busy"></div>
                </div>
                <div class="name">User name</div>
                <div class="mood">User mood</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-9 col-xs-12 chat" style="overflow: hidden; outline: none;" tabindex="5001">

          <div class="chat-body">
            <div class="answer-chat" id="box">
              
            </div>
            <!-- INPUT DE CHAT -->
            <div class="answer-add">
              <input type="text" name="mensaje" placeholder="Write a message">
              <input type="hidden" class="form-control form-control-sm" name="emisor_id_chat" id="emisor_id_chat" value="<?= $_SESSION['emisor_id']; ?>">
  <input type="hidden" class="form-control form-control-sm" name="receptor_id_chat" id="receptor_id_chat" value="<?= $_SESSION['receptor_id']; ?>">
  <input type="hidden" class="form-control form-control-sm" name="id_propuesta" id="id_propuesta" value="<?= $_SESSION['id_propuesta']; ?>">
              <span class="answer-btn answer-btn-1"><i class="fa fa-paperclip"></i></span>
              <span class="answer-btn answer-btn-2"><i class="fa fa-paper-plane"></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.content-wrapper -->


<!-- Control Sidebar -->

<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php require_once ROOT_PATH .  'models/modales.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
<script>
  $(function() {
    $(".chat").niceScroll();
  })
</script>
<!-- jQuery -->
<?php require_once ROOT_PATH .  'include/dashboard/footer.php'; ?>
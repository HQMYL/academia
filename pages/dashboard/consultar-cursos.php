<?php
session_start();
require_once __DIR__ . '../../../init.php'; // Carga rutas y configuración
require_once ROOT_PATH . 'config/conexion.php';
require_once ROOT_PATH . 'config/conexiones.php';    
require_once ROOT_PATH .  'config/dbConfig.php';
require_once ROOT_PATH .  'models/Pagination.class.php';
$usuario = "";

if (isset($_SESSION["usuario"])) 
{
  $usuario = $_SESSION["usuario"];
} 
else 
{
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
              <li class="breadcrumb-item active">Consultar cursos</li>
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
            
            <label for="inputEmail4"></label>
            <div class="row align-items-stretch mb-5">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputPassword4">Filtrar</label>
                  <div class="d-filter">
                    <input type="text" class="form-control form-control-sm" name="keywords" id="keywords_curso" onkeyup="searchFilter_curso();"><br>
                    <!--<a value="Buscar" type="button" onclick="searchFilter_curso();"><i class="fas fa-search" ></i></a>-->
                    
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputPassword4">Filtrar por profesor asignado</label>
                  <select class="form-control form-control-sm" name="cmbusuario" id="cmbusuario" onchange="searchFilter_curso();">
                    <option value="">Seleccione...</option>
                    <?php
                    $asesor = "";
                    $asesor = "2";
                    $sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
                    $sth->bindParam(1, $asesor);
                    $sth->execute();

                    if ($sth->rowCount() > 0) {

                      foreach ($sth as $row) { ?>

                        <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></option>

                    <?php }
                    }
                    ?>
                  </select>

                </div>

              </div>

              <div class="col-md-4">
                <a class="btn btn-info cot" href="<?= BASE_URL ?>listado-cursos"><i class="fa fa-fw fa-sync"></i></a>
              </div>
            </div>
            <!-- ESPACIO PARA FILTROS -->
            <button type="button" class="btn btn-info agregar_curso"><i class="fa fa-solid fa-plus"></i> Agregar curso</button>
            <div class="datalist-wrapper">
              <!-- Loading overlay -->
              <div class="loading-overlay" style="display: none;">
                <div class="overlay-content">Cargando...</div>
              </div>

              <!-- Data list container -->

              <!-- ESPACIO PARA TABLA ORIGINAL-->
              <?php
              $baseURL = 'GetCursos.php';
              $limit = 5;

              // Count of all records
              #$mar = "208";
              #$whereSQL = "WHERE users.id = establecimientos.id_usuario ";
              $query   = $db->query("SELECT  COUNT(*) as rowNum FROM cursos ");
              $result  = $query->fetch_assoc();
              $rowCount = $result['rowNum'];

              // Initialize pagination class
              $pagConfig = array(
                'baseURL' => $baseURL,
                'totalRows' => $rowCount,
                'perPage' => $limit,
                'contentDiv' => 'dataContainercurso',
                'link_func' => 'searchFilter_curso'
              );
              $pagination =  new Pagination($pagConfig);

              // Fetch records based on the limit
              $query = $db->query("SELECT a.*,b.* FROM cursos a LEFT JOIN users b ON a.profesor_asignado= b.id_usuario ORDER BY a.id_curso ASC LIMIT $limit");


              if ($query->num_rows > 0) { ?>
                <div class="table-responsive" id="dataContainercurso">
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
                      while ($row = $query->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?= $row["nombre_curso"]; ?></td>
                          <td><?= $row["descripcion_curso"]; ?></td>
                          <td><?= $row["duracion"]; ?></td>
                          <td><?= $row["nombre"]; ?> <?= $row["apellidos"]; ?></td>

                          <td><button type="button" class="btn btn-info actualizar_curso" data-id="<?= $row['id_curso']; ?>" data-nombre="<?= $row['nombre_curso']; ?>" data-descripcion="<?= $row['descripcion_curso']; ?>" data-duracion="<?= $row['duracion']; ?>" data-asignado="<?= $row['profesor_asignado']; ?>"><i class="fas fa-edit"></i></button></td>
                          <td><button type="button" class="btn btn-danger delete_curso" data-id="<?= $row['id_curso']; ?>"><i class="fas fa-trash"></i> </button></td>
                        </tr>
                    <?php
                      }
                    } else {
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
<!-- ./wrapper -->
<?php require_once ROOT_PATH .  'models/modales.php'; ?>

<!-- jQuery -->
<?php require_once ROOT_PATH .  'include/dashboard/footer.php'; ?>
<!-- Dejar -->

<!-- GetCursos.php -->

<!-- guardar-curso -->

<!-- ACtualizar -->
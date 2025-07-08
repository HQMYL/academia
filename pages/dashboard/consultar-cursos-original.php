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
<button type="button" class="btn btn-info agregar_curso"><i class="fa fa-solid fa-plus"></i> Agregar curso</button>
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
<label for="inputPassword4">Filtrar por profesor asignado</label>
<select class="form-control form-control-sm" name="cmbusuario" id="cmbusuario" onchange="searchFilter();">
                  <option value="">Seleccione...</option>
                  <?php
                  $asesor = "";
                  $asesor = "2"; 
$sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
  { ?>

   <option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?></option>
   
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
 $baseURL = 'GetCursos.php';
$limit = 5;

// Count of all records
#$mar = "208";
#$whereSQL = "WHERE users.id = establecimientos.id_usuario ";
$query   = $db->query("SELECT  COUNT(*) as rowNum FROM cursos ");
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
$query = $db->query("SELECT a.*,b.* FROM cursos a LEFT JOIN users b ON a.profesor_asignado= b.id_usuario ORDER BY a.id_curso ASC LIMIT $limit");


if($query->num_rows > 0){?>
<div class="table-responsive" id="dataContainer">
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
<p class="modal-title" style="color: #fff;">Agregar curso</p>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form id="fupForm">
<div class="row">
<div class="col-md-4">
<label>Curso</label>
<input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre">
</div>

<div class="col-md-4">
<label>Descripción</label>
<textarea class="form-control form-control-sm" name="descripcion" cols="5"></textarea>

</div>

<div class="col-md-4">
<label>Duración</label>
<input type="text" class="form-control form-control-sm" name="duracion" placeholder="Duración">
</div>

<div class="col-md-4">
<label>Profesor asignado</label>
<select class="form-control form-control-sm" name="cmbusuario">
<option value="">Seleccione...</option>
<?php
$asesor = "";
$asesor = "2"; 
$sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?></option>

<?php }

}
?>
</select><br>
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
<p class="modal-title" style="color: #fff;">Actualizar curso</p>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form id="fupForm2">
<div class="row">
<div class="col-md-4">
<label>Curso</label>
<input type="text" class="form-control form-control-sm" name="nombre" id="nombre_curso" placeholder="Nombre">
</div>

<div class="col-md-4">
<label>Descripción</label>
<textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="5"></textarea>

</div>

<div class="col-md-4">
<label>Duración</label>
<input type="text" class="form-control form-control-sm" name="duracion" id="duracion" placeholder="Duración">
</div>

<div class="col-md-4">
<label>Profesor asignado</label>
<select class="form-control form-control-sm" name="asignado" id="asignado">
<option value="">Seleccione...</option>
<?php
$asesor = "";
$asesor = "2"; 
$sth = $con->prepare("SELECT * FROM users WHERE id_tipo = ? ");
$sth->bindParam(1, $asesor);
$sth->execute();

if ($sth->rowCount() > 0) {

foreach ($sth as $row ) 
{ ?>

<option value="<?= $row["id_usuario"]; ?>"><?= $row["nombre"]; ?></option>

<?php }

}
?>
</select>
<input type="hidden" class="form-control form-control-sm" name="id" id="id">
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
<script>
  const BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= BASE_URL ?>assets/css/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/pages/dashboard3.js"></script>
<script src="<?= BASE_URL ?>assets/css/dashboard/dist/js/sweetalert2@10.js"></script>
<script>
// Custom function to handle search and filter operations
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var asignado = $('#cmbusuario').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'controllers/GetCursos.php',
        data:'page='+page_num+'&keywords='+keywords+'&asignado='+asignado,
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

 $(".agregar_curso").on("click",function(){

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
      url:BASE_URL + 'controllers/guardar-curso.php',
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
      url: 'update-curso.php',
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
  var nombre = $(this).attr("data-nombre");
  var descripcion = $(this).attr("data-descripcion");
  var duracion = $(this).attr("data-duracion");
  var profesor_asignado = $(this).attr("data-asignado");
  
  $("#id").val(id);
  $("#nombre_curso").val(nombre);
  $("#descripcion").val(descripcion);
  $("#duracion").val(duracion);
  $('#asignado option[value="'+profesor_asignado+'"]').attr("selected", true);
  
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
    title: 'Desea eliminar este curso ?',
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
           url:"eliminar-curso.php",
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
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
</body>
</html>

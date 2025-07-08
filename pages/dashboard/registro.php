<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="col-lg-12">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>Sistema académico</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registráte</p>

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
$admin = "";
$admin = "1"; 
$sth = $con->prepare("SELECT * FROM roles WHERE id_rol != ? ");
$sth->bindParam(1, $admin);
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
      

      <a href="./" class="text-center">Ya tienes cuenta ?</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
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
     
  });
</script>
</body>
</html>

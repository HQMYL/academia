<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Sistema académico</strong>
    
    <!-- <div class="float-right d-none d-sm-inline-block">
      
    </div> -->
  </footer>
</div>
<script>
  const BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="<?= BASE_URL ?>assets/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= BASE_URL ?>assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= BASE_URL ?>assets/dashboard/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<!-- AdminLTE for demo purposes -->
<script src="<?= BASE_URL ?>assets/dashboard/dist/js/sweetalert2@10.js"></script>
<script src="<?= BASE_URL ?>assets/dashboard/jquery-ui/jquery-ui.js"></script>
<script>
// Custom function to handle search and filter operations
function searchFilter_usuario(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_usuario').val();
    var rol = $('#cmbrol').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'getUsuario',
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

  $("#myModalAgregarUsuario").modal({show:true});
  
  
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


    $("#fupFormAgregarUsuario").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'guardar-usuario',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnagregarusuario').attr("disabled","disabled");
        $('#fupFormAgregarUsuario').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgagregarusuario').html('');
        if(response.status == 1){
          $('#fupFormagregarusuario')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgagregarusuario').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregarusuario').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarUsuario').css("opacity","");
        $(".submitBtnagregarusuario").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarUsuario").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-usuario',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizarusuario').attr("disabled","disabled");
        $('#fupFormActualizarUsuario').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizarusuario').html('');
        if(response.status == 1){
          $('#fupFormActualizarUsuario')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizarusuario').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizarusuario').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarUsuario').css("opacity","");
        $(".submitBtnactualizarusuario").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_usuario").on("click",function()
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
  $("#img").attr("src","assets/dashboard/dist/img/users/"+img);
  $("#imagen_actual").val(img);
  $("#myModalActualizarUsuario").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_usuario").on("click",function(){

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
           url: BASE_URL + 'eliminar-user',
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
<script type="text/javascript">
  $(document).ready(function() {

    $(".agregar_curso").on("click", function() {

      $("#myModalAgregarCurso").modal({show:true});


    });

  });
</script>
<script>
  // Custom function to handle search and filter operations
  function searchFilter_curso(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords_curso').val();
    var asignado = $('#cmbusuario').val();

    $.ajax({
      type: 'POST',
      url: BASE_URL + 'getCurso',
      data: 'page=' + page_num + '&keywords=' + keywords + '&asignado=' + asignado,
      beforeSend: function() {
        $('.loading-overlay').show();
      },
      success: function(html) {
        $('#dataContainercurso').html(html);
        $('.loading-overlay').fadeOut("slow");
      }
    });
  }
</script>

<script>
  // Load content from external file
  $(document).ready(function() {
    $(".actualizar_curso").on("click", function() {

      var id = $(this).attr("data-id");
      var nombre = $(this).attr("data-nombre");
      var descripcion = $(this).attr("data-descripcion");
      var duracion = $(this).attr("data-duracion");
      var profesor_asignado = $(this).attr("data-asignado");

      $("#id_curso").val(id);
      $("#nombre_curso").val(nombre);
      $("#descripcion").val(descripcion);
      $("#duracion").val(duracion);
      $('#asignado option[value="' + profesor_asignado + '"]').attr("selected", true);

      $("#myModalActualizarCurso").modal({show:true});

    });



  });
</script>
<!-- Eliminar-curso -->
<script>
  // Load content from external file
  $(document).ready(function() {
    $(".delete_curso").on("click", function() {
      var id = $(this).attr("data-id");

      Swal.fire({
        title: 'Desea eliminar este curso ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#bb414d',
        cancelButtonColor: '#337AFF',
        cancelButtonText: 'Cerrar',
        confirmButtonText: 'Eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: BASE_URL + 'eliminar-curso',
            data: {
              "id": id
            }, // Adjuntar los campos del formulario enviado.

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
<script type="text/javascript">
  $(document).ready(function() {
    $("#fupFormAgregarCurso").submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: BASE_URL + 'guardar-curso',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('.submitBtnagregarcurso').attr("disabled", "disabled");
          $('#fupFormAgregarCurso').css("opacity", ".5");

        },
        success: function(response) {
          $('.statusMsgagregarcurso').html('');
          if (response.status == 1) {
            $('#fupFormAgregarCurso')[0].reset();
            //$('.statusMsg').css("background-color","green");
            $('.statusMsgagregarcurso').html('<p class="alert alert-primary">' + response.message + '</p>');
          } else {
            $('.statusMsgagregarcurso').html('<p class="alert alert-danger">' + response.message + '</p>');
          }
          $('#fupFormAgregarCurso').css("opacity", "");
          $(".submitBtnagregarcurso").removeAttr("disabled");
          setTimeout("location.reload()", 3000);
        }
      });
    });

    $("#fupFormActualizarCurso").submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: BASE_URL + 'update-curso',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('.submitBtnactualizarcurso').attr("disabled", "disabled");
          $('#fupFormActualizarCurso').css("opacity", ".5");

        },
        success: function(response) {
          $('.statusMsgactualizarcurso').html('');
          if (response.status == 1) {
            $('#fupFormActualizarCurso')[0].reset();
            //$('.statusMsg').css("background-color","green");
            $('.statusMsgactualizarcurso').html('<p class="alert alert-primary">' + response.message + '</p>');
          } else {
            $('.statusMsgactualizarcurso').html('<p class="alert alert-danger">' + response.message + '</p>');
          }
          $('#fupFormActualizarCurso').css("opacity", "");
          $(".submitBtnactualizarcurso").removeAttr("disabled");
          setTimeout("location.reload()", 3000);
        }
      });
    });


  });
</script>
<script>
// Custom function to handle search and filter operations
function searchFilter_trabajo(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_trabajo').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetTiposTrabajo',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainertrabajo').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<script type="text/javascript">
 $(document).ready(function() { 

 $(".agregar_tipo").on("click",function(){

  $("#myModalAgregarTipo").modal({show:true});
  
  
}); 

});
</script>

<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_tipo").on("click",function()
 {

  var id = $(this).attr("data-id");
  var tipo = $(this).attr("data-tipo");
  
  $("#id_tipo_trabajo").val(id);
  $("#tipo").val(tipo);

  $("#myModalActualizarTipo").modal({show:true});
  
});



});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_tipo").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este tipo de trabajo ?',
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
           url: BASE_URL + 'eliminar-tipo-trabajo',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar tipo de trabajo',
  text: 'Tipo de trabajo eliminado correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })
 
});

});
</script>

<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormAgregarTipo").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'guardar-tipo-trabajo',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnagregartipo').attr("disabled","disabled");
        $('#fupFormAgregarTipo').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgagregartipo').html('');
        if(response.status == 1){
          $('#fupFormAgregarTipo')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgagregartipo').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregartipo').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarTipo').css("opacity","");
        $(".submitBtnagregartipo").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarTipo").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-tipo-trabajo',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizartipo').attr("disabled","disabled");
        $('#fupFormActualizarTipo').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizartipo').html('');
        if(response.status == 1){
          $('#fupFormActualizarTipo')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizartipo').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizartipo').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarTipo').css("opacity","");
        $(".submitBtnactualizartipo").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>

<script>
// Custom function to handle search and filter operations
function searchFilter_materias(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_materias').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetMaterias',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainermaterias').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<script type="text/javascript">
 $(document).ready(function() { 

 $(".agregar_materia").on("click",function(){

  $("#myModalAgregarMateria").modal({show:true});
  
  
}); 

});
</script>


<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormAgregarMateria").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'guardar-materia',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnagregarmateria').attr("disabled","disabled");
        $('#fupFormAgregarMateria').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgagregarmateria').html('');
        if(response.status == 1){
          $('#fupFormAgregarMateria')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgagregarmateria').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregarmateria').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarMateria').css("opacity","");
        $(".submitBtnagregarmateria").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarMateria").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-materia',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizarmateria').attr("disabled","disabled");
        $('#fupFormActualizarMateria').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizarmateria').html('');
        if(response.status == 1){
          $('#fupFormActualizarMateria')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizarmateria').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizarmateria').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarMateria').css("opacity","");
        $(".submitBtnactualizarmateria").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_materia").on("click",function()
 {

  var id = $(this).attr("data-id");
  var materia = $(this).attr("data-materia");
  
  $("#id_materia").val(id);
  $("#materia").val(materia);

  $("#myModalActualizarMateria").modal({show:true});
  
});



});
</script>

<script>
// Load content from external file
$(document).ready(function() {
$(".delete_materia").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar esta materia ?',
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
           url: BASE_URL + 'eliminar-materia',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar materia',
  text: 'Materia eliminada correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});

});
</script>
<script>
// Custom function to handle search and filter operations
function searchFilter_niveles(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_niveles').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetNiveles',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainerniveles').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<script type="text/javascript">
 $(document).ready(function() { 

 $(".agregar_nivel").on("click",function(){

  $("#myModalAgregarNivel").modal({show:true});
  
  
}); 

});
</script>


<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormAgregarNivel").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'guardar-nivel-educativo',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnagregarnivel').attr("disabled","disabled");
        $('#fupFormAgregarNivel').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgagregarnivel').html('');
        if(response.status == 1){
          $('#fupFormAgregarNivel')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgagregarnivel').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregarnivel').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarNivel').css("opacity","");
        $(".submitBtnagregarnivel").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarNivel").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-nivel-educativo',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizarnivel').attr("disabled","disabled");
        $('#fupFormActualizarNivel').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizarnivel').html('');
        if(response.status == 1){
          $('#fupFormActualizarNivel')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizarnivel').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizarnivel').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarNivel').css("opacity","");
        $(".submitBtnactualizarnivel").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_nivel").on("click",function()
 {

  var id = $(this).attr("data-id");
  var nivel = $(this).attr("data-nivel");
  
  $("#id_nivel").val(id);
  $("#nivel").val(nivel);

  $("#myModalActualizarNivel").modal({show:true});
  
});

});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_nivel").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este nivel educativo ?',
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
           url: BASE_URL + 'eliminar-nivel-educativo',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar nivel educativo',
  text: 'Nivel educativo eliminado correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});



});
</script>

<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormActualizarLogotipo").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-logotipo',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnlogotipo').attr("disabled","disabled");
        $('#fupFormActualizarLogotipo').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsglogotipo').html('');
        if(response.status == 1){
          $('#fupFormActualizarLogotipo')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsglogotipo').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsglogotipo').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarLogotipo').css("opacity","");
        $(".submitBtnlogotipo").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });
     
  });
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_logotipo").on("click",function()
 {

  var id = $(this).attr("data-id");
  var imagen = $(this).attr("data-imagen");
  
  $("#id_logotipo").val(id);
  $("#imagen_actual").val(imagen);

  $("#myModalActualizarLogotipo").modal({show:true});
  
});



});
</script>

<script type="text/javascript">
$(document).ready(function(){
y = 1;
var maxField = 20; //Input fields increment limitation
var addButton = $('.agregar_documento'); //Add button selector
var wrapper = $('.field_wrapper'); //Input field wrapper
var fieldHTML = '<div><input type="file" id="archivo'+y+'" name="archivo[]" /><a href="javascript:void(0);" class="remove_button"><img src="dist/img/iconos/remove-icon.png"/></a></div>'; //New input field html 
//Initial field counter is 1

//Once add button is clicked
$(addButton).click(function(){
//Check maximum number of input fields
if(y < maxField){ 
y++; //Increment field counter
$(wrapper).append('<div><input type="file" id="archivo'+y+'" name="archivo[]" /><a href="javascript:void(0);" class="remove_button"><img src="assets/dashboard/dist/img/iconos/remove-icon.png"/></a></div>'); //Add field html
}
});

//Once remove button is clicked
$(wrapper).on('click', '.remove_button', function(e){
var id = $(this).attr("data-id");
e.preventDefault();
$(this).parent('div').remove(); //Remove field html
id--;//Decrement field counter
});
});
</script>
<script type="text/javascript">
  jQuery(function($){

    var hoy=new Date();
  $.datepicker.regional['es'] = {
    minDate: hoy,
    changeMonth: true,
changeYear: true,
    closeText: 'Cerrar',
    prevText: '&#x3c;Ant',
    nextText: 'Sig&#x3e;',
    currentText: 'Hoy',
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
    dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
    weekHeader: 'Sm',
    Format: 'yy/mm/dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['es']);
    $("#fecha").datepicker({
          
          dateFormat: 'yy/mm/dd'
        });
    $("#fecha_limite").datepicker({
          
          dateFormat: 'yy/mm/dd'
        });

    $("#fecha_inicial").datepicker({
          
          dateFormat: 'yy/mm/dd'
        });

    $("#fecha_final").datepicker({
          
          dateFormat: 'yy/mm/dd'
        });
});    
 
   $(document).ready(function() {
           

           //$("#datepicker2").datepicker({ appendText: ' Haga click para introducir una fecha' });
        });
</script>
<script>
// Custom function to handle search and filter operations
function searchFilter_solicitudes(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_solicitudes').val();
    var asesor = $('#cmbprof').val();
    var trabajo = $('#cmbtrabajo').val();
    var nivel_educativo = $('#cmbeducativo').val();
    var materia = $('#cmbmat').val();
    var fecha_inicial = $('#fecha_inicial').val();
    var fecha_final = $('#fecha_final').val();
    console.log(asesor);
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetSolicitudes',
        data:'page='+page_num+'&keywords='+keywords+'&asesor='+asesor+'&trabajo='+trabajo+'&nivel_educativo='+nivel_educativo+'&materia='+materia+'&fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainersolicitudes').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<script type="text/javascript">
 $(document).ready(function() { 

 $(".agregar_solicitud").on("click",function(){

  $("#myModalAgregarSolicitud").modal({show:true});
  
  
}); 

});
</script>

<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormAgregarSolicitud").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'guardar-solicitud',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtn').attr("disabled","disabled");
        $('#fupFormAgregarSolicitud').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsg').html('');
        if(response.status == 1){
          $('#fupFormAgregarSolicitud')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsggregarsolicitud').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsggregarsolicitud').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarSolicitud').css("opacity","");
        $(".submitBtnagregarsolicitud").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarSolicitud").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-solicitud',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizarsolicitud').attr("disabled","disabled");
        $('#fupFormActualizarSolicitud').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizarsolicitud').html('');
        if(response.status == 1){
          $('#fupFormActualizarSolicitud')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizarsolicitud').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgAactualizarolicitud').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarSolicitud').css("opacity","");
        $(".submitBtnactualizarsolicitud").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>

<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_solicitud").on("click",function()
 {

  var id = $(this).attr("data-id");
  var titulo = $(this).attr("data-titulo");
  var nivel_educativo = $(this).attr("data-nivel");
  var tipo_trabajo_id = $(this).attr("data-tipo_trabajo");
  var materia = $(this).attr("data-materia");
  var fecha_limite = $(this).attr("data-fecha");
  var descripcion = $(this).attr("data-descripcion");
  var id_asesor = $(this).attr("data-id_asesor");
  //console.log(id_asesor);
  var id_estudiante = $(this).attr("data-id_estudiante");
  var archivos = $(this).attr("data-archivos");
  $(".add_archivo").attr("archivo",id);
   archivos = archivos.split(',');
  $("#id_solicitud").val(id);
  $("#id_archivo_solicitud").val(id);
  $("#titulo").val(titulo);
  $('#cmbnivel option[value="'+nivel_educativo+'"]').attr("selected", true);
  $('#cmbtipo option[value="'+tipo_trabajo_id+'"]').attr("selected", true);
  $('#cmbmateria option[value="'+materia+'"]').attr("selected", true);
  $("#fecha_limite").val(fecha_limite);
  $("#descripcion_solicitud").val(descripcion);
  $('#cmbprof2 option[value="'+id_asesor+'"]').attr("selected", true);
  $("#id_estudiante").val(id_estudiante);
  
  for (let i = 0; i < archivos.length; i++)
   {
  
    $("#relleno").append('<tr><td>'+archivos[i]+'</td><td><button type="button" class="btn btn-success actualizar_archivo" data-id="'+id+'">Actualizar</button></td></tr>') 
   } 

  $("#myModalActualizarSolicitud").modal({show:true});

  $(".actualizar_archivo").on("click",function()
 {
    $("#myModalActualizarSolicitud").modal('toggle');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
  $("#myModalActualizarArchivo").modal({show:true});

 });

  $(".add_archivo").on("click",function()
 {
    //$("#myModalActualizarSolicitud").modal('toggle');
    //$('body').removeClass('modal-open');
    //$('.modal-backdrop').remove();
  $("#myModalAgregarArchivo").modal({show:true});

 });
  
});



$('#myModalActualizarSolicitud').on('hidden.bs.modal', function () 
{
  $("#relleno").html('');
});


});
</script>
<script>
// Load content from external file
$(document).ready(function() {
$(".delete_solicitud").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar este solicitud ?',
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
           url: BASE_URL + 'eliminar-solicitud',
           data: {"id":id},
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Solicitud eliminada correctamente'
  
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
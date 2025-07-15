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
$(wrapper).append('<div><input type="file" class="form-control form-control-sm pdf" id="archivo'+y+'" name="archivo[]" /><a href="javascript:void(0);" class="remove_button"><img src="assets/dashboard/dist/img/iconos/remove-icon.png"/></a></div>'); //Add field html
}

$('.pdf').on('change', function(){
  var fileList = $(this)[0].files || [] //registra todos los archivos
  for (file of fileList){ //una iteración de toda la vida
    ext=file.name.split('.').pop()
    //console.log('>ARCHIVO: ', file.name)
    if(ext != 'pdf' & ext != 'txt' & ext != 'pptx' & ext != 'xlsx' & ext != 'zip' & ext != 'rar' & ext != 'jpg' & ext != 'jpeg' & ext != 'gif' & ext != 'png' & ext != 'jfif')
    {
       $( this ).val('');
        Swal.fire({
  icon: 'warning',
  title: 'Tipo de archivo no permitido',
  text: 'Solo se permiten archivos PDF,TXT,PPTX,XLSX,ZIP,RAR,JPG,JPEG,GIF,PNG'
  
})

    }
    /*else{
        alert('>>TIPO DE ARCHIVO PDF CORRECTO');
    }*/
  }
});

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

function searchFilter_solicitudes_estudiante(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_estudiante').val();
    var asesor = $('#cmbasesor').val();
    var trabajo = $('#cmbtrabajo_estudiante').val();
    var nivel_educativo = $('#cmbeducativo_estudiante').val();
    var materia = $('#cmbmat_estudiante').val();
    var fecha_inicial = $('#fecha_inicial_estudiante').val();
    var fecha_final = $('#fecha_final_estudiante').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetSolicitudesEstudiante',
        data:'page='+page_num+'&keywords='+keywords+'&asesor='+asesor+'&trabajo='+trabajo+'&nivel_educativo='+nivel_educativo+'&materia='+materia+'&fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainerestudiante').html(html);
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
          $('.statusMsgagregarsolicitud').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregarsolicitud').html('<p class="alert alert-danger">'+response.message+'</p>');
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
  $('.enviar_cotizacion').attr("id",id);
  $(".add_archivo").attr("archivo",id);
   archivos = archivos.split(',');
  $("#id_solicitud").val(id);
  $("#id_archivo_solicitud").val(id);
  $("#id_cotizacion_solicitud").val(id);
  $("#titulo_cotizacion_solicitud").val(titulo);

  $("#id_estudiante_solicitud").val(id_estudiante);
  $("#titulo").val(titulo);
  $('#cmbnivel option[value="'+nivel_educativo+'"]').attr("selected", true);
  $('#cmbtipo option[value="'+tipo_trabajo_id+'"]').attr("selected", true);
  $('#cmbmateria option[value="'+materia+'"]').attr("selected", true);
  $("#fecha_limite").val(fecha_limite);
  $("#descripcion_solicitud").val(descripcion);
  $('#cmbprof2 option[value="'+id_asesor+'"]').attr("selected", true);
  $("#id_estudiante").val(id_estudiante);
  var contenedor = "";
  var ext = "";
  for (let i = 0; i < archivos.length; i++)
   {
    
    ext = archivos[i].split('.').pop()
    
    if(ext != 'jpg' & ext != 'jpeg' & ext != 'gif' & ext != 'png' & ext != 'jfif')
    {
       
      contenedor = '<tr><td><a href="assets/dashboard/dist/img/documentos/'+archivos[i]+'" download>'+archivos[i]+'</a></td><td><button type="button" class="btn btn-success actualizar_archivo" data-id="'+id+'" data-archivo="'+archivos[i]+'">Actualizar</button></td><td><button type="button" class="btn btn-danger delete_archivo" data-id="'+id+'" data-archivo="'+archivos[i]+'">Eliminar</button></td></tr>';
     $("#relleno").append(contenedor);

    }
    else 
    {

     contenedor = '<tr><td><img class="img-circle elevation-2" src="assets/dashboard/dist/img/documentos/'+archivos[i]+'" width="50";height="50";></td><td><button type="button" class="btn btn-success actualizar_archivo" data-id="'+id+'" data-archivo="'+archivos[i]+'">Actualizar</button></td><td><button type="button" class="btn btn-danger delete_archivo" data-id="'+id+'" data-archivo="'+archivos[i]+'">Eliminar</button></td></tr>';
      $("#relleno").append(contenedor);

    }
    
    
  }
    
     
   //} 

  $("#myModalActualizarSolicitud").modal({show:true});

  $(".actualizar_archivo").on("click",function()
 {
    var id = $(this).attr("data-id");
    var archivo_actual = $(this).attr("data-archivo");
    $("#archivo_actual_solicitud").val(archivo_actual);
    $("#id_sol").val(id);
    /*$("#myModalActualizarSolicitud").modal('toggle');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();*/
  $("#myModalActualizarArchivo").modal({show:true});

 });

  $(".delete_archivo").on("click",function(){

  var id = $(this).attr("data-id");
  var archivo = $(this).attr("data-archivo");
  
Swal.fire({
    title: 'Eliminar Archivo',
    text: 'Desea eliminar este archivo ?',
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
           url: BASE_URL + 'eliminar-archivo-solicitud',
           data: {"id":id,"archivo_actual":archivo},
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  title: 'Eliminar Archivo',
  text: 'Archivo eliminado correctamente'
  
})
      setTimeout("location.reload()", 3000);
             
            }

         });
    }
  })

});

  $(".add_archivo").on("click",function()
 {
   $("#myModalAgregarArchivo").modal({show:true});
 });

  $(".enviar_cotizacion").on("click",function()
 {
   $("#myModalEnviarCotizacion").modal({show:true});
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

<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormAgregarArchivo").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'agregar-archivo-solicitud',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnagregararchivo').attr("disabled","disabled");
        $('#fupFormAgregarArchivo').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgagregararchivo').html('');
        if(response.status == 1){
          $('#fupFormAgregarArchivo')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgagregararchivo').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgagregararchivo').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormAgregarArchivo').css("opacity","");
        $(".submitBtnagregararchivo").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

$("#fupFormActualizarArchivo").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-archivo-solicitud',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizararchivo').attr("disabled","disabled");
        $('#fupFormActualizarArchivo').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizararchivo').html('');
        if(response.status == 1){
          $('#fupFormActualizarArchivo')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizararchivo').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizararchivo').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarArchivo').css("opacity","");
        $(".submitBtnactualizararchivo").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

     
  });
</script>

<script type="text/javascript">
    $('.pdf').on('change', function(){
  var fileList = $(this)[0].files || [] //registra todos los archivos
  for (file of fileList){ //una iteración de toda la vida
    ext=file.name.split('.').pop()
    //console.log('>ARCHIVO: ', file.name)
    if(ext != 'pdf' & ext != 'txt' & ext != 'pptx' & ext != 'xlsx' & ext != 'zip' & ext != 'rar' & ext != 'jpg' & ext != 'jpeg' & ext != 'gif' & ext != 'png' & ext != 'jfif')
    {
       $( this ).val('');
        Swal.fire({
  icon: 'warning',
  title: 'Tipo de archivo no permitido',
  text: 'Solo se permiten archivos PDF,TXT,PPTX,XLSX,ZIP,RAR,JPG,JPEG,GIF,PNG'
  
})

    }
    /*else{
        alert('>>TIPO DE ARCHIVO PDF CORRECTO');
    }*/
  }
});
  </script>

  <script>
// Load content from external file
$(document).ready(function() {
$(".asignar_solicitud").on("click",function()
 {

  var id = $(this).attr("data-id");
  $("#id_asignado").val(id);
  
  $("#myModalAsignarSolicitud").modal({show:true});
  
});



});
</script>

<script type="text/javascript">
  
   $(document).ready(function() {   


    $("#fupFormEnviarCotizacion").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'enviar-cotizacion',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnenviarcotizacion').attr("disabled","disabled");
        $('#fupFormEnviarCotizacion').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgenviarcotizacion').html('');
        if(response.status == 1){
          $('#fupFormEnviarCotizacion')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgenviarcotizacion').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgenviarcotizacion').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormEnviarCotizacion').css("opacity","");
        $(".submitBtnenviarcotizacion").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });

    $("#fupFormActualizarCotizacion").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'update-cotizacion',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnactualizarcotizacion').attr("disabled","disabled");
        $('#fupFormActualizarCotizacion').css("opacity",".5");

      },
      success: function(response){
        $('.statusMsgactualizarcotizacion').html('');
        if(response.status == 1){
          $('#fupFormActualizarCotizacion')[0].reset();
          //$('.statusMsg').css("background-color","green");
          $('.statusMsgactualizarcotizacion').html('<p class="alert alert-primary">'+response.message+'</p>');
        }else{
          $('.statusMsgactualizarcotizacion').html('<p class="alert alert-danger">'+response.message+'</p>');
        }
        $('#fupFormActualizarCotizacion').css("opacity","");
        $(".submitBtnactualizarcotizacion").removeAttr("disabled");
        setTimeout("location.reload()", 3000);
      }
    });
  });
     
  });
</script>

<script>
// Load content from external file
$(document).ready(function() {
$(".actualizar_cotizacion").on("click",function()
 {
  $(".enviar_mensaje").css("display","none");

  var id = $(this).attr("data-id");
  var titulo = $(this).attr("data-titulo");
  var tiempo_entrega = $(this).attr("data-tiempo-entrega");
  var costo_total = $(this).attr("data-costo-total");
  var asesor_id = $(this).attr("data-asesor_id");
  var estudiante_id = $(this).attr("data-estudiante_id");
  var id_propuesta = $(this).attr("data-id_propuesta");
  var estado = $(this).attr("data-estado");
  var detalles = $(this).attr("data-detalles");
  var detalles_estudiante = $(this).attr("data-detalles_estudiante");
  var usuario_id = $("#usuario_id").val();
  $(".aceptar_propuesta").attr("data-id",id_propuesta);
  $(".rechazar_propuesta").attr("data-id",id_propuesta);
  //numeros_contacto = numeros_contacto.split(',');
  $.ajax({

           type: "POST",
           url: BASE_URL + 'cambiar-estado-notificacion',
           data: {"id_cotizacion":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) 
           {
            
           }

         });
  
  $("#id_cotizacion_solicitud2").val(id);
  $("#titulo_cotizacion").html(titulo);
  $("#titulo_cotizacion2").val(titulo);
  $("#tiempo_entrega2").val(tiempo_entrega);
  $("#costo_total2").val(costo_total);
  $("#detalles2").val(detalles);
  $("#estado_cotizacion").val(estado);
  $("#detalles_estudiante").val(detalles_estudiante);
  
  if (estado == "Aprobado") 
  {
    $(".enviar_mensaje").css("display","block");
  }
  else 
  {
    $(".enviar_mensaje").css("display","none");
  }
  if (usuario_id == asesor_id) 
  {
    $("#creador_id").val(asesor_id);
    $("#usuario_id_cotizacion").val(estudiante_id);
    $(".enviar_mensaje").attr("data-emisor_id",asesor_id);
    $(".enviar_mensaje").attr("data-receptor_id",estudiante_id);

  
  }
  else 
  {
    $("#creador_id").val(estudiante_id);
    $("#usuario_id_cotizacion").val(asesor_id);
    $(".enviar_mensaje").attr("data-emisor_id",estudiante_id);
    $(".enviar_mensaje").attr("data-receptor_id",asesor_id);

  }
  
  $(".enviar_mensaje").attr("data-id_propuesta",id_propuesta);

  $("#propuesta_id_cotizacion").val(id_propuesta);
  
  $("#myModalActualizarCotizacion").modal({show:true});
  
});

$(".delete_cotizacion").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea eliminar esta cotización ?',
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
           url: BASE_URL + 'eliminar-cotizacion',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Cotización eliminada correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});

$(".aceptar_propuesta").on("click",function(){

  var id = $(this).attr("data-id");

Swal.fire({
    title: 'Desea aceptar esta propuesta ?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#337AFF', 
    cancelButtonColor:  '#bb414d',
    cancelButtonText: 'Cerrar',
    confirmButtonText: 'Aceptar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({

           type: "POST",
           url: BASE_URL + 'aceptar-propuesta',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) 
           {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Propuesta aceptada correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});

$(".rechazar_propuesta").on("click",function(){

  var id = $(this).attr("data-id");
  
Swal.fire({
    title: 'Desea rechazar esta propuesta ?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#337AFF', 
    cancelButtonColor:  '#bb414d',
    cancelButtonText: 'Cerrar',
    confirmButtonText: 'Rechazar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({

           type: "POST",
           url: BASE_URL + 'rechazar-propuesta',
           data: {"id":id}, // Adjuntar los campos del formulario enviado.
           
           success: function(response) 
           {  
             Swal.fire({
  icon: 'success',
  //title: 'Eliminar Propiedad',
  text: 'Propuesta rechazada correctamente'
  
})
             setTimeout("location.reload()", 3000);
             

            }


         });
    }
  })



  
});

$(".enviar_mensaje").on("click",function(){

  var emisor_id = $(this).attr("data-emisor_id");
  var receptor_id = $(this).attr("data-receptor_id");
  var id_propuesta = $(this).attr("data-id_propuesta");
  
   window.location.href= BASE_URL+'sala-chat?emisor_id='+emisor_id+'&receptor_id='+receptor_id+'&id_propuesta='+id_propuesta;


  
});

});
</script>

<script type="text/javascript">
<!--
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
  if (o.createTextRange) {
    var r = document.selection.createRange().duplicate()
    r.moveEnd('character', o.value.length)
    if (r.text == '') return o.value.length
    return o.value.lastIndexOf(r.text)
  } else return o.selectionStart
}

</script>
<script type="text/javascript">
  $(".negrita").css("font-weight","bold");
</script>

<script>
// Custom function to handle search and filter operations
function searchFilter_cotizaciones_estudiante(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords_cotizacion_estudiante').val();
    var asesor = $('#cmbasesor_cotizacion').val();
    
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'GetCotizacionesEstudiante',
        data:'page='+page_num+'&keywords='+keywords+'&asesor='+asesor,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainercotizacionesestudiante').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>


<script>
        $(document).ready(function() {
            // Fetch messages every 3 seconds
            setInterval(fetchMessages, 3000);
            let chatDiv = document.getElementById('chatBox');
            function scrollChatToBottom(chatDiv) 
            {
             chatDiv.scrollTop = chatDiv.scrollHeight;
            }

            // Send message on button click
            /*$('#sendBtn').click(function() {
                var mensaje = $('#messageInput').val();
                var emisor_id = $("#emisor_id_chat").val();
                var receptor_id = $("receptor_id_chat").val();
                var id_propuesta = $("#id_propuesta").val();  

                $.ajax({
                    url: BASE_URL + 'registrar-mensaje',
                    method: 'POST',
                    data: {"mensaje":mensaje,"emisor_id":emisor_id,"receptor_id":receptor_id,"id_propuesta":id_propuesta},
                    success: function() {
                        $('#messageInput').val('');  // Clear input field
                        fetchMessages();  // Refresh message display

                    }
                });
                scrollChatToBottom(chatDiv);
            });*/

            $("#fupFormMensaje").submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'registrar-mensaje',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtnmensaje').attr("disabled","disabled");
        $('#fupFormMensaje').css("opacity",".5");

      },
      success: function(response)
      {
        $('#fupFormMensaje')[0].reset();
        $('#fupFormMensaje').css("opacity","");
        $(".submitBtnmensaje").removeAttr("disabled");
        fetchMessages();
        scrollChatToBottom(chatDiv);
      }
    });
  });


            // Function to fetch messages
            function fetchMessages() {
                $.ajax({
                    url: BASE_URL + 'obtener-mensajes',
                    method: 'GET',
                    dataType: 'json',
                    success: function(messages) {
                        $('#chatBox').empty();  // Clear previous messages
                        messages.reverse().forEach(function(message) {
                            $('#chatBox').append('<p><strong>' + message.nombre + " " + message.apellidos +':</strong> ' + message.mensaje + '</p>');
                        });
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
      // Obtener la URL actual
const currentUrl = window.location.href;

// Obtener todos los enlaces de la página
const links = document.querySelectorAll('a');

// Iterar sobre los enlaces
links.forEach(link => {
  // Verificar si la URL del enlace coincide con la URL actual
  if (link.href === currentUrl) {
    // Agregar una clase "active" al enlace
    link.classList.add('active');
  }
});
    </script>
</body>
</html>
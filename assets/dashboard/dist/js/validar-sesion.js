$("#fupForm").on("submit",function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'validar.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend: function(){
        $('.submitBtn').attr("disabled","disabled");
        $('#fupForm').css("opacity",".5");

      },
      success: function(response)
      {
        $('.statusMsg').html('');
        if(response.status == 1)
        {
            location.href = "admin.php";
          
        }
        else
        {
          $('.statusMsg').html('<p class="alert alert-info" style="background-color:#0A5CC5;color:#fff;font-size:20px;text-align:center">'+response.message+'</p>');
        }
        $('#fupForm').css("opacity","");
        $(".submitBtn").removeAttr("disabled");
      }
    });
  });
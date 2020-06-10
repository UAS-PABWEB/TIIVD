    $( "#goLogin").click(function() {
      var formData = new FormData($('#admin_login')[0]);
      $.ajax({
          url : "<?=site_url('admin/login/auth')?>",
          type: "POST",
          data: formData,
          contentType: false,          
          processData:false,
          success: function(data)
          {
              $("input").removeAttr("disabled","disabled");
              if(data.result) 
              {
                  $('#message').html('<div class="alert green">'+data.content+'</div>');
                  window.location.replace('<?=base_url()?>');
              }else{
                  $('#message').html('<div class="alert red">'+data.content+'</div>');

              }
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              $("input").removeAttr("disabled","disabled");
              $('#message').html('<div class="alert red">Terjadi kesalahan</div>');
   
          }
          ,beforeSend:function()
              {
              $("input").attr("disabled","disabled");
              $("#message").html('<div class="progress blue lighten-4"><div class="indeterminate blue"></div> </div>');
          }
      });
        return false;
    });
<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url()."assets/"?>css/materialize.css">
  <link rel="stylesheet" href="<?=base_url()."assets/"?>css/style.css">
  <link rel="stylesheet" href="<?=base_url()."assets/"?>css/admin.css">
  <link rel="stylesheet" href="<?=base_url()."assets/"?>css/dataTables.material.min.css">
</head>
<body><div class="auth-page">
  <div class="container">
    <div class="row">
      <div class="col l4 m6 s12 offset-l4 offset-m3">
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              <div class="title-card blue white-text">
               <center><img width="200px" src="<?=base_url()?>assets/images/logo-text-white.png">
                 <h5 class="light">Halaman Administrator</h5>
               </center>
             </div>
             <div class="card-content">
              <form id="admin_login">
                <div class="container">
                  <div class="row">
                    <div id="message"></div></div>
                    <div class="row">
                      <div class="input-field">
                        <i class="material-icons prefix">person</i>   
                        <input name="username" id="icon_prefix" type="text">
                        <label>Username</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input type="password" name="password">
                        <label>Password</label>
                      </div>
                    </div>
                    <button type="submit" name="login" id="goLogin" class="btn blue">Masuk</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url()."assets/"?>js/jquery.js"></script>
<script src="<?=base_url()."assets/"?>js/materialize.min.js"></script>
<script type="text/javascript">
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
          window.location.replace('<?=base_url('admin/dashboard')?>');
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
</script>
</body>
</html>
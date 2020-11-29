<?php 
include('config/config.php'); 
if (empty($_SESSION['login'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" href="<?php echo $base_url."" ?>assets/images/store.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $system_title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $base_url."assets/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/bower_components/metisMenu/dist/metisMenu.min.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/dist/css/sb-admin-2.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url."assets/css/toastr.min.css" ?>" rel="stylesheet">

</head>
<style type="text/css" media="screen">
    body{
        background-image: url(assets/images/bg.jpg);
    }
    .panel-default .panel-heading{
        background-color: #05C986;
        color: #eee;
    }
    .panel-default{
        border-color: #05C986 solid 2px; 
    }
    .panel-info .panel-heading{
        background-color: #05C986;
        color: #eee;
    }
    .panel-body{
        background: transparent;
    }
    
</style>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"> L O G I N </h3>
                    </div>
                    <div class="panel-body">
                      <fieldset>
                          <div class="form-group">
                              <div class="input-group">
                                <input class="form-control" placeholder="Username" id="username" name="username" type="text" autofocus="">
                                <div class="input-group-addon"><i class="fa fa-user-circle"></i></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                                <div class="input-group-addon">
                                  <label>
                                    <input type="checkbox" id="showP" class="showP">
                                    <i class="fa fa-eye" id="buttonShow"></i>
                                  </label>
                                </div>
                              </div>
                          </div>
                          <button type="submit" id="loginButton" name="loginButton" class="btn btn-lg btn-success btn-block">
                              <span>L O G I N</span>
                          </button>
                          <div id="resultLogin"></div>
                      </fieldset>
                    </div>
                    <div class="panel-body text-center">
                      <div class="clearfix"><legend></legend></div>
                      <b><?php echo $system_header ?></b><br>
                      <span class="fa fa-calendar"></span>
                      <i><?php echo $hari.", ". $tgl." ".$bln." ".$thn ?></i>
                      <span class="fa fa-clock-o"></span>
                      <i id="watch"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo $base_url."assets/bower_components/jquery/dist/jquery.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/metisMenu/dist/metisMenu.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/dist/js/sb-admin-2.js" ?>"></script>
    <!-- <script src="<?php echo $base_url."assets/js/sweetalert.min.js" ?>"></script> -->
    <script src="<?php echo $base_url."assets/js/toastr.min.js" ?>"></script>

<script type="text/javascript">

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "200",
    "hideDuration": "900",
    "timeOut": "4000",
    "extendedTimeOut": "900",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  $(document).ready(function(){
    $('#showP').hide();

    $('.showP').click(function(){
      if($(this).is(':checked')){
        $('#password').attr('type','text');
        $('#buttonShow').removeClass('fa-eye');
        $('#buttonShow').addClass('fa-eye-slash');
      }else{
        $('#password').attr('type','password');
        $('#buttonShow').removeClass('fa-eye-slash');
        $('#buttonShow').addClass('fa-eye');
      }
    });
  });
    
  // Ajax Login 
  function actionLogin(){
    var username = $('#username').val();
    var password = $('#password').val();

      if(username != "" && password != ""){
        // Progress Load
        document.getElementById('username').disabled = true;
        document.getElementById('password').disabled = true;
        document.getElementById('loginButton').disabled = true;
        $("#resultLogin").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><font size='2'>Sedang Proses ...</font></center>");
        // Result
        $.ajax({
            type:"post",
            url:"<?php echo $base_url."pages/login/login-validate.php" ?>",
            data:'username='+username+'&password='+password,
            success:function(data){
              $("#resultLogin").html(data);
            }
        });
      }                                    
  }

      $("#loginButton").click(function(){
        if ($('#username').val()=='') {
          toastr['error']('Username Harus Diisi ya!');
          $("#username").focus();        
        }
        else if ($('#password').val()=='') {
          
          toastr['error']('Password Harus Diisi ya!');
          $("#password").focus();          
        }
        else{
            actionLogin();
        }
      });

      $('#username').keyup(function(e) {
          if(e.keyCode == 13) {
            if ($('#username').val()=='') {
              
              toastr['error']('Username Harus Diisi ya!');
              $("#username").focus();          
            }
            else if ($('#username').val()!='') {
              $("#password").focus();          
            }
          }
      });

      $('#password').keyup(function(e) {
          if(e.keyCode == 13) {
            if ($('#password').val()=='') {
              
              toastr['error']('Password Harus Diisi ya!');
              $("#password").focus();          
            }
            else if ($('#password').val()!='') {
              $("#loginButton").focus();          
            }
          }
      });

      $('#password').keyup(function(e) {
          if(e.keyCode == 13) {
            if ($('#password').val()!='') {
                actionLogin();          
            }
          }
      });

      $(document).ready(function(){
          function clock() {
            var now = new Date();
            var secs = ('0' + now.getSeconds()).slice(-2);
            var mins = ('0' + now.getMinutes()).slice(-2);
            var hr = now.getHours();
            var Time = hr + ":" + mins + ":" + secs;
            document.getElementById("watch").innerHTML = Time;
            requestAnimationFrame(clock);
          }
          requestAnimationFrame(clock);
      });
</script>
</body>
</html>

<?php 
}
elseif (!empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        //alert('Anda Belum Login');
        
        toastr['success']('Berhasil", "session anda masih ada., Mohon Tunggu ...');
        window.location="<?php echo $base_url."" ?>dashboard";
    </script>
    <?php
}
 ?>
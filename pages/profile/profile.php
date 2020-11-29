<?php 
  include('../../config/config.php'); 
    $id_profile = $_SESSION['login']['id_user'];
    // var_dump($id_profile);
    $querySelectUser =  mysqli_query($config, " 
    SELECT tb_system_user.*, tb_system_user_role.role_description 
      FROM tb_system_user INNER JOIN tb_system_user_role
      ON tb_system_user.access_level = tb_system_user_role.id
      WHERE tb_system_user.is_active = 'A' 
      AND id_user = '$id_profile' ");
      $rowSelectUser = mysqli_fetch_array($querySelectUser);
        $id_user		    = $rowSelectUser['id_user'];
        $user_name		  = $rowSelectUser['user_name'];
        $password       = $rowSelectUser['user_password'];
        $full_name      = $rowSelectUser['user_full_name'];
        $address        = $rowSelectUser['user_address'];
        $email          = $rowSelectUser['user_email'];
        $phone       	  = $rowSelectUser['user_phone'];
        $birthday       = $rowSelectUser['user_birthday'];
        $role           = $rowSelectUser['role_description'];

        if ($rowSelectUser['user_gender'] == 1) {
	        $gender = 'Laki - Laki';
        }
        else{
	        $gender = 'Wanita';        	
        }

        $tanggal = new DateTime($birthday);
        $today = new DateTime('today');
        $y = $today->diff($tanggal)->y;
        $m = $today->diff($tanggal)->m;
        $d = $today->diff($tanggal)->d;
 ?>

<style>
  .tab-pane{
    color:#105fb3;
    /* font-size:12px; */
  }
</style>

<div class="panel-heading">
    <b>Profil "<i><?php echo $user_name ?></i>"</b>
    <a href="#" onclick="history.go(0);" class="close" aria-hidden="true">&times;</a>
</div>
  <div class="panel-body">
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#detailProfile" aria-controls="detailProfile" role="tab" data-toggle="tab"><i class="fa fa-eye"></i> Detail</a>
          </li>
          <li role="presentation">
            <a href="#updateProfile" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-pencil"></i> Edit Profil</a>
          </li>
          <li role="presentation">
            <a href="#updatePassword" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-lock"></i> Ubah Password</a>
          </li>
          <li role="presentation">
            <a href="#activity" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-sliders"></i> Aktifitas</a>
          </li>
        </ul>
      
        <!-- Tab DETAIL -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="detailProfile">
            <div class="clearfix"><br></div>
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Detail User
                  </h3>
                </div>
                <div class="panel-body">
                  <table class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <td><i class="fa-fw fa fa-user-o"></i> Nama Lengkap </td>
                          <td>:</td>
                          <td><?php echo $full_name ?></td>
                        </tr>
                        <tr>
                          <td><i class="fa-fw fa fa-map-marker"></i> Alamat </td>
                          <td>:</td>
                          <td><?php echo $address ?></td>
                        </tr>
                          <td><i class="fa-fw fa fa-envelope-o"></i> Email </td>
                          <td>:</td>
                          <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                          <td><i class="fa-fw fa fa-phone"></i> Telp </td>
                          <td>:</td>
                          <td><?php echo $phone ?></td>
                        </tr>
                        <tr>
                          <td><i class="fa-fw fa fa-venus-mars"></i>  Gender </td>
                          <td>:</td>
                          <td><?php echo $gender ?></td>
                        </tr>
                        <tr>
                          <td><i class="fa-fw fa fa-calendar-check-o"></i> Tgl Lahir </td>
                          <td>:</td>
                          <td><?php echo $birthday." ($y)" ?></td>
                          <!-- <td><?php echo $birthday." ($y Thn $m Bln $d Hr)" ?></td> -->
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Detail Login
                    </h3>
                  </div>
                  <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <td width="100"><i class="fa-fw fa fa-user-circle"></i> Username </td>
                            <td width="10">:</td>
                            <td width="150"><?php echo $user_name ?></td>
                          </tr>
                          <tr>
                            <td><i class="fa-fw fa fa-unlock locked"></i> Password </td>
                            <td>:</td>
                            <td>
                              <span id="showPassword">******</span> 
                              <label>
                                <input type="checkbox" id="showPasswordButton" class="showPasswordButton">
                                <i class="fa fa-eye" id="buttonEye"> Show</i>
                              </label>
                            </td>
                          </tr>
                          <script>
                            $(document).ready(function(){
                              var password_string = '<?php echo $password ?>';
                              $('#showPassword').html(password_string.replace(/[A-Z a-z]/g, '*'));
                              $('#showPasswordButton').hide();
                              
                              $('#showPasswordButton').click(function(){
                                if($(this).is(':checked')){
                                  $('.locked').removeClass('fa-unlock');
                                  $('.locked').addClass('fa-lock');
                                  $('#showPassword').html(password_string);
                                  $('#buttonEye').removeClass('fa-eye');
                                  $('#buttonEye').addClass('fa-eye-slash');
                                  $('#buttonEye').html(' Hide');
                                }else{
                                  $('.locked').removeClass('fa-lock');
                                  $('.locked').addClass('fa-unlock');
                                  $('#showPassword').html(password_string.replace(/[A-Z a-z]/g, '*'));
                                  $('#buttonEye').removeClass('fa-eye-slash');
                                  $('#buttonEye').addClass('fa-eye');  
                                  $('#buttonEye').html(' Show');                               
                                }
                              });
                            });
                            
                            tooltips();
                          </script>
                          <tr>
                            <td><i class="fa-fw fa fa-blind"></i> Level</td>
                            <td>:</td>
                            <td><?php echo $role ?></td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

          <div role="tabpanel" class="tab-pane" id="updateProfile">
            <div class="clearfix"><br></div>
            <!-- Update Profile -->
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Edit Profil
                    </h3>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="hidden" name="p_idUser" id="p_idUser" value="<?php echo $id_user ?>">
                            <input type="text" class="form-control" name="p_firstName" id="p_firstName" title="Nama Lengkap" required="" autofocus="" value="<?php echo $full_name ?>">
                        </div>
                      </div>
                      <div class="col-md-12"> 
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="p_address" id="p_address" placeholder="Alamat" style="height: 50px" value="<?php echo $address ?>">
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="p_email" id="p_email" value="<?php echo $email ?>">
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label>Tgl lahir</label>
                            <input type="date" class="form-control" name="p_birthday" id="p_birthday" value="<?php echo $birthday ?>">
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label>Telp</label>
                            <input type="text" class="form-control" name="p_telp" id="p_telp" value="<?php echo $phone ?>">
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="p_gender" id="p_gender" class="form-control" required="">
                              <option value="">-- Pilih --</option>
                              <option <?php if ($rowSelectUser['user_gender'] == '1') {echo "SELECTED";} ?> value="1">Laki - Laki</option>
                              <option <?php if ($rowSelectUser['user_gender'] == '2') {echo "SELECTED";} ?> value="2">Perempuan</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12"> 
                        <legend></legend>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"> 
                        <button type="submit" id="buttonUpdateProfile" class="btn btn-primary">Simpan</button>
                        <!-- <button type="button" id="buttonCancelProfile" class="btn btn-default" data-dismiss="modal">Batal</button> -->
                      </div>
                      <div class="col-md-8">
                        <div id="resultProfile"></div>
                      </div>
                    </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>
          </div>
<script type="text/javascript">
  // VAlidation Password
  $('#p_firstName').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#p_firstName').val() == '') {
        toastr['error']("Nama Lengkap Harus Di Isi!");
        $('#p_firstName').focus();
      }else {
        $('#p_address').focus();
      }
    }
  });
  $('#p_address').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#p_email').focus();
    }
  });
  $('#p_email').keyup(function(e) {
    if(e.keyCode == 13) {
        $('#p_birthday').focus();
    }
  });
  $('#p_birthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#p_birthday').val() == '') {
        toastr['error']("Tanggal Lahir Harus Di Isi!");
        $('#p_birthday').focus();
      }else {
        $('#p_telp').focus();
      }
    }
  });
  $('#p_telp').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#p_gender').focus();
    }
  });
  $('#p_gender').change(function(e) {
    if ($('#p_gender').val() == '') {
      toastr['error']("Gender Belum Dipilih!");
      $('#p_gender').focus();
    }else {
      $('#buttonUpdateProfile').focus();
    }
  });

  function closeForm(){
    $("#clickProfile").modal('hide');
  }
  function updateProfile(){
    var p_idUser      = $("#p_idUser").val();
    var p_firstName   = $("#p_firstName").val();
    var p_address     = $("#p_address").val();
    var p_email       = $("#p_email").val();
    var p_birthday    = $("#p_birthday").val();
    var p_telp        = $("#p_telp").val();
    var p_gender      = $("#p_gender").val();

    if ($("#p_idUser").val() == "") {
      toastr['error']("Password Lama Harus Di Isi!");
      $('#p_idUser').focus();
    }else if($('#p_firstName').val() == ''){
      toastr['error']("Nama Lengkap Harus Di Isi!");
      $('#p_firstName').focus();
    }else if($('#p_birthday').val() == ''){
      toastr['error']("Tanggal Lahir Harus Di Isi!");
      $('#p_birthday').focus();
    }else if($('#p_gender').val() == ''){
      toastr['error']("Gender Belum Dipilih!");
      $('#p_gender').focus();
    }else{
      disableUpdateProfile();
      $("#resultProfile").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='25' height='25'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/profile/updateProfile.php" ?>",
          data:"p_idUser="+p_idUser+"&p_firstName="+p_firstName+"&p_address="+p_address+"&p_email="+p_email+"&p_birthday="+p_birthday+"&p_telp="+p_telp+"&p_gender="+p_gender,
          success:function(data){
            $("#resultProfile").html(data);
          }
      });
    }
  }

  $('#buttonUpdateProfile').click(function(event) {
    updateProfile();
  });

  function disableUpdateProfile(){
    document.getElementById('buttonUpdateProfile').diabled = true;
    // document.getElementById('buttonCancelProfile').diabled = true;
  }
  function enableUpdateProfile(){
    document.getElementById('buttonUpdateProfile').diabled = false;
    // document.getElementById('buttonCancelProfile').diabled = false;
  }
</script>
          <!-- //Update Profile --> 
          <div role="tabpanel" class="tab-pane" id="updatePassword">
            <div class="clearfix"><br></div>
              <!-- Update Password -->            
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Edit Password
                    </h3>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Password Lama</label>
                          <div class="form-group">
                          <input type="hidden" name="idUser" id="idUser" value="<?php echo $id_user ?>">
                            <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="*****">
                          </div>
                        </div>
                        <div  class="form-group">
                          <label>Password Baru</label>
                          <div class="form-group">
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="*****">
                          </div>
                        </div>
                        <div  class="form-group">
                          <label>Konfirmasi Password</label>
                          <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="*****">
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-12"> 
                          <legend></legend>
                        </div>
                      </div>
                    <div class="row">
                      <div class="col-md-6">
                        <button id="buttonPassword" class="btn btn-primary">Submit</button>
                        <!-- <button id="buttonCancelPassword" class="btn btn-default" data-dismiss="modal">Batal</button> -->
                        <label>
                            <input type="checkbox" id="showP" class="showP">
                            <i class="fa fa-eye" id="buttonShow"></i> Show Password
                          </label>
                      </div>
                      <div class="col-md-6">
                        <div id="resultPassword"></div>
                      </div>                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- //Update Password -->
          </div>
<script type="text/javascript">

  $(document).ready(function(){		
      $('.showP').hide();
      $('.showP').click(function(){
        if($(this).is(':checked')){
          $('#oldPassword').attr('type','text');
          $('#newPassword').attr('type','text');
          $('#password').attr('type','text');
          $('#buttonShow').removeClass('fa-eye');
          $('#buttonShow').addClass('fa-eye-slash');
        }else{
          $('#oldPassword').attr('type','password');
          $('#newPassword').attr('type','password');
          $('#password').attr('type','password');
          $('#buttonShow').removeClass('fa-eye-slash');
          $('#buttonShow').addClass('fa-eye');
        }
      });
    });
  
  // VAlidation Password
  $('#oldPassword').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#oldPassword').val() == '') {
        toastr['error']("Password Lama Harus Di Isi!");
        $('#oldPassword').focus();
      }else {
        $('#newPassword').focus();
      }
    }
  });
  $('#newPassword').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#newPassword').val() == '') {
        toastr['error']("Password Baru Harus Di Isi!");
        $('#newPassword').focus();
      }else {$('#password').focus();}
    }
  });
  $('#password').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#password').val() == '') {
        toastr['error']("Konfirmasi Password Harus Di Isi!");
        $('#password').focus();
      }else {
        $('#buttonPassword').focus();
      }
    }
  });

  function updatePassword(){
    var idUser      = $("#idUser").val();
    var oldPassword = $("#oldPassword").val();
    var newPassword = $("#newPassword").val();
    var password    = $("#password").val();

    if ($("#oldPassword").val() == "") {
      toastr['error']("Password Lama Harus Di Isi!");
      $('#oldPassword').focus();
    }else if($('#newPassword').val() == ''){
      toastr['error']("Password Baru Harus Di Isi!");
      $('#newPassword').focus();
    }else if($('#password').val() == ''){
      toastr['error']("Konfirmasi Password Harus Di Isi!");
      $('#password').focus();
    }else{
      disabledPassword();
      $("#resultPassword").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/profile/updatePassword.php" ?>",
          data:"idUser="+idUser+"&oldPassword="+oldPassword+"&newPassword="+newPassword+"&password="+password,
          success:function(data){
            $("#resultPassword").html(data);
          }
      });
    }
  }

  $("#buttonPassword").click(function(event) {
    updatePassword();
  });
</script>

  <!-- Tab User Activity-->
    <div role="tabpanel" class="tab-pane" id="activity">
      <div class="clearfix"><br></div>
        <div class="panel-body">
          <ul class="timeline">
                <?php 
                  $id_profile = $_POST['id_profile'];
                  $query =  mysqli_query($config, " 
                  SELECT * FROM log_activity WHERE user_name = '$user_name' AND log_date BETWEEN '$currentDate 00:00:00' AND '$currentDate 23:59:59' ORDER BY log_date DESC LIMIT 10  ");

                    $number = 0;
                    while ($row = mysqli_fetch_array($query)){
                      $number           = $number + 1 ;
                      $id_log           = $row['id_log'];
                      $log_menu         = $row['log_menu'];
                      $log_description  = $row['log_description'];
                      $log_date         = $row['log_date'];
                      $ip_address       = $row['ip_address'];
                      $log_os           = $row['log_os'];
                      $log_browser      = $row['log_browser'];
                      $user_name        = $row['user_name'];
                      $icon = '';
                      $explode_log      = explode('v.', $log_browser);

                        if($log_menu == 'LOGIN') {
                          $icon = '<li><div class="timeline-badge text-center icon-activity primary"><i class="fa fa-2x fa-sign-in"></i></div>';
                        } elseif($log_menu == 'LOGOUT'){
                          $icon = '<li><div class="timeline-badge text-center icon-activity danger"><i class="fa fa-2x fa-power-off"></i></div>';
                        } elseif($log_menu == 'CHECKOUT SELLING'){ 
                          $icon = '<li><div class="timeline-badge text-center icon-activity success"><i class="fa fa-2x fa-cart-plus"></i></div>';
                        } elseif($log_menu == 'CHECKOUT BUYING'){
                          $icon = '<li><div class="timeline-badge text-center icon-activity warning"><i class="fa fa-2x fa-cart-arrow-down"></i></div>';
                        } elseif($log_menu == 'STOCK OPNAME') {
                          $icon = '<li><div class="timeline-badge text-center icon-activity success"><i class="fa fa-2x fa-archive"></i></div>';
                        } elseif($log_menu == 'INSERT') {
                          $icon = '<li><div class="timeline-badge text-center icon-activity success"><i class="fa fa-2x fa-save"></i></div>';
                        } elseif($log_menu == 'READ') {
                          $icon = '<li class="timeline-inverted"><div class="timeline-badge text-center icon-activity info"><i class="fa fa-2x fa-book"></i></div>';
                        } elseif ($log_menu == 'UPDATE') {
                          $icon = '<li class="timeline-inverted">
                            <div class="timeline-badge text-center icon-activity warning"><i class="fa fa-2x fa-pencil"></i></div>';
                        } elseif ($log_menu == 'ARCHIVE') {
                          $icon = '<li class="timeline-inverted"><div class="timeline-badge text-center icon-activity warning"><i class="fa fa-2x fa-archive"></i></div>';
                        }elseif ($log_menu == 'RESTORE') {
                          $icon = '<li>
                            <div class="timeline-badge text-center icon-activity info"><i class="fa fa-2x fa-window-restore"></i></div>';
                        } elseif($log_menu == 'DELETE' OR $log_menu == 'CANCEL BUYING' OR $log_menu == 'CANCEL SELLING'){
                          $icon = '<li class="timeline-inverted">
                            <div class="timeline-badge text-center icon-activity danger"><i class="fa fa-2x fa-trash"></i></div>';
                        }
                        echo $icon;
                ?>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title"><?php echo $log_menu ?></h4>
                                  <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $log_date ?> |
                                    <i class="fa fa-user-circle-o"></i> 
                                    <?php echo $user_name ?></small>
                                  </p>
                                </div>
                                <div class="timeline-body">
                                    <p><?php echo $log_description ?></p>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="timeline-footer">
                                  <p>
                                    <small class="text-muted">
                                      <i class="fa fa-info-circle"></i> 
                                      <?php echo $ip_address ?> | 
                                      <i class="fa fa-globe"></i> 
                                      <?php echo $explode_log[0]; ?> | 
                                      <i class="fa fa-windows"></i> 
                                      <?php echo $log_os ?> 
                                    </small>
                                  </p>
                                </div>
                              </div>
                          </li>
                  <?php }  ?>
                          <!-- <li class="timeline-inverted">
                            <div class="timeline-badge text-center icon-activity primary"><i class="fa fa-blind"></i></div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                </div>
                                <div class="timeline-body">
                                    <a href="<?php echo $base_url."aktifitas"; ?>" class="btn btn-link">Lihat Semua Aktifitas</a>
                                </div>
                              </div>
                          </li> -->
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  .icon-activity{
    padding: 0.8%;
    margin: 3%;
  }
</style>
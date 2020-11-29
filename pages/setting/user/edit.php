
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $idEdit = $_GET['idEdit'];

  $querySelectUser =  mysqli_query($config, " SELECT * FROM tb_system_user WHERE id_user = '$idEdit' AND is_active = 'A' ");

    while ($rowSelectUser = mysqli_fetch_array($querySelectUser)){
      $id_user                = $rowSelectUser['id_user'];
      $user_name              = $rowSelectUser['user_name'];
      $user_password          = $rowSelectUser['user_password'];
      $user_full_name         = $rowSelectUser['user_full_name'];
      $user_address           = $rowSelectUser['user_address'];
      $user_email             = $rowSelectUser['user_email'];
      $user_phone             = $rowSelectUser['user_phone'];
      $user_gender            = $rowSelectUser['user_gender'];
      $user_birthday          = $rowSelectUser['user_birthday'];
      $access_level           = $rowSelectUser['access_level'];
      $ts_insert              = $rowSelectUser['ts_insert'];
      $ts_update              = $rowSelectUser['ts_update'];
  }
?> 
<div class="panel-heading">
    <b>Form Ubah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="hidden" class="form-control" name="edit_id_user" id="edit_id_user" value="<?php echo $id_user ?>">
        <input type="text" class="form-control" name="edit_nama" id="edit_nama" value="<?php echo $user_full_name ?>" placeholder="Nama Lengkap">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Tgl Lahir</label>
        <input type="text" class="form-control datepicker" name="edit_birthday" id="edit_birthday" value="<?php echo $user_birthday ?>" placeholder="Tgl Lahir">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Gender</label>
        <select name="edit_gender" id="edit_gender" class="form-control">
          <option value="">-- Pilih --</option>
          <option <?php if($user_gender=='1'){echo "selected";} ?> value="1">Pria</option>
          <option <?php if($user_gender=='2'){echo "selected";} ?>  value="2">Wanita</option>
      </select>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="edit_address" id="edit_address" value="<?php echo $user_address ?>" placeholder="Alamat Lengkap">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="edit_email" id="edit_email" value="<?php echo $user_email ?>" placeholder="Email">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Phone</label>
        <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="7" maxlength="13" name="edit_phone" id="edit_phone" value="<?php echo $user_phone ?>" placeholder="No. Telp">
    </div>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
    <!-- DATA LOGIN -->
    <h3>DATA LOGIN</h3> 
    <hr>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="edit_username" id="edit_username" value="<?php echo $user_name ?>" placeholder="Username">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
        <label>Akses</label>
        <select name="edit_akses" id="edit_akses" class="form-control">
          <option value="">-- Pilih --</option>
          <?php 
            $query = "SELECT * FROM tb_system_user_role WHERE is_active = 'A' ";
            $querySelect = mysqli_query($config, $query);
            while ( $rowSelect = mysqli_fetch_array($querySelect)) {
          ?>
            <option value="<?= $rowSelect['id']; ?>" <?php if($rowSelect['id'] == $access_level){ echo "SELECTED"; } ?>><?= $rowSelect['role_description']; ?></option>
          <?php } ?>
        </select>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
    <legend></legend>
    <div class="col-md-8"> 
      <div id="resultUpdate"></div>
    </div>
    <div class="col-md-4"> 
      <button type="submit" class="btn btn-primary" id="buttonUpdate">Submit</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange:"-59:+0"
    });
  });
  
  // TOOLTIP
  
  $(document).ready(function() {
      $("#edit_nama").focus();
  });

  $('#edit_nama').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_nama').val() == '') {
        toastr['error']("Nama Lengkap Harus Di Isi!");
        $('#edit_nama').focus();
      }else {$('#edit_birthday').focus();}
    }
  });
  $('#edit_birthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_birthday').val() == '') {
        toastr['error']("Header Harus Di Isi!");
        $('#edit_birthday').focus();
      }else {$('#edit_gender').focus();}
    }
  });
  $('#edit_gender').change(function(e) {
    if ($('#edit_gender').val() == '') {
      toastr['error']("Title Dashboard Harus Di Isi!");
      $('#edit_gender').focus();
    }else {$('#edit_address').focus();}
  });
  $('#edit_address').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#edit_email').focus();
    }
  });
  $('#edit_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#edit_email').val().indexOf("@");
      var dotpos = $('#edit_email').val().lastIndexOf(".");
      if ($('#edit_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#edit_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#edit_phone').focus();}
      }else {$('#edit_phone').focus();}
    }
  });
  $('#edit_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_phone').val() == '') {
        toastr['error']("No. Telp nya Berapa ya?");
        $('#edit_phone').focus();
      }else if ($('#edit_phone').val().length > 13) {
        toastr['error']("No Hp Maksimal 13 Digit");
        $('#edit_phone').focus();
      }else {$('#edit_username').focus();}
    }
  });
  $('#edit_username').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_username').val() == '') {
        toastr['error']("Username Harus Di isi.");
        $('#edit_username').focus();
      }else {$('#edit_akses').focus();}
    }
  });
  $('#edit_akses').change(function(e) {
    if ($('#edit_akses').val() == '') {
      toastr['error']("Hak Akses Harus Di pilih Gaes!");
      $('#edit_akses').focus();
    }else {$('#buttonUpdate').focus();}
  });

  $("#buttonUpdate").click(function(event) {
    insertData();
  });

    function insertData(){
      var edit_id_user        = $("#edit_id_user").val();
      var edit_nama           = $("#edit_nama").val();
      var edit_birthday       = $("#edit_birthday").val();
      var edit_gender         = $("#edit_gender").val();
      var edit_address        = $("#edit_address").val();
      var edit_email          = $("#edit_email").val();
      var edit_phone          = $("#edit_phone").val();
      var edit_username       = $("#edit_username").val();
      var edit_akses          = $("#edit_akses").val();
      var edit_password       = $("#edit_password").val();
      var confirm_password    = $("#confirm_password").val();
  
    if (edit_nama == '') {
      toastr['error']("Nama Lengkap Harus Di Isi!");
      $("#edit_nama").focus();
    }
    else if (edit_birthday == '') {
      toastr['error']("Tgl Lahir Harus Di Isi!");
      $("#edit_birthday").focus();
    }
    else if (edit_gender == '') {
      toastr['error']("Gender Harus Di Isi!");
      $("#edit_gender").focus();
    }
    else if (edit_phone == '') {
      toastr['error']("No. Telp nya Berapa ya?");
      $("#edit_phone").focus();
    }
    else if (edit_username == '') {
      toastr['error']("Username nya ga boleh kosong ya.");
      $("#edit_username").focus();
    }
    else if (edit_akses == '') {
      toastr['error']("Email nya masih kosong nih!");
      $("#edit_akses").focus();
    }
    else if (edit_password == '') {
      toastr['error']("Password nya masih kosong nih!");
      $("#edit_password").focus();
    }
    else if (confirm_password == '') {
      toastr['error']("Konfirmasi Password ga boleh kosong!");
      $("#confirm_password").focus();
    }
    else if (confirm_password != edit_password) {
      toastr['error']("Konfirmasi Password Tidak Sama!");
      $("#confirm_password").focus();
    }else if ($('#edit_email').val() != '') {
      var atpos  = $('#edit_email').val().indexOf("@");
      var dotpos = $('#edit_email').val().lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#edit_email').val().length){
        toastr['error']("cth: info@domain.com");
        $('#edit_email').focus();
      }
    }else if (edit_akses == '') {
      toastr['error']("Hak akses nya Pilih Dulu Ya!");
      $("#edit_akses").focus();
    }else{
      // AJAX Insert
      disableButtonEdit();
      $("#resultUpdate").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/user/update.php" ?>",
          data:"edit_id_user="+edit_id_user+"&edit_nama="+edit_nama+"&edit_birthday="+edit_birthday+"&edit_gender="+edit_gender+"&edit_address="+edit_address+"&edit_email="+edit_email+"&edit_phone="+edit_phone+"&edit_username="+edit_username+"&edit_akses="+edit_akses+"&edit_password="+edit_password+"&confirm_password="+confirm_password,
          success:function(data){
            $("#resultUpdate").html(data);
          }
      });
    }
  }
</script>


<?php
}
elseif (empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location="<?php echo $base_url."" ?>";
    </script>
<?php
}
?>

<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
?> 
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="insert_nama" id="insert_nama" placeholder="Nama Lengkap">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Tgl Lahir</label>
        <input type="text" class="form-control datepicker" name="insert_birthday" id="insert_birthday" placeholder="Tgl Lahir">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Gender</label>
        <select name="insert_gender" id="insert_gender" class="form-control">
          <option value="">-- Pilih --</option>
          <option value="1">Pria</option>
          <option value="2">Wanita</option>
      </select>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="insert_address" id="insert_address" placeholder="Alamat Lengkap">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="insert_email" id="insert_email" placeholder="Email">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Phone</label>
        <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="7" maxlength="13" name="insert_phone" id="insert_phone" placeholder="No. Telp">
    </div>
  </div>
  <div class="col-md-12">
    <h3>DATA LOGIN</h3> 
    <hr>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Username <span id="message"></span></label>
        <input type="text" class="form-control" name="insert_username" id="insert_username" placeholder="Username" onkeyup="checkUser();">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Akses</label>
        <select name="insert_akses" id="insert_akses" class="form-control">
          <option value="">-- Pilih --</option>
          <?php 
            $query = "SELECT * FROM tb_system_user_role WHERE is_active = 'A' ";
            $querySelect = mysqli_query($config, $query);
            while ( $rowSelect = mysqli_fetch_array($querySelect)) {
          ?>
            <option value="<?= $rowSelect['id']; ?>"><?= $rowSelect['role_description']; ?></option>
          <?php } ?>
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
  <div class="col-md-8"> 
    <div id="resultInsert"></div>
  </div>
  <div class="col-md-4"> 
    <button type="submit" class="btn btn-primary" id="buttonInsert">Submit</button>
    <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
  </div>
</div>

<script type="text/javascript">

  function checkUser() {
    var insert_username   = $('#insert_username').val().trim();
    var edit_id_user      = '';
    if(insert_username != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/user/checkUser.php'; ?>',
            type: 'post',
            data: {insert_username: insert_username},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }


  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange:"-59:+0"
    });
  });
  
  $(document).ready(function() {
      $("#insert_nama").focus();
  });

  $('#insert_nama').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_nama').val() == '') {
        toastr['error']("Nama Lengkap Harus Di Isi!");
        $('#insert_nama').focus();
      }else {$('#insert_birthday').focus();}
    }
  });
  $('#insert_birthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_birthday').val() == '') {
        toastr['error']("Header Harus Di Isi!");
        $('#insert_birthday').focus();
      }else {$('#insert_gender').focus();}
    }
  });
  $('#insert_gender').change(function(e) {
    if ($('#insert_gender').val() == '') {
      toastr['error']("Title Dashboard Harus Di Isi!");
      $('#insert_gender').focus();
    }else {$('#insert_address').focus();}
  });
  $('#insert_address').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#insert_email').focus();
    }
  });
  $('#insert_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#insert_email').val().indexOf("@");
      var dotpos = $('#insert_email').val().lastIndexOf(".");
      if ($('#insert_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#insert_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#insert_phone').focus();}
      }else {$('#insert_phone').focus();}
    }
  });
  $('#insert_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_phone').val() == '') {
        toastr['error']("No. Telp nya Berapa ya?");
        $('#insert_phone').focus();
      }else if ($('#insert_phone').val().length > 13) {
          toastr['error']("No Hp Maksimal 13 Digit");
          $('#insert_phone').focus();
      }else {$('#insert_username').focus();}
    }
  });
  $('#insert_username').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_username').val() == '') {
        toastr['error']("Username Harus Di isi.");
        $('#insert_username').focus();
      }else {$('#insert_akses').focus();}
    }
  });
  $('#insert_akses').change(function(e) {
    if ($('#insert_akses').val() == '') {
      toastr['error']("Hak Akses Harus Di pilih Gaes!");
      $('#insert_akses').focus();
    }else {$('#buttonInsert').focus();}
  });

  $("#buttonInsert").click(function(event) {
    insertData();
  });

  function insertData(){
      var insert_nama           = $("#insert_nama").val();
      var insert_birthday       = $("#insert_birthday").val();
      var insert_gender         = $("#insert_gender").val();
      var insert_address        = $("#insert_address").val();
      var insert_email          = $("#insert_email").val();
      var insert_phone          = $("#insert_phone").val();
      var insert_username       = $("#insert_username").val();
      var insert_akses          = $("#insert_akses").val();
  
    if (insert_nama == '') {
      toastr['error']("Nama Lengkap Harus Di Isi!");
      $("#insert_nama").focus();
    }else if (insert_birthday == '') {
      toastr['error']("Tgl Lahir Harus Di Isi!");
      $("#insert_birthday").focus();
    }else if (insert_gender == '') {
      toastr['error']("Gender Harus Di Isi!");
      $("#insert_gender").focus();
    }else if (insert_phone == '') {
      toastr['error']("No. Telp nya Berapa ya?");
      $("#insert_phone").focus();
    }else if (insert_username == '') {
      toastr['error']("Username nya ga boleh kosong ya.");
      $("#insert_username").focus();
    }else if ($('#insert_email').val() != '') {
      var atpos  = $('#insert_email').val().indexOf("@");
      var dotpos = $('#insert_email').val().lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#insert_email').val().length){
        toastr['error']("cth: info@domain.com");
        $('#insert_email').focus();
      }
    }else if (insert_akses == '') {
      toastr['error']("Hak akses nya Pilih Dulu Ya!");
      $("#insert_akses").focus();
    }else{
      // AJAX Insert
      disableButtonInsert();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/user/save.php" ?>",
          data:"&insert_nama="+insert_nama+"&insert_birthday="+insert_birthday+"&insert_gender="+insert_gender+"&insert_address="+insert_address+"&insert_email="+insert_email+"&insert_phone="+insert_phone+"&insert_username="+insert_username+"&insert_akses="+insert_akses,
          success:function(data){
            $("#resultInsert").html(data);
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
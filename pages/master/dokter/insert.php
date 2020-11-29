
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login']['user_name'])) {
?>
  
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="form-group">
      <label for="">Nama Dokter</label>
      <input type="text" class="form-control" id="i_dokter_name" name="i_dokter_name" placeholder="Nama Dokter" title="Nama Dokter">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Jenis</label>
      <select name="i_dokter_type" id="i_dokter_type" class="form-control" title="jenis">
        <option value="">Pilih Jenis</option>
        <option value="KLINIK">Klinik</option>
        <option value="PRAKTEK">Praktek Dokter</option>
        <option value="RS">Rumah Sakit</option>
        <option value="PUSKESMAS">Puskesmas</option>
      </select>
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="i_dokter_email" name="i_dokter_email" placeholder="ex: info@domain.com" title="Email">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="i_dokter_phone" name="i_dokter_phone" placeholder="0881xxxxx" title="Telp">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="i_dokter_address" name="i_dokter_address" placeholder="Alamat Lengkap" title="Alamat Lengkap">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <div id="resultInsert"></div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
      <button type="submit" class="btn btn-primary" id="buttonInsert">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

  $('#i_dokter_name').focus();

  // Save i_dokter
  function saveDokter(){
    var i_dokter_name     = $('#i_dokter_name').val();
    var i_dokter_type     = $('#i_dokter_type').val();
    var i_dokter_email    = $('#i_dokter_email').val();
    var i_dokter_phone    = $('#i_dokter_phone').val();
    var i_dokter_address  = $('#i_dokter_address').val();


    // Validation Form
    if ($('#i_dokter_name').val() == '') {
      toastr['error']("Nama Dokter Harus Diisi!");
      $('#i_dokter_name').focus();
    }else if ($('#i_dokter_type').val() == '') {
      toastr['error']("Pilih Jenis Dokter Dulu!");
      $('#i_dokter_type').focus();
    }else if ($('#i_dokter_phone').val() == '') {
      toastr['error']("No Telp Harus Di Isi!");
      $('#i_dokter_phone').focus();
    }else if ($('#i_dokter_address').val() == '') {
      toastr['error']("Alamat nya Diisi Lengkap ya!");
      $('#i_dokter_address').focus();
    }else{
      // AJAX Insert
      document.getElementById('buttonInsert').disabled = true;
      document.getElementById('buttonCancel').disabled = true;
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/dokter/save.php" ?>",
          data:"i_dokter_name="+i_dokter_name+"&i_dokter_type="+i_dokter_type+"&i_dokter_email="+i_dokter_email+"&i_dokter_email="+i_dokter_email+"&i_dokter_phone="+i_dokter_phone+"&i_dokter_address="+i_dokter_address,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#i_dokter_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_dokter_name').val() == '') {
        toastr['error']("Nama Dokter Harus Di Isi!");
        $('#i_dokter_name').focus();
      }else {$('#i_dokter_type').focus();}
    }
  });
  $('#i_dokter_type').change(function(e) {
    if ($('#i_dokter_type').val() == '') {
      toastr['error']("Pilih Jenis Dokter Dulu!");
      $('#i_dokter_type').focus();
    }else {$('#i_dokter_email').focus();}
  });
  $('#i_dokter_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#i_dokter_email').val().indexOf("@");
      var dotpos = $('#i_dokter_email').val().lastIndexOf(".");
      if ($('#i_dokter_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#i_dokter_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#i_dokter_phone').focus();}
      }else {$('#i_dokter_phone').focus();}
    }
  });
  $('#i_dokter_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_dokter_phone').val() == '') {
        toastr['error']("No Telp Harus Di Isi!");
        $('#i_dokter_phone').focus();
      }else {$('#i_dokter_address').focus();}
    }
  });
  $('#i_dokter_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_dokter_address').val() == '') {
        toastr['error']("Alamat nya Diisi Lengkap ya!");
        $('#i_dokter_address').focus();
      }else {$('#buttonInsert').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    saveDokter();
  });
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

<?php 
  include('../../../config/config.php');
?>
  
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonCloseDokter">&times;</button>
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
      <label for="">Tipe</label>
      <select name="i_dokter_type" id="i_dokter_type" class="form-control" title="jenis">
        <option value="">Tipe</option>
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
      <button type="submit" class="btn btn-primary" id="buttonInsertDokter">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancelDokter" data-dismiss="modal">Batal</button>
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
      $.notify("Nama Dokter Harus Diisi!", "error");
      $('#i_dokter_name').focus();
    }else if ($('#i_dokter_type').val() == '') {
      $.notify("Pilih Jenis Dokter Dulu!", "error");
      $('#i_dokter_type').focus();
    }else if ($('#i_dokter_phone').val() == '') {
      $.notify("No Telp Harus Di Isi!", "error");
      $('#i_dokter_phone').focus();
    }else if ($('#i_dokter_address').val() == '') {
      $.notify("Alamat nya Diisi Lengkap ya!", "error");
      $('#i_dokter_address').focus();
    }else{
      // AJAX Insert
      document.getElementById('buttonInsertDokter').disabled = true;
      document.getElementById('buttonCancelDokter').disabled = true;
      document.getElementById('buttonCloseDokter').disabled = true;
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/transaction/dokter/save.php" ?>",
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
        $.notify("Nama Dokter Harus Di Isi!", "error");
        $('#i_dokter_name').focus();
      }else {$('#i_dokter_type').focus();}
    }
  });
  $('#i_dokter_type').change(function(e) {
    if ($('#i_dokter_type').val() == '') {
      $.notify("Pilih Jenis Dokter Dulu!", "error");
      $('#i_dokter_type').focus();
    }else {$('#i_dokter_email').focus();}
  });
  $('#i_dokter_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#i_dokter_email').val().indexOf("@");
      var dotpos = $('#i_dokter_email').val().lastIndexOf(".");
      if ($('#i_dokter_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#i_dokter_email').val().length){
          $.notify("cth: info@domain.com", "error");
        }else {$('#i_dokter_phone').focus();}
      }else {$('#i_dokter_phone').focus();}
    }
  });
  $('#i_dokter_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_dokter_phone').val() == '') {
        $.notify("No Telp Harus Di Isi!", "error");
        $('#i_dokter_phone').focus();
      }else {$('#i_dokter_address').focus();}
    }
  });
  $('#i_dokter_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_dokter_address').val() == '') {
        $.notify("Alamat nya Diisi Lengkap ya!", "error");
        $('#i_dokter_address').focus();
      }else {$('#buttonInsertDokter').focus();}
    }
  });
  $('#buttonInsertDokter').click(function(e) {
    saveDokter();
  });

</script>
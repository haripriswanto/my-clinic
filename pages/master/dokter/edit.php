
<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {
  
  $idEdit = $_GET['idEdit'];
  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_master_dokter WHERE id_dokter = '$idEdit' AND bl_state = 'A'");
    while($rowData = mysqli_fetch_array($querySelectData)){
      $id_dokter              = $rowData['id_dokter'];
      $dokter_code            = $rowData['dokter_code'];
      $dokter_type            = $rowData['dokter_type'];
      $dokter_name            = $rowData['dokter_name'];
      $dokter_address         = $rowData['dokter_address'];
      $dokter_email           = $rowData['dokter_email'];
      $dokter_phone           = $rowData['dokter_phone'];
      $outlet_code_relation   = $rowData['outlet_code_relation'];
      $ts_insert              = $rowData['ts_insert'];
      $ts_update              = $rowData['ts_update'];
      $bl_state               = $rowData['bl_state'];
    }
?>

<div class="panel-heading">
    <b>Ubah Data "<?php echo $dokter_name ?>"</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="form-group">
      <label for="">Nama Dokter</label>
      <input type="hidden" name="e_id_dokter" id="e_id_dokter" value="<?php echo $id_dokter ?>">
      <input type="text" class="form-control" id="e_dokter_name" name="e_dokter_name" placeholder="Nama Dokter" title="Nama Dokter" value="<?php echo $dokter_name ?>">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Jenis</label>
      <select name="e_dokter_type" id="e_dokter_type" class="form-control" title="jenis">
        <option value="">Pilih Jenis</option>
        <option <?php if($dokter_type=='KLINIK'){echo "SELECTED";} ?> value="KLINIK">Klinik</option>
        <option <?php if($dokter_type=='PRAKTEK'){echo "SELECTED";} ?> value="PRAKTEK">Praktek Dokter</option>
        <option <?php if($dokter_type=='RS'){echo "SELECTED";} ?> value="RS">Rumah Sakit</option>
        <option <?php if($dokter_type=='PUSKESMAS'){echo "SELECTED";} ?> value="PUSKESMAS">Puskesmas</option>
      </select>
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="e_dokter_email" name="e_dokter_email" placeholder="ex: info@domain.com" title="Email" value="<?php echo $dokter_email ?>">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="e_dokter_phone" name="e_dokter_phone" placeholder="0881xxxxx" title="Telp" value="<?php echo $dokter_phone ?>">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="e_dokter_address" name="e_dokter_address" placeholder="Alamat Lengkap" title="Alamat Lengkap" value="<?php echo $dokter_address ?>">
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

  $('#e_dokter_name').focus();

  // Save e_dokter
  function updateDokter(){
    var e_id_dokter       = $('#e_id_dokter').val();
    var e_dokter_name     = $('#e_dokter_name').val();
    var e_dokter_type     = $('#e_dokter_type').val();
    var e_dokter_email    = $('#e_dokter_email').val();
    var e_dokter_phone    = $('#e_dokter_phone').val();
    var e_dokter_address  = $('#e_dokter_address').val();


    // Validation Form
    if ($('#e_dokter_name').val() == '') {
      toastr['error']("Nama Dokter Harus Diisi!");
      $('#e_dokter_name').focus();
    }else if ($('#e_dokter_type').val() == '') {
      toastr['error']("Pilih Jenis Dokter Dulu!");
      $('#e_dokter_type').focus();
    }else if ($('#e_dokter_phone').val() == '') {
      toastr['error']("No Telp Harus Di Isi!");
      $('#e_dokter_phone').focus();
    }else if ($('#e_dokter_address').val() == '') {
      toastr['error']("Alamat nya Diisi Lengkap ya!");
      $('#e_dokter_address').focus();
    }else{
      // AJAX Insert
      // document.getElementById('buttonInsert').disabled = true;
      // document.getElementById('buttonCancel').disabled = true;
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/dokter/update.php" ?>",
          data:"e_id_dokter="+e_id_dokter+"&e_dokter_name="+e_dokter_name+"&e_dokter_type="+e_dokter_type+"&e_dokter_email="+e_dokter_email+"&e_dokter_email="+e_dokter_email+"&e_dokter_phone="+e_dokter_phone+"&e_dokter_address="+e_dokter_address,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#e_dokter_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_dokter_name').val() == '') {
        toastr['error']("Nama Dokter Harus Di Isi!");
        $('#e_dokter_name').focus();
      }else {$('#e_dokter_type').focus();}
    }
  });
  $('#e_dokter_type').change(function(e) {
    if ($('#e_dokter_type').val() == '') {
      toastr['error']("Pilih Jenis Dokter Dulu!");
      $('#e_dokter_type').focus();
    }else {$('#e_dokter_email').focus();}
  });
  $('#e_dokter_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#e_dokter_email').val().indexOf("@");
      var dotpos = $('#e_dokter_email').val().lastIndexOf(".");
      if ($('#e_dokter_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#e_dokter_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#e_dokter_phone').focus();}
      }else {$('#e_dokter_phone').focus();}
    }
  });
  $('#e_dokter_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_dokter_phone').val() == '') {
        toastr['error']("No Telp Harus Di Isi!");
        $('#e_dokter_phone').focus();
      }else {$('#e_dokter_address').focus();}
    }
  });
  $('#e_dokter_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_dokter_address').val() == '') {
        toastr['error']("Alamat nya Diisi Lengkap ya!");
        $('#e_dokter_address').focus();
      }else {$('#buttonInsert').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    updateDokter();
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
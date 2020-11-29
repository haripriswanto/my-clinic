
<?php 
  include('../../../config/config.php'); 
  
  $idEdit = $_GET['idEdit'];
  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_master_supplier WHERE id_supplier = '$idEdit' AND bl_state = 'A'");
    while($rowData = mysqli_fetch_array($querySelectData)){
      $number                 = $number + 1 ;
      $id_supplier            = $rowData['id_supplier'];
      $supplier_code          = $rowData['supplier_code'];
      $supplier_type          = $rowData['supplier_type'];
      $supplier_name          = $rowData['supplier_name'];
      $supplier_webiste       = $rowData['website'];
      $supplier_address       = $rowData['supplier_address'];
      $supplier_email         = $rowData['supplier_email'];
      $supplier_phone         = $rowData['supplier_phone'];
      $website                = $rowData['website'];
      $outlet_code_relation   = $rowData['outlet_code_relation'];
      $ts_insert              = $rowData['ts_insert'];
      $ts_update              = $rowData['ts_update'];
      $bl_state               = $rowData['bl_state'];
    }
?>

<div class="panel-heading">
    <b>Form Ubah Data "<?php echo $supplier_name ?>"</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Kode supplier</label>
      <input type="hidden" name="e_id_supplier" id="e_id_supplier" value="<?php echo $id_supplier ?>">
      <input type="text" class="form-control" id="e_supplier_code" name="e_supplier_code" placeholder="Kode supplier" title="Kode supplier" value="<?php echo $supplier_code ?>">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Nama supplier</label>
      <input type="text" class="form-control" id="e_supplier_name" name="e_supplier_name" placeholder="Nama supplier" title="Nama supplier" value="<?php echo $supplier_name ?>">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Jenis</label>
      <select name="e_supplier_type" id="e_supplier_type" class="form-control" title="Jenis Supplier">
        <option value="">Pilih Jenis</option>
        <option <?php if($supplier_type == 'PT'){echo "SELECTED";} ?> value="PT">PT</option>
        <option <?php if($supplier_type == 'CV'){echo "SELECTED";} ?> value="CV">CV</option>
        <option <?php if($supplier_type == 'PERORANGAN'){echo "SELECTED";} ?> value="PERORANGAN">PERORANGAN</option>
      </select>
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Website</label>
      <input type="text" class="form-control" id="e_supplier_website" name="e_supplier_website" placeholder="Website" title="Website" value="<?php echo $supplier_webiste ?>">
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="e_supplier_email" name="e_supplier_email" placeholder="ex: info@domain.com" title="Email" value="<?php echo $supplier_email ?>">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="e_supplier_phone" name="e_supplier_phone" placeholder="0881xxxxx" title="Telp" value="<?php echo $supplier_phone ?>">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="e_supplier_address" name="e_supplier_address" placeholder="Alamat Lengkap" title="Alamat Lengkap" value="<?php echo $supplier_address ?>">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <div id="resultInsert"></div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
      <button type="submit" class="btn btn-primary" id="buttonUpdate">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>


<script type="text/javascript">

  // Save supplier
  function updateSupplier(){
    var e_id_supplier       = $('#e_id_supplier').val();
    var e_supplier_code     = $('#e_supplier_code').val();
    var e_supplier_name     = $('#e_supplier_name').val();
    var e_supplier_type     = $('#e_supplier_type').val();
    var e_supplier_website  = $('#e_supplier_website').val();
    var e_supplier_email    = $('#e_supplier_email').val();
    var e_supplier_phone    = $('#e_supplier_phone').val();
    var e_supplier_address  = $('#e_supplier_address').val();

    // Validation Form
    if ($('#e_supplier_code').val() == '') {
      $.notify("Kode supplier Tidak Boleh Kosong!", "error");
      $('#e_supplier_code').focus();
    }else if ($('#e_supplier_name').val() == '') {
      $.notify("Nama supplier Harus Diisi!", "error");
      $('#e_supplier_name').focus();
    }else if ($('#e_supplier_type').val() == '') {
      $.notify("Pilih Jenis supplier Dulu!", "error");
      $('#e_supplier_type').focus();
    }else if ($('#e_supplier_phone').val() == '') {
      $.notify("No Telp Harus Di Isi!", "error");
      $('#e_supplier_phone').focus();
    }else if ($('#e_supplier_address').val() == '') {
      $.notify("Alamat nya Diisi Lengkap ya!", "error");
      $('#e_supplier_address').focus();
    }else{
      // AJAX Insert
      document.getElementById('buttonUpdate').disabled = true;
      document.getElementById('buttonCancel').disabled = true;
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/supplier/update.php" ?>",
          data:"e_id_supplier="+e_id_supplier+"&e_supplier_code="+e_supplier_code+"&e_supplier_name="+e_supplier_name+"&e_supplier_type="+e_supplier_type+"&e_supplier_website="+e_supplier_website+"&e_supplier_email="+e_supplier_email+"&e_supplier_phone="+e_supplier_phone+"&e_supplier_address="+e_supplier_address,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#e_supplier_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_supplier_code').val() == '') {
        $.notify("Kode supplier Harus Di Isi!", "error");
        $('#e_supplier_code').focus();
      }else {$('#e_supplier_name').focus();}
    }
  });

  $('#e_supplier_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_supplier_name').val() == '') {
        $.notify("Nama supplier Harus Di Isi!", "error");
        $('#e_supplier_name').focus();
      }else {$('#e_supplier_type').focus();}
    }
  });
  $('#e_supplier_type').change(function(e) {
    if ($('#e_supplier_type').val() == '') {
      $.notify("Pilih Gender supplier Dulu!", "error");
      $('#e_supplier_type').focus();
    }else {$('#e_supplier_website').focus();}
  });
  $('#e_supplier_website').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#e_supplier_email').focus();
    }
  });
  $('#e_supplier_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#e_supplier_email').val().indexOf("@");
      var dotpos = $('#e_supplier_email').val().lastIndexOf(".");
      if ($('#e_supplier_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#e_supplier_email').val().length){
          $.notify("cth: info@domain.com", "error");
        }else {$('#e_supplier_phone').focus();}
      }else {$('#e_supplier_phone').focus();}
    }
  });
  $('#e_supplier_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_supplier_phone').val() == '') {
        $.notify("No Telp Harus Di Isi!", "error");
        $('#e_supplier_phone').focus();
      }else {$('#e_supplier_address').focus();}
    }
  });
  $('#e_supplier_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_supplier_address').val() == '') {
        $.notify("Alamat nya Diisi Lengkap ya!", "error");
        $('#e_supplier_address').focus();
      }else {$('#buttonUpdate').focus();}
    }
  });
  $('#buttonUpdate').click(function(e) {
    updateSupplier();
  });
</script>

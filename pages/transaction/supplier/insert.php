
<?php 
  include('../../../config/config.php');
?>
  
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group" id="code">
      <label for="">Kode supplier</label>
      <div class="input-group">
        <input type="text" class="form-control" name="supplier_code" id="supplier_code" placeholder="Kode supplier" title="Kode supplier">
        <span class="input-group-addon" id="basic-addon2" title="Jika Ceklis Aktif maka kode otomatis">
            <input type="checkbox" name="auto_number" id="auto_number" checked="checked" value="1" onclick="autoCode(this.checked)">
            Auto
        </span>
      </div>
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Nama supplier</label>
      <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Nama supplier" title="Nama supplier">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Jenis</label>
      <select name="supplier_type" id="supplier_type" class="form-control" title="jenis">
        <option value="">Pilih Jenis</option>
        <option value="PT">PT</option>
        <option value="CV">CV</option>
        <option value="Perorangan">Perorangan</option>
      </select>
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Website</label>
      <input type="text" class="form-control" id="supplier_website" name="supplier_website" placeholder="Website" title="Tgl Lahir">
    </div>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="supplier_email" name="supplier_email" placeholder="ex: info@domain.com" title="Email">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="supplier_phone" name="supplier_phone" placeholder="0881xxxxx" title="Telp">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Alamat Lengkap" title="Alamat Lengkap">
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


<script type="text/javascript">

  // TOOLTIP
  

  // autoCheck
  function autoCode(status){
    status = status;   
    document.getElementById('supplier_code').disabled = status;
    $('#supplier_code').focus();
  }
    document.getElementById('supplier_code').disabled = true;
    $('#supplier_name').focus();

  // datepicker
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange:"-99:+0"
      });
    }
  );
  // Save supplier
  function saveSupplier(){
    var auto_number       = $('#auto_number').val();
    var supplier_code     = $('#supplier_code').val();
    var supplier_name     = $('#supplier_name').val();
    var supplier_type     = $('#supplier_type').val();
    var supplier_website  = $('#supplier_website').val();
    var supplier_email    = $('#supplier_email').val();
    var supplier_phone    = $('#supplier_phone').val();
    var supplier_address  = $('#supplier_address').val();

    // Validation Form
    if ($('#auto_number').val() == '') {
      if ($('#supplier_code').val() == '') {
        $.notify("Kode supplier Tidak Boleh Kosong!", "error");
        $('#supplier_code').focus();
      }
    }else if ($('#supplier_name').val() == '') {
      $.notify("Nama supplier Harus Diisi!", "error");
      $('#supplier_name').focus();
    }else if ($('#supplier_type').val() == '') {
      $.notify("Pilih Jenis supplier Dulu!", "error");
      $('#supplier_type').focus();
    }else if ($('#supplier_phone').val() == '') {
      $.notify("No Telp Harus Di Isi!", "error");
      $('#supplier_phone').focus();
    }else if ($('#supplier_address').val() == '') {
      $.notify("Alamat nya Diisi Lengkap ya!", "error");
      $('#supplier_address').focus();
    }else{
      // AJAX Insert
      document.getElementById('buttonInsert').disabled = true;
      document.getElementById('buttonCancel').disabled = true;
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/supplier/save.php" ?>",
          data:"auto_number="+auto_number+"&supplier_code="+supplier_code+"&supplier_name="+supplier_name+"&supplier_type="+supplier_type+"&supplier_website="+supplier_website+"&supplier_email="+supplier_email+"&supplier_email="+supplier_email+"&supplier_phone="+supplier_phone+"&supplier_address="+supplier_address,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  // if ($('#auto_number').val() == '') {
    $('#supplier_code').keyup(function(e) {
      if(e.keyCode == 13) {
        if ($('#supplier_code').val() == '') {
          $.notify("Kode supplier Harus Di Isi!", "error");
          $('#supplier_code').focus();
        }else {$('#supplier_name').focus();}
      }
    });
  // }

  $('#supplier_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#supplier_name').val() == '') {
        $.notify("Nama supplier Harus Di Isi!", "error");
        $('#supplier_name').focus();
      }else {$('#supplier_type').focus();}
    }
  });
  $('#supplier_type').change(function(e) {
    if ($('#supplier_type').val() == '') {
      $.notify("Pilih Gender supplier Dulu!", "error");
      $('#supplier_type').focus();
    }else {$('#supplier_website').focus();}
  });
  $('#supplier_website').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#supplier_email').focus();
    }
  });
  $('#supplier_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#supplier_email').val().indexOf("@");
      var dotpos = $('#supplier_email').val().lastIndexOf(".");
      if ($('#supplier_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#supplier_email').val().length){
          $.notify("cth: info@domain.com", "error");
        }else {$('#supplier_phone').focus();}
      }else {$('#supplier_phone').focus();}
    }
  });
  $('#supplier_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#supplier_phone').val() == '') {
        $.notify("No Telp Harus Di Isi!", "error");
        $('#supplier_phone').focus();
      }else {$('#supplier_address').focus();}
    }
  });
  $('#supplier_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#supplier_address').val() == '') {
        $.notify("Alamat nya Diisi Lengkap ya!", "error");
        $('#supplier_address').focus();
      }else {$('#buttonInsert').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    saveSupplier();
  });
</script>
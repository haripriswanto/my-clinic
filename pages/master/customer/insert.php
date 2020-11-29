
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login']['user_name'])) {
?>

<div class="panel-heading">
  <h3 class="panel-title">Tambah Data</h3>
</div>
  <div class="panel-body">
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group" id="code">
      <label for="">Kode Customer</label>
      <div class="input-group">
        <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Kode Customer" title="Kode Customer">
        <span class="input-group-addon" id="basic-addon2" title="Jika Ceklis Aktif maka kode otomatis">
            <input type="checkbox" name="auto_number" id="auto_number" checked="checked" value="1" onclick="autoCode(this.checked)">
            Auto
        </span>
      </div>
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Nama Customer</label>
      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nama Customer" title="Nama Customer">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Gender</label>
      <select name="customer_gender" id="customer_gender" class="form-control" title="Gender">
        <option value="">Pilih Gender</option>
        <option value="1">Laki-Laki</option>
        <option value="2">Perempuan</option>
      </select>
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Tgl Lahir</label>
        <input type="text" class="form-control datepicker" id="customer_birthday" name="customer_birthday" placeholder="Tgl Lahir" title="Tgl Lahir">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Umur</label>
        <input type="text" class="form-control" id="insertResultAge" name="insertResultAge" placeholder="Umur" title="Umur">
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#customer_birthday").keyup(function(){
        var customer_birthday = $(this).val().trim().toString();
        if(customer_birthday != ''){            
            $.ajax({
                url: 'pages/master/customer/countAge.php',
                type: 'post',
                data: {customer_birthday: customer_birthday},
                success: function(response){
                  $('#insertResultAge').val(response);
                }
            });
        }else{
            $("#insertResultAge").val('');
        }
      });
      $("#customer_birthday").change(function(e){
        var customer_birthday = $(this).val().trim().toString();
        if(customer_birthday != ''){   
          $.ajax({
              url: 'pages/master/customer/countAge.php',
              type: 'post',
              data: {customer_birthday: customer_birthday},
              success: function(response){
                $('#insertResultAge').val(response);
              }
          });
        }else{
            $("#insertResultAge").val('');
        }
      });
    });
  </script>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="customer_email" name="customer_email" placeholder="ex: info@domain.com" title="Email">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="customer_phone" name="customer_phone" placeholder="0881xxxxx" title="Telp">
    </div>
  </div>
  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Alamat Lengkap" title="Alamat Lengkap">
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
  document.getElementById('insertResultAge').disabled = true;  
  // autoCheck
  function autoCode(status){
    status = status;   
    document.getElementById('customer_code').disabled = status;
    $('#customer_code').focus();
  }
    document.getElementById('customer_code').disabled = true;
    $('#customer_name').focus();

  // datepicker
  $( function() {
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange:"-99:+0"
      });
    }
  );
  // Save Customer
  function saveCustomer(){
    var auto_number       = $('#auto_number').val();
    var customer_code     = $('#customer_code').val();
    var customer_name     = $('#customer_name').val();
    var customer_gender   = $('#customer_gender').val();
    var customer_birthday = $('#customer_birthday').val();
    var customer_email    = $('#customer_email').val();
    var customer_phone    = $('#customer_phone').val();
    var customer_address  = $('#customer_address').val();

    // Validation Form
    if ($('#auto_number').val() == '') {
      if ($('#customer_code').val() == '') {
        toastr['error']("Kode Customer Tidak Boleh Kosong!");
        $('#customer_code').focus();
      }
    }else if ($('#customer_name').val() == '') {
      toastr['error']("Nama Customer Harus Diisi!");
      $('#customer_name').focus();
    }else if ($('#customer_gender').val() == '') {
      toastr['error']("Pilih Gender Customer Dulu!");
      $('#customer_gender').focus();
    }else if ($('#customer_birthday').val() == '') {
      toastr['error']("Tgl Lahir Harus Di Isi!");
      $('#customer_birthday').focus();
    }else if ($('#customer_phone').val() == '') {
      toastr['error']("No Telp Harus Di Isi!");
      $('#customer_phone').focus();
    }else if ($('#customer_address').val() == '') {
      toastr['error']("Alamat nya Diisi Lengkap ya!");
      $('#customer_address').focus();
    }else{
      // AJAX Insert
      disableFormInsert();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/customer/save.php" ?>",
          data:"auto_number="+auto_number+"&customer_code="+customer_code+"&customer_name="+customer_name+"&customer_gender="+customer_gender+"&customer_birthday="+customer_birthday+"&customer_email="+customer_email+"&customer_email="+customer_email+"&customer_phone="+customer_phone+"&customer_address="+customer_address,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#customer_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#customer_code').val() == '') {
        toastr['error']("Kode Customer Harus Di Isi!");
        $('#customer_code').focus();
      }else {$('#customer_name').focus();}
    }
  });
  $('#customer_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#customer_name').val() == '') {
        toastr['error']("Nama Customer Harus Di Isi!");
        $('#customer_name').focus();
      }else {$('#customer_gender').focus();}
    }
  });
  $('#customer_gender').change(function(e) {
    if ($('#customer_gender').val() == '') {
      toastr['error']("Pilih Gender Customer Dulu!");
      $('#customer_gender').focus();
    }else {$('#customer_birthday').focus();}
  });
  $('#customer_birthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#customer_birthday').val() == '') {
        toastr['error']("Tgl Lahir Harus Di Isi!");
        $('#customer_birthday').focus();
      }else {$('#customer_email').focus();}
    }
  });
  $('#customer_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#customer_email').val().indexOf("@");
      var dotpos = $('#customer_email').val().lastIndexOf(".");
      if ($('#customer_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#customer_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#customer_phone').focus();}
      }else {$('#customer_phone').focus();}
    }
  });
  $('#customer_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#customer_phone').val() == '') {
        toastr['error']("No Telp Harus Di Isi!");
        $('#customer_phone').focus();
      }else {$('#customer_address').focus();}
    }
  });
  $('#customer_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#customer_address').val() == '') {
        toastr['error']("Alamat nya Diisi Lengkap ya!");
        $('#customer_address').focus();
      }else {$('#buttonInsert').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    saveCustomer();
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
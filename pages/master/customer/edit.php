
<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {
  
  $id_customer = $_GET['idEdit'];
  // var_dump($id_customer);exit();
  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_customer WHERE id_customer = '$id_customer' AND bl_state = 'A' ");

    while ($rowData = mysqli_fetch_array($querySelectData)){
      $id_customer            = $rowData['id_customer'];
      $customer_code          = $rowData['customer_code'];
      $full_name              = $rowData['full_name'];
      $customer_category      = $rowData['customer_category'];
      $phone                  = $rowData['phone'];
      $age                    = $rowData['age'];
      $address                = $rowData['address'];
      $email                  = $rowData['email'];
      $gender                 = $rowData['gender'];
      $birthday               = $rowData['birthday'];
      $outlet_code_relation   = $rowData['outlet_code_relation'];
      $ts_insert              = $rowData['ts_insert'];
      $ts_update              = $rowData['ts_update'];
      $bl_state               = $rowData['bl_state'];
    }
?>

<div class="panel-heading">
    <b>Form Ubah Data "<?php echo $full_name ?>"</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
  <!-- <legend>Ubah Data</legend> -->
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group" id="code">
      <label for="">Kode Customer</label>
      <div class="input-group">
        <input type="hidden" id="idCustomer" name="idCustomer" value="<?php echo $id_customer ?>">
        <input type="text" class="form-control" name="editCustomerCode" id="editCustomerCode" placeholder="Kode Customer" title="Kode Customer" value="<?php echo $customer_code ?>">
        <span class="input-group-addon" id="basic-addon2" title="Jika Ceklis Aktif maka kode otomatis">
            <input type="checkbox" name="editAutoNumber" id="editAutoNumber" checked="checked" value="1" onclick="autoCode(this.checked)">
            Auto
        </span>
      </div>
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Nama Customer</label>
      <input type="text" class="form-control" id="editCustomerName" name="editCustomerName" placeholder="Nama Customer" title="Nama Customer" value="<?php echo $full_name ?>">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Gender</label>
      <select name="editCustomerGender" id="editCustomerGender" class="form-control" title="Gender">
        <option value="">Pilih Gender</option>
        <option value="1" <?php if($gender=='1'){echo "SELECTED";} ?>>Laki-Laki</option>
        <option value="2" <?php if($gender=='2'){echo "SELECTED";} ?>>Perempuan</option>
      </select>
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Tgl Lahir</label>
      <input type="text" class="form-control datepicker" id="editCustomerBirthday" name="editCustomerBirthday" placeholder="Tgl Lahir" title="Tgl Lahir" value="<?php echo $birthday ?>">
    </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="form-group">
      <label for="">Umur</label>
        <input type="text" class="form-control" id="editResultAge" name="editResultAge" placeholder="Umur" title="Umur">
    </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" class="form-control" id="editCustomerEmail" name="editCustomerEmail" placeholder="ex: info@domain.com" title="Email" value="<?php echo $email ?>">
    </div>
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="form-group">
      <label for="">Telp</label>
      <input type="text" onkeyup="numberOnly(this);" class="form-control" minlength="10" maxlength="13" id="editCustomerPhone" name="editCustomerPhone" placeholder="0881xxxxx" title="Telp" value="<?php echo $phone ?>">
    </div>
  </div>
  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="form-group">
      <label for="">Alamat</label>
      <input type="text" class="form-control" id="editCustomerAddress" name="editCustomerAddress" placeholder="Alamat Lengkap" title="Alamat Lengkap" value="<?php echo $address ?>">
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <legend></legend>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <div id="resultUpdate"></div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
      <button type="submit" class="btn btn-primary" id="buttonEdit">Simpan</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">
  // Count Age Customer
  document.getElementById('editResultAge').disabled = true;
    function countAge(){
      var customer_birthday = $("#editCustomerBirthday").val().trim();
      $.ajax({
          url: 'pages/master/customer/countAge.php',
          type: 'post',
          data: {customer_birthday: customer_birthday},
          success: function(response){
            $('#editResultAge').val(response);
          }
      });
    }

    $(document).ready(function(){
      countAge();
      $("#editCustomerBirthday").keyup(function(){
        if($("#editCustomerBirthday").val() != ''){            
            countAge();
        }else{
            $("#editResultAge").val('0');
        }
      });
    });

  // autoCheck
  function autoCode(status){
    status = status;   
    document.getElementById('editCustomerCode').disabled = status;
    $('#editCustomerCode').focus();
  }
    document.getElementById('editCustomerCode').disabled = true;
    $('#editCustomerName').focus();

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

  // Save Customer
  function updateData(){
    var idCustomer           = $('#idCustomer').val();
    var editAutoNumber       = $('#editAutoNumber').val();
    var editCustomerCode     = $('#editCustomerCode').val();
    var editCustomerName     = $('#editCustomerName').val();
    var editCustomerGender   = $('#editCustomerGender').val();
    var editCustomerBirthday = $('#editCustomerBirthday').val();
    var editCustomerEmail    = $('#editCustomerEmail').val();
    var editCustomerPhone    = $('#editCustomerPhone').val();
    var editCustomerAddress  = $('#editCustomerAddress').val();

    // Validation Form
    if ($('#editAutoNumber').val() == '') {
      if ($('#editCustomerCode').val() == '') {
        toastr['error']("Kode Customer Tidak Boleh Kosong!");
        $('#editCustomerCode').focus();
      }
    }else if ($('#editCustomerName').val() == '') {
      toastr['error']("Nama Customer Harus Diisi!");
      $('#editCustomerName').focus();
    }else if ($('#editCustomerGender').val() == '') {
      toastr['error']("Pilih Gender Customer Dulu!");
      $('#editCustomerGender').focus();
    }else if ($('#editCustomerBirthday').val() == '') {
      toastr['error']("Tgl Lahir Harus Di Isi!");
      $('#editCustomerBirthday').focus();
    }else if ($('#editCustomerPhone').val() == '') {
      toastr['error']("No Telp Harus Di Isi!");
      $('#editCustomerPhone').focus();
    }else if ($('#editCustomerAddress').val() == '') {
      toastr['error']("Alamat nya Diisi Lengkap ya!");
      $('#editCustomerAddress').focus();
    }else if ($('#editCustomerEmail').val() != '' || $('#editCustomerEmail').val() == '') {
      var atpos  = $('#editCustomerEmail').val().indexOf("@");
      var dotpos = $('#editCustomerEmail').val().lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#editCustomerEmail').val().length){
        toastr['error']("cth: info@domain.com");
        $('#editCustomerEmail').focus();
      }else{
        // AJAX Insert
        document.getElementById('buttonEdit').disabled = true;
        document.getElementById('buttonCancel').disabled = true;
        $("#resultUpdate").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
        $.ajax({
            type:"get",
            url:"<?php echo $base_url."pages/master/customer/update.php" ?>",
            data:"idCustomer="+idCustomer+"&editAutoNumber="+editAutoNumber+"&editCustomerCode="+editCustomerCode+"&editCustomerName="+editCustomerName+"&editCustomerGender="+editCustomerGender+"&editCustomerBirthday="+editCustomerBirthday+"&editCustomerEmail="+editCustomerEmail+"&editCustomerPhone="+editCustomerPhone+"&editCustomerAddress="+editCustomerAddress,
            success:function(data){
              $("#resultUpdate").html(data);
            }
        });  
      }
    }
  }

  // if ($('#editAutoNumber').val() == '') {
    $('#editCustomerCode').keyup(function(e) {
      if(e.keyCode == 13) {
        if ($('#editCustomerCode').val() == '') {
          toastr['error']("Kode Customer Harus Di Isi!");
          $('#editCustomerCode').focus();
        }else {$('#editCustomerName').focus();}
      }
    });
  // }

  $('#editCustomerName').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editCustomerName').val() == '') {
        toastr['error']("Nama Customer Harus Di Isi!");
        $('#editCustomerName').focus();
      }else {$('#editCustomerGender').focus();}
    }
  });
  $('#editCustomerGender').change(function(e) {
    if ($('#editCustomerGender').val() == '') {
      toastr['error']("Pilih Gender Customer Dulu!");
      $('#editCustomerGender').focus();
    }else {$('#editCustomerBirthday').focus();}
  });
  $('#editCustomerBirthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editCustomerBirthday').val() == '') {
        toastr['error']("Tgl Lahir Harus Di Isi!");
        $('#editCustomerBirthday').focus();
      }else {$('#editCustomerEmail').focus();}
    }
  });
  $('#editCustomerEmail').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#editCustomerEmail').val().indexOf("@");
      var dotpos = $('#editCustomerEmail').val().lastIndexOf(".");
      if ($('#editCustomerEmail').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#editCustomerEmail').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#editCustomerPhone').focus();}
      }else {$('#editCustomerPhone').focus();}
    }
  });
  $('#editCustomerPhone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editCustomerPhone').val() == '') {
        toastr['error']("No Telp Harus Di Isi!");
        $('#editCustomerPhone').focus();
      }else {$('#editCustomerAddress').focus();}
    }
  });
  $('#editCustomerAddress').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editCustomerAddress').val() == '') {
        toastr['error']("Alamat nya Diisi Lengkap ya!");
        $('#editCustomerAddress').focus();
      }else {$('#buttonEdit').focus();}
    }
  });
  $('#buttonEdit').click(function(e) {
    updateData();
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
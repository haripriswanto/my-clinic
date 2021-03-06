
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
  
  $id = $_POST['idEdit'];
  $query =  mysqli_query($config, " SELECT * FROM tb_system_setting WHERE id_system = '$id' ");
    while ($row = mysqli_fetch_array($query)){
      $id_system              = $row['id_system'];
      $system_title           = $row['system_title'];
      $system_header          = $row['system_header'];
      $system_dashboard_text  = $row['system_dashboard_text'];
      $system_instansi_name   = $row['system_instansi_name'];
      $system_owner           = $row['system_owner'];
      $system_phone           = $row['system_phone'];
      $system_address         = $row['system_address'];
      $system_email           = $row['system_email'];
      $system_url             = $row['system_url'];
      $system_outlet_code     = $row['system_outlet_code'];
      $system_footer_struct   = $row['system_footer_struct'];
    }

  ?>
<div class="panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ubah Sistem Setting
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </h3>
  </div>
  <div class="panel-body">
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Title Setting</label>
            <input type="hidden" name="id_system" id="id_system" class="form-control tooltips" value="<?php echo $id_system ?>">
            <input type="text" autofocus="" class="form-control tooltips" name="insert_title" id="insert_title" value="<?php echo $system_title ?>" required="" title="Title Akan Muncul Di Title Browser">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Header Setting</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_header ?>" name="insert_header" id="insert_header" required="" title="Header Akan Muncul Di Header Sistem">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Title Dashboard</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_dashboard_text ?>" name="insert_dashboard" id="insert_dashboard" required="" title="Title Dashboard Akan Muncul Di Halaman Awal Sistem">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Nama Toko</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_instansi_name ?>" name="insert_instansi_name" id="insert_instansi_name" required="" title="Nama Toko Akan Muncul Di Struk Pembelian">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Owner</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_owner ?>" name="insert_owner" id="insert_owner" required="">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Telp</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_phone ?>" name="insert_phone" id="insert_phone" required="" title="Telp Akan Muncul Di Struk Pembelian / ketik tanda '-' untuk menghapus.">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_address ?>" name="insert_address" id="insert_address" required="" title="Alamat Akan Muncul Di Struk Pembelian / ketik tanda '-' untuk menghapus.">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_email ?>" name="insert_email" id="insert_email" required="" title="Email Akan Muncul Di Struk Pembelian / ketik tanda '-' untuk menghapus.">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>URL Website</label>
            <input type="text" class="form-control tooltips" value="<?php echo $system_url ?>" name="insert_url" id="insert_url" required="" title="URL Website Akan Muncul Di Struk Pembelian / ketik tanda '-' untuk menghapus.">
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
            <label>Kode Outlet <span class="label label-danger"></span></label>
            <input type="text" class="form-control tooltips" name="insert_outlet_code" id="insert_outlet_code" value="<?php echo $system_outlet_code ?>" title="Kode Outlet akan mempengaruhi semua produk dan transaksi.">
        </div>
      </div>
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Footer Struk</label>
            <textarea name="insert_footer_struct" id="insert_footer_struct" class="form-control tooltips" rows="3" title="Akan Tampil Pada Struk"><?php echo $system_footer_struct ?></textarea>
        </div>
      </div>
      <div class="col-md-12"> 
        <div class="modal-footer">
          <div class="col-md-8">
            <div id="resultUpdate"></div> 
          </div>
        <div class="col-md-4"> 
              <button type="submit" id="buttonUpdate" class="btn btn-primary">Submit</button>
              <button type="button" id="buttonCancelUpdate" class="btn btn-default" data-dismiss="modal">Batal</button>
           </div>
        </div>
    </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  tooltips();
  
  $(document).ready(function() {
    document.getElementById('insert_outlet_code').disabled = true;
    $("#insert_title").focus();
  });

  $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    yearRange:"-59:+0"
      });
    } 
  );

  $('#insert_title').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_title').val() == '') {
        toastr['error']("Title Harus Di Isi!", "ERROR!");
        // swal("Required", "Title Harus Di Isi!", "ERROR!", {buttons: false, timer:1000,});
        $('#insert_title').focus();
      }else {$('#insert_header').focus();}
    }
  });
  $('#insert_header').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_header').val() == '') {
        toastr['error']("Header Harus Di Isi!", "ERROR!");
        $('#insert_header').focus();
      }else {$('#insert_dashboard').focus();}
    }
  });
  $('#insert_dashboard').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_dashboard').val() == '') {
        toastr['error']("Title Dashboard Harus Di Isi!", "ERROR!");
        $('#insert_dashboard').focus();
      }else {$('#insert_instansi_name').focus();}
    }
  });
  $('#insert_instansi_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_instansi_name').val() == '') {
        toastr['error']("Nama Outlet Harus Di Isi!", "ERROR!");
        $('#insert_instansi_name').focus();
      }else {$('#insert_owner').focus();}
    }
  });
  $('#insert_owner').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_owner').val() == '') {
        toastr['error']("Owner Belum Diisi Nih!", "ERROR!");
        $('#insert_owner').focus();
      }else {$('#insert_phone').focus();}
    }
  });
  $('#insert_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_phone').val() == '') {
        toastr['error']("No. Telp nya Berapa ya?", "ERROR!");
        $('#insert_phone').focus();
      }else {$('#insert_address').focus();}
    }
  });
  $('#insert_address').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_address').val() == '') {
        toastr['error']("Alamat Toko nya Dimana ya?", "ERROR!");
        $('#insert_address').focus();
      }else {$('#insert_email').focus();}
    }
  });
  $('#insert_email').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_email').val() == '') {
        toastr['error']("Email nya masih kosong nih!", "ERROR!");
        $('#insert_email').focus();
      }else {$('#insert_url').focus();}
    }
  });
  $('#insert_url').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_url').val() == '') {
        toastr['error']("Jika Url Belum Ada Bisa Diisi dengan tanda -", "ERROR!");
        $('#insert_url').focus();
      }else {$('#insert_footer_struct').focus();}
    }
  });
  $('#insert_outlet_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_outlet_code').val() == '') {
        toastr['error']("Kode Outlet Ga Boleh Kosong Ya!", "ERROR!");
        $('#insert_outlet_code').focus();
      }else if ($('#insert_outlet_code').val().length < 8) {
        toastr['error']("Kode Outlet Minimal 8 Karakter!", "ERROR!");
        $('#insert_outlet_code').focus();
      }else {$('#insert_footer_struct').focus();}
    }
  });
  $('#insert_footer_struct').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#insert_footer_struct').val() == '') {
        toastr['error']("Footer Struk nya Masih Kosong Nih!", "ERROR!");
        $('#insert_footer_struct').focus();
      }else {$('#buttonUpdate').focus();}
    }
  });
  $("#buttonUpdate").click(function(event) {
    upadteData();
  });

    function upadteData(){
      var id_system             = $("#id_system").val();
      var insert_title          = $("#insert_title").val();
      var insert_header         = $("#insert_header").val();
      var insert_dashboard      = $("#insert_dashboard").val();
      var insert_instansi_name  = $("#insert_instansi_name").val();
      var insert_owner          = $("#insert_owner").val();
      var insert_phone          = $("#insert_phone").val();
      var insert_address        = $("#insert_address").val();
      var insert_email          = $("#insert_email").val();
      var insert_url            = $("#insert_url").val();
      var insert_outlet_code    = $("#insert_outlet_code").val();
      var insert_footer_struct  = $("#insert_footer_struct").val();
  
    if (insert_title == '') {
      toastr['error']("Title Harus Di Isi!", "ERROR!");
      $("#insert_title").focus();
    }
    else if (insert_header == '') {
      toastr['error']("Header Harus Di Isi!", "ERROR!");
      $("#insert_header").focus();
    }
    else if (insert_dashboard == '') {
      toastr['error']("Title Dashboard Harus Di Isi!", "ERROR!");
      $("#insert_dashboard").focus();
    }
    else if (insert_instansi_name == '') {
      toastr['error']("Nama Outlet Harus Di Isi!", "ERROR!");
      $("#insert_instansi_name").focus();
    }
    else if (insert_owner == '') {
      toastr['error']("Nama Owner nya Siapa Nih!", "ERROR!");
      $("#insert_owner").focus();
    }
    else if (insert_phone == '') {
      toastr['error']("No. Telp nya Berapa ya?", "ERROR!");
      $("#insert_phone").focus();
    }
    else if (insert_address == '') {
      toastr['error']("Alamat Toko nya Dimana ya?", "ERROR!");
      $("#insert_address").focus();
    }
    else if (insert_email == '') {
      toastr['error']("Email nya masih kosong nih!", "ERROR!");
      $("#insert_email").focus();
    }
    else if (insert_url == '') {
      toastr['error']("Jika Url Belum Ada Bisa Diisi dengan tanda -", "ERROR!");
      $("#insert_url").focus();
    }
    else if (insert_outlet_code == '') {
      toastr['error']("Email nya masih kosong nih!", "ERROR!");
      $("#insert_outlet_code").focus();
    }
    else if (insert_outlet_code.length < 8) {
      toastr['error']("Kode Outlet Minimal 8 Karakter!", "ERROR!");
      $("#insert_outlet_code").focus();
    }
    else if (insert_footer_struct == '') {
      toastr['error']("Footer Struk nya Masih Kosong Nih!", "ERROR!");
      $("#insert_footer_struct").focus();
    }else{
      // AJAX Insert
      disableButton();
      $("#resultUpdate").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/system/save.php" ?>",
          data:"id_system="+id_system+"&insert_title="+insert_title+"&insert_header="+insert_header+"&insert_dashboard="+insert_dashboard+"&insert_instansi_name="+insert_instansi_name+"&insert_owner="+insert_owner+"&insert_phone="+insert_phone+"&insert_address="+insert_address+"&insert_url="+insert_url+"&insert_email="+insert_email+"&insert_outlet_code="+insert_outlet_code+"&insert_footer_struct="+insert_footer_struct,
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
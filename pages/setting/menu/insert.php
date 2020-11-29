
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
?> 
<div class="row">
  <div class="col-md-8">
    <div class="form-group">
        <label>Deskripsi Menu</label>
        <input type="text" class="form-control" name="i_menuDescription" id="i_menuDescription" placeholder="Deskripsi Menu">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        <label>Kode</label>
        <input type="text" class="form-control" name="i_menuCode" id="i_menuCode" placeholder="Kode Menu">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Url</label>
        <input type="text" class="form-control" name="i_menuUrl" id="i_menuUrl" placeholder="Url Menu">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Icon</label>
        <input type="text" class="form-control" name="i_menuIcon" id="i_menuIcon" placeholder="Icon Menu">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Urutan</label>
        <input type="text" class="form-control" name="i_menuSort" id="i_menuSort" placeholder="Urutan Menu">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Tipe Menu</label>
        <select name="i_menuType" id="i_menuType" class="form-control">
          <option value="">-- Pilih --</option>
          <option value="side-bar">SideBar</option>
          <option value="top-bar">TopBar</option>
      </select>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Aktif</label>
        <input type="checkbox" checked="" name="i_menuIsActive" id="i_menuIsActive" placeholder="Urutan Menu" value="A">
    </div>
  </div>
<div class="row">
  <div class="col-md-12"> 
    <legend></legend>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="form-group"> 
      <div id="resultInsert"></div>
    </div>
  </div>
  <div class="col-md-4"> 
    <div class="form-group">
      <button type="submit" class="btn btn-primary" id="buttonInsert">Submit</button>
      <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Batal</button>
    </div>
  </div>
</div>

<script type="text/javascript">

  function checkUser() {
    var i_menu   = $('#i_menu').val().trim();
    var edit_id_user      = '';
    if(i_menu != ''){
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
            url: '<?php echo $base_url.'pages/setting/user/checkUser.php'; ?>',
            type: 'post',
            data: {i_menu: i_menu},
            success: function(response){
                $('#message').html(response);
             }
        });
    }else{
        $("#message").html("");
    }
  }
  
  $(document).ready(function() {
      $("#i_menuDescription").focus();
  });

  $('#i_menuDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_menuDescription').val() == '') {
        toastr["error"]("Deskripsi Menu Harus Di Isi!");
        $('#i_menuDescription').focus();
      }else {$('#i_menuCode').focus();}
    }
  });
  $('#i_menuCode').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_menuCode').val() == '') {
        toastr["error"]("Kode Menu Harus Di Isi!");
        $('#i_menuCode').focus();
      }else {$('#i_menuUrl').focus();}
    }
  });

  $('#i_menuUrl').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#i_menuIcon').focus();
    }
  });

  $('#i_menuIcon').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_menuIcon').val() == '') {
        toastr["error"]("Icon Harus Di isi.");
        $('#i_menuIcon').focus();
      }else {$('#i_menuSort').focus();}
    }
  });

  $('#i_menuSort').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_menuSort').val() == '') {
        toastr["error"]("Urutan Harus Di isi.");
        $('#i_menuSort').focus();
      }else {$('#i_menuType').focus();}
    }
  });

  $('#i_menuType').change(function(e) {
    if ($('#i_menuType').val() == '') {
      toastr["error"]("Tipe Harus Di pilih!");
      $('#i_menuType').focus();
    }else {$('#i_menuIsActive').focus();}
  });

  $('#i_menuIsActive').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#buttonInsert').focus();
    }
  });

  $("#buttonInsert").click(function(event) {
    insertData();
  });

  function insertData(){

      var i_menuDescription = $("#i_menuDescription").val();
      var i_menuCode        = $("#i_menuCode").val();
      var i_menuUrl         = $("#i_menuUrl").val();
      var i_menuIcon        = $("#i_menuIcon").val();
      var i_menuSort        = $("#i_menuSort").val();
      var i_menuType        = $("#i_menuType").val();
      var i_menuIsActive    = $("#i_menuIsActive").val();
      
      var i_menuIsActive = [];
        $('#i_menuIsActive').each(function(){
          if($(this).is(":checked")){
           i_menuIsActive.push($(this).val());
          }
        });
      i_menuIsActive = i_menuIsActive.toString();
  
    if (i_menuDescription == '') {
      toastr["error"]("Deskripsi Harus Di Isi!");
      $("#i_menuDescription").focus();
    }else if (i_menuCode == '') {
      toastr["error"]("Kode Harus Di Isi!");
      $("#i_menuCode").focus();
    }else if (i_menuIcon == '') {
      toastr["error"]("Icon Harus Diisi!");
      $("#i_menuIcon").focus();
    }else if (i_menuSort == '') {
      toastr["error"]("Urutan Menu");
      $("#i_menuSort").focus();
    }else if (i_menuType == '') {
      toastr["error"]("Tipe Menu Harus Dipilih!");
      $("#i_menuType").focus();
    }else{
      // AJAX Insert
      disableButtonInsert();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type: "get",
          url: "<?php echo $base_url."pages/setting/menu/save.php" ?>",
          data: "i_menuDescription="+i_menuDescription+"&i_menuCode="+i_menuCode+"&i_menuUrl="+i_menuUrl+"&i_menuIcon="+i_menuIcon+"&i_menuSort="+i_menuSort+"&i_menuType="+i_menuType+"&i_menuIsActive="+i_menuIsActive,
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
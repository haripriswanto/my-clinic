
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {
?> 
<div class="row">

  <div class="col-md-4">
    <div class="form-group">
        <label>Tipe Menu</label>
        <select name="i_menuType" id="i_menuType" class="form-control">
          <option value="">-- Pilih --</option>
          <option value="side-bar">SideBar</option>
          <option value="top-bar">TopBar</option>
      </select>
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
        <label>Menu Utama <i id="searchResult"></i> </label>
        <select name="i_mainMenu" id="i_mainMenu" class="form-control">
          <option value="">-- Pilih Tipe Menu --</option>
      </select>
    </div>
  </div>

  <div class="col-md-8">
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" class="form-control" name="i_submenuDescription" id="i_submenuDescription" placeholder="Deskripsi Sub Menu">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
        <label>Kode</label>
        <input type="text" class="form-control" name="i_submenuCode" id="i_submenuCode" placeholder="Kode Sub Menu">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label>Url</label>
        <input type="text" class="form-control" name="i_submenuUrl" id="i_submenuUrl" placeholder="Url Sub Menu">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Icon</label>
        <input type="text" class="form-control" name="i_submenuIcon" id="i_submenuIcon" placeholder="Icon Sub Menu">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Urutan</label>
        <input type="text" class="form-control" name="i_submenuSort" id="i_submenuSort" placeholder="Urutan Sub Menu">
    </div>
  </div>
  <div class="col-md-9">
    <div class="form-group">
        <label>Direktori Modul</label>
        <input type="text" class="form-control" name="i_moduleDirectory" id="i_moduleDirectory" placeholder="Direktori Modul">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        <label>Aktif</label>
        <input type="checkbox" checked="" name="i_submenuIsActive" id="i_submenuIsActive" placeholder="Urutan Sub Menu" value="A">
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

    $("#i_menuType").change(function(){
        var i_menuType = $("#i_menuType").val();
        $('#searchResult').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $('#searchResult').show();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo $base_url.'pages/setting/sub-menu/mainMenu.php'; ?>',
            data: "i_menuType="+i_menuType,
            success: function(msg){
              $("#i_mainMenu").html(msg);
              $('#searchResult').hide();
            }
        });     
    });
  
  $(document).ready(function() {
      $("#i_menuType").focus();
  });

  $('#i_menuType').change(function(e) {
    if ($('#i_menuType').val() == '') {
      toastr["error"]("Tipe Menu Belum Di pilih!");
      $('#i_menuType').focus();
    }else {$('#i_mainMenu').focus();}
  });
  
  $('#i_mainMenu').change(function(e) {
    if ($('#i_mainMenu').val() == '') {
      toastr["error"]("Menu utama belum di pilih!");
      $('#i_mainMenu').focus();
    }else {$('#i_submenuDescription').focus();}
  });

  $('#i_submenuDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_submenuDescription').val() == '') {
        toastr["error"]("Deskripsi Sub Menu Harus Di Isi!");
        $('#i_submenuDescription').focus();
      }else {$('#i_submenuCode').focus();}
    }
  });
  $('#i_submenuCode').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_submenuCode').val() == '') {
        toastr["error"]("Kode Sub Menu Harus Di Isi!");
        $('#i_submenuCode').focus();
      }else {$('#i_submenuUrl').focus();}
    }
  });

  $('#i_submenuUrl').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_submenuUrl').val() == '') {
        toastr["error"]("URL Harus Di Isi!");
        $('#i_submenuUrl').focus();
      }else {$('#i_submenuIcon').focus();}
    }
  });

  $('#i_submenuIcon').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_submenuIcon').val() == '') {
        toastr["error"]("Icon Harus Di isi.");
        $('#i_submenuIcon').focus();
      }else {$('#i_submenuSort').focus();}
    }
  });

  $('#i_submenuSort').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_submenuSort').val() == '') {
        toastr["error"]("Urutan Harus Di isi.");
        $('#i_submenuSort').focus();
      }else {$('#i_moduleDirectory').focus();}
    }
  });

  $('#i_moduleDirectory').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_moduleDirectory').val() == '') {
        toastr["error"]("Direktori Menu Harus Di isi.");
        $('#i_moduleDirectory').focus();
      }else {$('#i_submenuIsActive').focus();}
    }
  });

  $('#i_submenuIsActive').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#buttonInsert').focus();
    }
  });

  $("#buttonInsert").click(function(event) {
    insertData();
  });

  function insertData(){
    var i_menuType           = $("#i_menuType").val();
    var i_mainMenu           = $("#i_mainMenu").val();
    var i_submenuDescription = $("#i_submenuDescription").val();
    var i_submenuCode        = $("#i_submenuCode").val();
    var i_submenuUrl         = $("#i_submenuUrl").val();
    var i_submenuIcon        = $("#i_submenuIcon").val();
    var i_submenuSort        = $("#i_submenuSort").val();
    var i_submenuType        = $("#i_submenuType").val();
    var i_moduleDirectory    = $("#i_moduleDirectory").val();
    var i_submenuIsActive    = $("#i_submenuIsActive").val();
    
    var i_submenuIsActive = [];
    $('#i_submenuIsActive').each(function(){
      if($(this).is(":checked")){
       i_submenuIsActive.push($(this).val());
      }
    });
    i_submenuIsActive = i_submenuIsActive.toString();
  
    if (i_menuType == '') {
      toastr["error"]("Tipe Menu Belum Dipilih!");
      $("#i_menuType").focus();
    }else if (i_mainMenu == '') {
      toastr["error"]("Menu Utama Belum Dipilih!");
      $("#i_mainMenu").focus();
    }else if (i_submenuDescription == '') {
      toastr["error"]("Deskripsi Harus Di Isi!");
      $("#i_submenuDescription").focus();
    }else if (i_submenuCode == '') {
      toastr["error"]("Kode Harus Di Isi!");
      $("#i_submenuCode").focus();
    }else if (i_submenuIcon == '') {
      toastr["error"]("Icon Harus Diisi!");
      $("#i_submenuIcon").focus();
    }else if (i_submenuSort == '') {
      toastr["error"]("Urutan Sub Menu");
      $("#i_submenuSort").focus();
    }else if (i_submenuType == '') {
      toastr["error"]("Tipe Sub Menu Harus Dipilih!");
      $("#i_submenuType").focus();
    }else if (i_moduleDirectory == '') {
      toastr["error"]("Direktori Menu Harus Dipilih!");
      $("#i_moduleDirectory").focus();
    }else{
      // AJAX Insert
      disableButtonInsert();
      $("#resultInsert").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type: "post",
          url: "<?php echo $base_url."pages/setting/sub-menu/save.php" ?>",
          data: {
            i_mainMenu: i_mainMenu,
            i_submenuDescription: i_submenuDescription,
            i_submenuCode: i_submenuCode,
            i_submenuUrl: i_submenuUrl,
            i_submenuIcon: i_submenuIcon,
            i_submenuSort: i_submenuSort,
            i_submenuType: i_submenuType,
            i_submenuIsActive: i_submenuIsActive,
            i_moduleDirectory: i_moduleDirectory
          },
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
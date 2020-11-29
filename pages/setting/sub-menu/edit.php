
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

  $idEdit = $_GET['idEdit'];
  $querySelectData =  mysqli_query($config, "
    SELECT tb_system_sub_menu.*, tb_system_menu.menu_description as menu
    FROM tb_system_sub_menu
    INNER JOIN tb_system_menu
    ON tb_system_sub_menu.menu_id = tb_system_menu.id 
    WHERE tb_system_sub_menu.id = '$idEdit' ");

    $rowSelectData = mysqli_fetch_array($querySelectData);
      $id                   = $rowSelectData['id'];
      $menu_id              = $rowSelectData['menu_id'];
      $menu_description     = $rowSelectData['menu'];
      $sub_menu_code        = $rowSelectData['sub_menu_code'];
      $sub_menu_description = $rowSelectData['sub_menu_description'];
      $sub_menu_url         = $rowSelectData['sub_menu_url'];
      $sub_menu_icon        = $rowSelectData['sub_menu_icon'];
      $sub_menu_sort        = $rowSelectData['sub_menu_sort'];
      $is_active            = $rowSelectData['is_active'];
?>
  <div class="panel-heading">
      <b>Ubah Data <?= $sub_menu_description; ?></b>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="panel-body">
    <div class="col-md-8">
      <div class="form-group">
          <label>Deskripsi Menu</label>
          <input type="hidden" name="e_menuId" id="e_menuId" value="<?= $id ?>">
          <input type="text" class="form-control" name="e_menuDescription" id="e_menuDescription" placeholder="Deskripsi Menu" value="<?= $sub_menu_description ?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
          <label>Kode</label>
          <input type="text" class="form-control" name="e_menuCode" id="e_menuCode" placeholder="Kode Menu" value="<?= $sub_menu_code ?>">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
          <label>Url</label>
          <input type="text" class="form-control" name="e_menuUrl" id="e_menuUrl" placeholder="Url Menu" value="<?= $sub_menu_url ?>">
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
          <label>Icon</label>
          <input type="text" class="form-control" name="e_menuIcon" id="e_menuIcon" placeholder="Icon Menu" value="<?= $sub_menu_icon ?>">
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
          <label>Urutan</label>
          <input type="text" class="form-control" name="e_menuSort" id="e_menuSort" placeholder="Urutan Menu" value="<?= $sub_menu_sort ?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Menu Utama </label>
          <select name="e_mainMenu" id="e_mainMenu" class="form-control">
            <option value="">-- Pilih --</option>
            <?php  
              $queryMenuOpt =  mysqli_query($config, " 
                SELECT * FROM tb_system_menu WHERE is_active = 'A' ORDER BY sort_menu ASC"); 
                while ($rowMenuOpt = mysqli_fetch_array($queryMenuOpt)) {
            ?>
                <option value="<?= $rowMenuOpt["id"] ?>" <?php if($rowMenuOpt["id"] == $menu_id){echo 'SELECTED';} ?>><?= $rowMenuOpt['menu_description']; ?></option>";
            <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
          <label>Aktif</label>
          <input type="checkbox" checked="" name="e_menuIsActive" id="e_menuIsActive" placeholder="Urutan Menu" value="A" <?php if($is_active == 'A'){echo "checked";} ?>>
      </div>
    </div>
    <div class="col-md-12"> 
      <legend></legend>
    </div>
    <div class="col-md-8">
      <div class="form-group"> 
        <div id="resultUpdate"></div>
      </div>
    </div>
    <div class="col-md-4"> 
      <div class="form-group">
        <button type="submit" class="btn btn-primary" id="buttonUpdate">Submit</button>
        <button type="button" class="btn btn-default" id="buttonCancelUpdate" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>


<script type="text/javascript">
  
  $(document).ready(function() {
      $("#e_menuDescription").focus();
  });

  $('#e_menuDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_menuDescription').val() == '') {
        toastr["error"]("Deskripsi Menu Harus Di Isi!");
        $('#e_menuDescription').focus();
      }else {$('#e_menuCode').focus();}
    }
  });
  $('#e_menuCode').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_menuCode').val() == '') {
        toastr["error"]("Kode Menu Harus Di Isi!");
        $('#e_menuCode').focus();
      }else {$('#e_menuUrl').focus();}
    }
  });

  $('#e_menuUrl').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#e_menuIcon').focus();
    }
  });

  $('#e_menuIcon').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_menuIcon').val() == '') {
        toastr["error"]("Icon Harus Di isi.");
        $('#e_menuIcon').focus();
      }else {$('#e_menuSort').focus();}
    }
  });

  $('#e_menuSort').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#e_menuSort').val() == '') {
        toastr["error"]("Urutan Harus Di isi.");
        $('#e_menuSort').focus();
      }else {$('#e_mainMenu').focus();}
    }
  });

  $('#e_mainMenu').change(function(e) {
    if ($('#e_mainMenu').val() == '') {
      toastr["error"]("Menu Utama Belum Dipilih.");
      $('#').focus();
    }else {$('#e_menuIsActive').focus();}
  });

  $('#e_menuIsActive').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#buttonUpdate').focus();
    }
  });

  $("#buttonUpdate").click(function(event) {
    insertData();
  });

  function insertData(){

      var e_menuId = $("#e_menuId").val();
      var e_menuDescription = $("#e_menuDescription").val();
      var e_menuCode        = $("#e_menuCode").val();
      var e_menuUrl         = $("#e_menuUrl").val();
      var e_menuIcon        = $("#e_menuIcon").val();
      var e_menuSort        = $("#e_menuSort").val();
      var e_mainMenu        = $("#e_mainMenu").val();
      var e_menuIsActive    = $("#e_menuIsActive").val();
      
      var e_menuIsActive = [];
        $('#e_menuIsActive').each(function(){
          if($(this).is(":checked")){
           e_menuIsActive.push($(this).val());
          }
        });
      e_menuIsActive = e_menuIsActive.toString();
  
    if (e_menuDescription == '') {
      toastr["error"]("Deskripsi Harus Di Isi!");
      $("#e_menuDescription").focus();
    }else if (e_menuCode == '') {
      toastr["error"]("Kode Harus Di Isi!");
      $("#e_menuCode").focus();
    }else if (e_menuIcon == '') {
      toastr["error"]("Icon Harus Diisi!");
      $("#e_menuIcon").focus();
    }else if (e_menuSort == '') {
      toastr["error"]("Urutan Menu Masih Kosong");
      $("#e_menuSort").focus();
    }else if (e_mainMenu == '') {
      toastr["error"]("Menu Utama Belum Dipilih.");
      $("#e_mainMenu").focus();
    }else{
      // AJAX Insert
      disableButtonEdit();
      $("#resultUpdate").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/sub-menu/update.php" ?>",
          data:{
            e_menuId:e_menuId,
            e_menuDescription:e_menuDescription,
            e_menuCode:e_menuCode,
            e_menuUrl:e_menuUrl,
            e_menuIcon:e_menuIcon,
            e_menuSort:e_menuSort,
            e_mainMenu:e_mainMenu,
            e_menuIsActive:e_menuIsActive
          },
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
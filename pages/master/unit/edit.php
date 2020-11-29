
<?php 
  include('../../../config/config.php'); 
  
if (!empty($_SESSION['login']['user_name'])) {

  $idEdit = $_GET['idEdit'];
  
  $selectDataUnit = " SELECT * FROM tb_master_unit WHERE id_unit ='$idEdit' AND bl_state = 'A'";
  $querySelectDataUnit =  mysqli_query($config, $selectDataUnit);

    while ($rowSelectDataUnit = mysqli_fetch_array($querySelectDataUnit)){
      $id_unit            = $rowSelectDataUnit['id_unit'];
      $unit_code          = $rowSelectDataUnit['unit_code'];
      $unit_description   = $rowSelectDataUnit['unit_description'];
      $bl_state           = $rowSelectDataUnit['bl_state'];
    }
?>

  <div class="panel-heading">
      <b>Form Ubah Data</b>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="panel-body">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group">
        <label for="">Deskripsi Satuan</label>
        <input type="hidden" name="idEdit" id="idEdit" value="<?php echo $id_unit ?>">
        <input type="text" class="form-control" id="editUnitDescription" name="editUnitDescription" placeholder="Nama Satuan" title="Nama Satuan" value="<?php echo $unit_description ?>">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <legend></legend>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div id="resultUpdate"></div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
        <button type="submit" class="btn btn-primary" id="buttonEdit">Simpan</button>
        <button type="button" class="btn btn-default" id="buttonCancelEdit" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>


<script type="text/javascript">

  

  $('#editUnitDescription').focus();

  // Save Satuan
  function saveUnit(){
    var idEdit              = $('#idEdit').val();
    var editUnitDescription = $('#editUnitDescription').val();
    
    if ($('#editUnitDescription').val() == '') {
      toastr['error']("Deskripsi Satuan Harus Diisi!");
      $('#editUnitDescription').focus();
    }else{
      // AJAX Insert
      disableForm();
      $("#resultUpdate").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/master/unit/update.php" ?>",
          data:"idEdit="+idEdit+"&editUnitDescription="+editUnitDescription,
          success:function(data){
            $("#resultUpdate").html(data);
          }
      });      
    }
  }

  function disableForm(){
    document.getElementById('buttonEdit').disabled = true;
    document.getElementById('buttonCancelEdit').disabled = true;
    document.getElementById('editUnitDescription').disabled = true;
  }
  function enableForm(){
    document.getElementById('buttonEdit').disabled = false;
    document.getElementById('buttonCancelEdit').disabled = false;
    document.getElementById('editUnitDescription').disabled = false;
  }
  function clearForm(){
    $('#editUnitDescription').val('');
    $('#editUnitDescription').focus();
  }

  $('#editUnitDescription').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#editUnitDescription').val() == '') {
        toastr['error']("Deskripsi Satuan Harus Di Isi!");
        $('#editUnitDescription').focus();
      }else {$('#buttonEdit').focus();}
    }
  });

  $('#buttonEdit').click(function(e) {
    saveUnit();
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
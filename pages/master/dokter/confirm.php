<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login']['user_name'])) {

  $idDelete = mysqli_escape_string($config, $_GET['idDelete']);
  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_master_dokter WHERE id_dokter = '$idDelete' AND bl_state = 'A'");
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
    <h3>Yakin Ingin Menghapus <b><?php echo $dokter_name.", ".$dokter_type ?></b> ?</h3>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="d_id_dokter" id="d_id_dokter" value="<?php echo $id_dokter ?>">
        <input type="hidden" name="d_dokter_name" id="d_dokter_name" value="<?php echo $dokter_name ?>">
        <button class="btn btn-danger" title="Hapus dokter" id="buttonDelete"> Hapus </button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"  id="buttonCancelDelete">Batal</button>
      </div>
    </div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var d_id_dokter   = $('#d_id_dokter').val();
    var d_dokter_name = $('#d_dokter_name').val();

    $("#resultDelete").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/dokter/delete.php" ?>",
        data:"d_id_dokter="+d_id_dokter+"&d_dokter_name="+d_dokter_name,
        success:function(data){
          $("#resultDelete").html(data);
        }
    });
  }

  $('#buttonDelete').click(function(event) {
    actionDelete();
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
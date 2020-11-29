<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login']['user_name'])) {

  $idDelete = $_GET['idDelete'];
  $querySelectData =  mysqli_query($config, " SELECT * FROM tb_master_supplier WHERE id_supplier = '$idDelete' AND bl_state = 'A'");
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
    <h4>Yakin Ingin Menghapus <b><?php echo $supplier_name.", ".$supplier_type ?></b> ?</h4>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="d_id_supplier" id="d_id_supplier" value="<?php echo $id_supplier ?>">
        <input type="hidden" name="d_supplier_name" id="d_supplier_name" value="<?php echo $supplier_name ?>">
        <button class="btn btn-danger" title="Hapus Supplier" id="buttonDelete"> Hapus </button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"  id="buttonCancelDelete">Batal</button>
      </div>
    </div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var d_id_supplier   = $('#d_id_supplier').val();
    var d_supplier_name = $('#d_supplier_name').val();

    $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/supplier/delete.php" ?>",
        data:"d_id_supplier="+d_id_supplier+"&d_supplier_name="+d_supplier_name,
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
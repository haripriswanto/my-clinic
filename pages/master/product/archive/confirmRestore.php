<?php 
include('../../../../config/config.php');

if (!empty($_SESSION['login'])) {

  $idRestore   = mysqli_escape_string($config, $_GET['idRestore']);

  $selectProduct = "SELECT * FROM tb_master_product WHERE id_product = '$idRestore' ";
  $querySelectProduct = mysqli_query($config, $selectProduct);
  $rowSelectProduct = mysqli_fetch_array($querySelectProduct);

?>
    <h3>Restore Data Produk <b><?php echo $rowSelectProduct['product_name']; ?></b> ?</h3>
    <i>Restore data berarti mengaktifkan data dari tabel arsip!</i>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="progressRestore"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="restore_id_product" id="restore_id_product" value="<?php echo $idRestore ?>">
        <input type="hidden" name="restore_product_name" id="restore_product_name" value="<?php echo $rowSelectProduct['product_name'] ?>">
        <button class="btn btn-success" title="Hapus dokter" id="buttonArchive"> Restore </button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"  id="buttonCancelDelete">Batal</button>
      </div>
    </div>

<script type="text/javascript">
  // Delete Ajax
  function actionArchive(){
    var restore_id_product   = $('#restore_id_product').val();
    var restore_product_name = $('#restore_product_name').val();

    $("#progressRestore").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/product/archive/actionRestore.php" ?>",
        data:"restore_id_product="+restore_id_product+"&restore_product_name="+restore_product_name,
        success:function(data){
          $("#progressRestore").html(data);
        }
    });
  }

  $('#buttonArchive').click(function(e) {
    actionArchive();
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
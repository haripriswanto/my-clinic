<?php 
include('../../../../config/config.php');

if (!empty($_SESSION['login'])) {
  
  $idArchive   = mysqli_escape_string($config, $_GET['idArchive']);

  $selectProduct = "SELECT * FROM tb_master_product WHERE id_product = '$idArchive' ";
  $querySelectProduct = mysqli_query($config, $selectProduct);
  $rowSelectProduct = mysqli_fetch_array($querySelectProduct);
  

?>
    <h3>Arsipkan Data Produk <b><?php echo $rowSelectProduct['product_name']; ?></b> ?</h3>
    <i>Arsipkan data berarti menonaktifkan data dari tabel produk!</i>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="progressArchive"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="archive_id_product" id="archive_id_product" value="<?php echo $idArchive ?>">
        <input type="hidden" name="archive_product_name" id="archive_product_name" value="<?php echo $rowSelectProduct['product_name']; ?>">
        <button class="btn btn-primary" title="Hapus dokter" id="buttonActionArchive"> Arsip </button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"  id="buttonCancelDelete">Batal</button>
      </div>
    </div>

<script type="text/javascript">
  // Delete Ajax
  function actionArchive(){
    var archive_id_product   = $('#archive_id_product').val();
    var archive_product_name = $('#archive_product_name').val();

    $("#progressArchive").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/product/archive/actionArchive.php" ?>",
        data:"archive_id_product="+archive_id_product+"&archive_product_name="+archive_product_name,
        success:function(data){
          $("#progressArchive").html(data);
        }
    });
  }

  $('#buttonActionArchive').click(function(e) {
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
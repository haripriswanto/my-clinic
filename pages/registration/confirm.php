<?php 
include('../../config/config.php');
if (!empty($_SESSION['login'])) {

  $product_id   = mysqli_escape_string($config, $_GET['id']);
  $product_code = mysqli_escape_string($config, $_GET['code']);
  $product_name = mysqli_escape_string($config, $_GET['name']);

?>
    <h3>Yakin ingin menghapus data <b><?php echo $product_name ?></b> ?</h3>
    <i>Menghapus data berarti menghapus data dari tabel produk!</i>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="d_id_product" id="d_id_product" value="<?php echo $product_id ?>">
        <input type="hidden" name="d_product_code" id="d_product_code" value="<?php echo $product_code ?>">
        <input type="hidden" name="d_product_name" id="d_product_name" value="<?php echo $product_name ?>">
        <button class="btn btn-danger" title="Hapus dokter" id="buttonDelete"> Hapus </button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"  id="buttonCancelDelete">Batal</button>
      </div>
    </div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var d_id_product   = $('#d_id_product').val();
    var d_product_code = $('#d_product_code').val();
    var d_product_name = $('#d_product_name').val();

    $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/product/delete.php" ?>",
        data:"d_id_product="+d_id_product+"&d_product_code="+d_product_code+"&d_product_name="+d_product_name,
        success:function(data){
          $("#resultDelete").html(data);
        }
    });
  }

  $('#buttonDelete').click(function(e) {
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
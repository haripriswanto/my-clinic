<?php 
include('../../../../config/config.php'); 
$invoice_number = mysqli_escape_string($config, $_GET['invoice_number']);

?>
<div class="panel panel-primary">
	<div class="panel-heading">
	  <h3 class="panel-title">
	    Konfirmasi
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonClose">&times;</button>
	  </h3>
	</div>
	<div class="panel-body">
	  <h4>Yakin Ingin Hapus Transaksi <b><?php echo $invoice_number; ?></b> ?</h4>
	  <legend></legend>
	  <div class="text-right">
	    <span id="resultDeleteItem"></span>
	    <input type="hidden" name="invoice_number" id="invoice_number" value="<?php echo $invoice_number; ?>">
	    <button type="button" class="btn btn-danger" id="buttonHapus">Hapus</button>
	    <button type="button" class="btn btn-default" data-dismiss="modal" id="buttonCancel">Batal</button>
	  </div>
	</div>
</div>

<script type="text/javascript">
    function deleteTransaction(){
      var invoice_number = $('#invoice_number').val();
      $("#resultDeleteItem").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><font size='3'>Sedang Proses ...</font></center>");
      disabledDelete();
      // Result
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/transaction/buying/preview/cancel.php" ?>",
          data:'invoice_number='+invoice_number,
          success:function(data){
            $("#resultDeleteItem").html(data);
          }
      });
    }

    $('#buttonHapus').click(function(event) {
      deleteTransaction();
    });
</script>

<?php include('../../../config/config.php');  ?>
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        Konfirmasi!
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonCloseCart">&times;</button>
      </h3>
    </div>
    <div class="panel-body">
        <?php  
            
        ?>
        <h4>Yakin Ingin Membatalkan Transaksi Ini ?</h4> 
        <legend></legend>
        <div id="resultDeleted"></div>
        <button type="button" class="btn btn-danger" id="buttonTrue">Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="buttonFalse">Batal</button>
    </div>
</div>

<script type="text/javascript">
function cancelTransaction(){
    $("#resultDeleted").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><font size='3'>Sedang Proses ...</font></center>");
    document.getElementById('buttonTrue').disabled = true;
    document.getElementById('buttonFalse').disabled = true;
    document.getElementById('buttonCloseCart').disabled = true;
    // Result
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/transaction/buying/cartCancelAction.php" ?>",
        success:function(data){
            $("#resultDeleted").html(data);
        }
    });
}

$('#buttonTrue').click(function(event) {
  cancelTransaction();
});
</script>
<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login'])) {
?>

<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        Konfirmasi!
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonCloseCart">&times;</button>
      </h3>
    </div>
    <div class="panel-body">
        <h4>Yakin Ingin Membatalkan Transaksi Ini?</h4> 
        <legend></legend>
        <div id="resultDeleted"></div>
        <button type="button" class="btn btn-danger" id="buttonTrue">Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="buttonFalse">Batal</button>
    </div>
</div>

<script type="text/javascript">
function cancelTransaction(){
    $("#buttonTrue").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='15' height='15'/><font size='2'>Proses ...</font>");
        document.getElementById('buttonTrue').disabled = true;
        document.getElementById('buttonFalse').disabled = true;
        document.getElementById('buttonCloseCart').disabled = true;
    // Result
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/transaction/selling/cartCancelAction.php" ?>",
        success:function(data){
            $("#buttonTrue").html(data);
        }
    });
}

$('#buttonTrue').click(function(event) {
  cancelTransaction();
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
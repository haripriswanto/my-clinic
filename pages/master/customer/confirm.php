<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login']['user_name'])) {

  $idDelete = $_GET['idDelete'];
  $querySelectData =  mysqli_query($config, "SELECT * FROM tb_customer WHERE id_customer = '$idDelete' AND bl_state = 'A' ");

    $number = 0;
    while ($rowSelectData = mysqli_fetch_array($querySelectData)){
      $number                 = $number + 1 ;
      $id_customer            = $rowSelectData['id_customer'];
      $customer_code          = $rowSelectData['customer_code'];
      $full_name              = $rowSelectData['full_name'];
    }

?>
<h3>Yakin Ingin Menghapus <b><?php echo $full_name ?></b> ?</h3>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer ?>">
        <input type="hidden" name="full_name" id="full_name" value="<?php echo $full_name ?>">
  	    <button class="btn btn-danger" title="Hapus customer" id="buttonDelete"> Hapus </button>
  		  <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
      </div>
	</div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var id_customer = $('#id_customer').val();
    var full_name   = $('#full_name').val();

    $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/customer/delete.php" ?>",
        data:"id_customer="+id_customer+"&full_name="+full_name,
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
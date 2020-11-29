<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login']['user_name'])) {
  
  $idDelete = $_GET['idDelete'];
  
  $selectDataUnit = " SELECT * FROM tb_master_unit WHERE id_unit ='$idDelete' AND bl_state = 'A'";
  $querySelectDataUnit =  mysqli_query($config, $selectDataUnit);

    while ($rowSelectDataUnit = mysqli_fetch_array($querySelectDataUnit)){
      $id_unit            = $rowSelectDataUnit['id_unit'];
      $unit_code          = $rowSelectDataUnit['unit_code'];
      $unit_description   = $rowSelectDataUnit['unit_description'];
      $bl_state           = $rowSelectDataUnit['bl_state'];
    }

?>
<h3>Yakin Ingin Menghapus <b><?php echo $unit_description ?></b> ?</h3>
    <div class="modal-footer">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <span id="resultDelete"></span>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <input type="hidden" name="idDelete" id="idDelete" value="<?php echo $id_unit ?>">
        <input type="hidden" name="unit_description" id="unit_description" value="<?php echo $unit_description ?>">
  	    <button class="btn btn-danger" title="Hapus Unit" id="buttonDelete"> Hapus </button>
  		  <button class="btn btn-default" data-dismiss="modal" aria-hidden="true" id="buttonCancelDelete">Batal</button>
      </div>
	</div>

<script type="text/javascript">
  // Delete Ajax
  function actionDelete(){
    var idDelete = $('#idDelete').val();
    var unit_description   = $('#unit_description').val();

    document.getElementById('buttonDelete').disabled = true;
    document.getElementById('buttonCancelDelete').disabled = true;
    $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
    $.ajax({
        type:"get",
        url:"<?php echo $base_url."pages/master/unit/delete.php" ?>",
        data:"idDelete="+idDelete+"&unit_description="+unit_description,
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
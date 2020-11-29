
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {
  
	$id = $_POST['del_id'];
    $querySelectUser =  mysqli_query($config, " 
      SELECT * FROM tb_system_user_role 
      WHERE id = '$id' AND is_active = 'A' ");

      $rowSelect = mysqli_fetch_array($querySelectUser);
        $id                = $rowSelect['id'];
        $role_code         = $rowSelect['role_code'];
        $role_description  = $rowSelect['role_description'];
        $ts_insert         = $rowSelect['ts_insert'];
        $ts_update         = $rowSelect['ts_update'];
?>
		<h3>Yakin Ingin Menghapus Data <b><?php echo $role_description ?></b> ?</h3>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<legend></legend>
	</div>
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" id="resultDelete"></div>		
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">		
        <input value="<?php echo $id; ?>" type="hidden" class="form-control" name="idDelete" id="idDelete">
        <input value="<?php echo $role_description; ?>" type="hidden" class="form-control" name="d_roleDescription" id="d_roleDescription">
        <button id="deleteAction" class="btn btn-danger">Hapus</button>
		<button id="deleteActionCancel" class="btn btn-default" data-dismiss="modal">Batal</button>
	</div>


<script type="text/javascript">
	$("#deleteAction").click(function(event) {
		var idDelete 			= $("#idDelete").val();
		var d_roleDescription 	= $("#d_roleDescription").val();
		var deleteAction 		= $("#deleteAction").disabled = true;
		var deleteActionCancel 	= $("#deleteActionCancel").disabled = true;


	  $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
	  $.ajax({
	      type:"POST",
	      url:"<?php echo $base_url."pages/setting/user-role/delete.php" ?>",
	      data:{
            idDelete: idDelete,
            d_roleDescription: d_roleDescription
          },
	      success:function(data){
	        $("#resultDelete").html(data);
	      }
	  })
	})

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
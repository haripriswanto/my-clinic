
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {
  
	$id = $_POST['del_id'];

    $query =  mysqli_query($config, " 
    SELECT * FROM tb_system_menu WHERE id = '$id' ");

        $rowSelectData = mysqli_fetch_array($query);
        $id               = $rowSelectData['id'];
        $menu_code        = $rowSelectData['menu_code'];
        $menu_description = $rowSelectData['menu_description'];
        $menu_url         = $rowSelectData['menu_url'];
        $menu_icon        = $rowSelectData['menu_icon'];
        $sort_menu        = $rowSelectData['sort_menu'];
        $type_menu        = $rowSelectData['type_menu'];
        $is_active        = $rowSelectData['is_active'];
?>
		<h3>Yakin Ingin Menghapus Menu <b><?php echo $menu_description ?></b> ?</h3>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<legend></legend>
	</div>
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" id="resultDelete"></div>		
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">		
        <input value="<?php echo $id; ?>" type="hidden" class="form-control" name="idDelete" id="idDelete">
        <input value="<?php echo $menu_description; ?>" type="hidden" class="form-control" name="menu_description" id="menu_description">
        <button id="deleteAction" class="btn btn-danger">Hapus</button>
		<button id="deleteActionCancel" class="btn btn-default" data-dismiss="modal">Batal</button>
	</div>


<script type="text/javascript">
	$("#deleteAction").click(function(event) {
		var idDelete 			= $("#idDelete").val();
		var menu_description    = $("#menu_description").val();
		var deleteAction 		= $("#deleteAction").disabled = true;
		var deleteActionCancel 	= $("#deleteActionCancel").disabled = true;


	  $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
	  $.ajax({
	      type:"get",
	      url:"<?php echo $base_url."pages/setting/menu/delete.php" ?>",
	      data:"idDelete="+idDelete+"&menu_description="+menu_description,
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
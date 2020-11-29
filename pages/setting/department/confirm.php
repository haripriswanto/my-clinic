
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {
  
	$id_user = $_POST['del_id'];

    $query =  mysqli_query($config, " 
    SELECT * FROM tb_system_user WHERE id_user = '$id_user' AND is_active = 'A' ");

      $number = 0;
      while ($row = mysqli_fetch_array($query)){
        $number                 = $number + 1 ;
        $id_user                = $row['id_user'];
        $full_name              = $row['user_full_name'];
        $address                = $row['user_address'];
        $email                  = $row['user_email'];
        $gender                 = $row['user_gender'];
        $user_name              = $row['user_name'];
        $password               = $row['user_password'];
        $phone                  = $row['user_phone'];
        $birthday               = $row['user_birthday'];
        $access_level           = $row['access_level'];
    }
?>
		<h3>Yakin Ingin Menghapus User <b><?php echo $full_name ?></b> ?</h3>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<legend></legend>
	</div>
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" id="resultDelete"></div>		
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">		
        <input value="<?php echo $id_user; ?>" type="hidden" class="form-control" name="idDelete" id="idDelete">
        <input value="<?php echo $full_name; ?>" type="hidden" class="form-control" name="full_name" id="full_name">
        <button id="deleteAction" class="btn btn-danger">Hapus</button>
		<button id="deleteActionCancel" class="btn btn-default" data-dismiss="modal">Batal</button>
	</div>


<script type="text/javascript">
	$("#deleteAction").click(function(event) {
		var idDelete 			= $("#idDelete").val();
		var full_name 			= $("#full_name").val();
		var deleteAction 		= $("#deleteAction").disabled = true;
		var deleteActionCancel 	= $("#deleteActionCancel").disabled = true;


	  $("#resultDelete").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
	  $.ajax({
	      type:"get",
	      url:"<?php echo $base_url."pages/setting/user/delete.php" ?>",
	      data:"idDelete="+idDelete+"&full_name="+full_name,
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
<?php 
include('../../../config/config.php'); 

$product_code_delete = mysqli_escape_string($config, $_POST['product_code_delete']);
$product_name_delete = mysqli_escape_string($config, $_POST['product_name_delete']);

$deleteExecution = mysqli_query($config, "DELETE FROM tb_buying_cart WHERE product_code_relation = '$product_code_delete' AND user_name = '$sessionUser' AND outlet_code_relation = '$system_outlet_code' ");

if ($deleteExecution) {
	echo "<script>
			closeForm();
			toastr['success']('Berhasil Hapus Item ".$product_name_delete."');
			LoadCartTransaction();
			$('#buttonHapus').html('Hapus');
	</script>";
}else{
	echo "Ada Error Pada Query Delete!
	<script>
	      document.getElementById('buttonHapus').disabled = false;
	      document.getElementById('buttonCancel').disabled = false;
	      document.getElementById('buttonClose').disabled = false;
		</script>";
}
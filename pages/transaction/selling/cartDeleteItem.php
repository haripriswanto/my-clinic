<?php 
include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

	$product_code_delete = $_GET['product_code_delete'];

	$deleteExecution = mysqli_query($config, "DELETE FROM tb_selling_cart WHERE product_code_relation = '$product_code_delete' AND user_name = '$sessionUser' AND outlet_code_relation = '$system_outlet_code' ");

	if ($deleteExecution) {
		echo "<script>closeForm();$.notify('Berhasil Hapus Item ".$product_code_delete."', 'success');LoadCartTransaction();</script>";
	}else{
		echo "Ada Error Pada Query Delete!
		<script>
			document.getElementById('buttonHapus').disabled = false;
			document.getElementById('buttonCancel').disabled = false;
			document.getElementById('buttonClose').disabled = false;
			</script>";
	}
	
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
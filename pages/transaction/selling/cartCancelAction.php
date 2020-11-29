<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

	$queryDeleteCart = mysqli_query($config, "DELETE FROM tb_selling_cart 
							WHERE 
							user_name = '$sessionUser' AND 
							outlet_code_relation = '$system_outlet_code' AND 
							ip_address = '$ip_address' AND 
							bl_state = 'A' ");

	if ($queryDeleteCart) {
		echo "<script>
				toastr['success']('Berhasil Membatalkan Transaksi!');
				closeForm();
				clearHeadForm();
				LoadCartTransaction();
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
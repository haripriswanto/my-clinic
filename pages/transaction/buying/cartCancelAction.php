<?php 
include('../../../config/config.php');

// echo "Berhasil Tampil";exit();

$queryDeleteCart = mysqli_query($config, "DELETE FROM tb_buying_cart 
							WHERE user_name = '$sessionUser' 
							AND outlet_code_relation = '$system_outlet_code' ");

	if ($queryDeleteCart) {
		echo "<script>toastr['success']('Berhasil Membatalkan Transaksi!');LoadCartTransaction();closeForm();</script>";
	} 
?>
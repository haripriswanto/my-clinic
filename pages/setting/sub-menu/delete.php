<?php

include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

	$id 	= mysqli_escape_string($config, $_GET['idDelete']);
	$sub_menu_description	= mysqli_escape_string($config, $_GET['sub_menu_description']);

	$query = "UPDATE tb_system_sub_menu SET ts_update = '$currentTimeStamp', is_active = 'D' 
	WHERE id = '" . $id . "' ";

	$result = mysqli_query($config, $query);
	if (!$result) {
		echo mysqli_error($config);
	} else {

		// log Activity
		$insertLogData = log_insert('DELETE', 'Menghapus Data Sub Menu id : ' . $id . ', Nama : ' . $sub_menu_description, $ip_address, $os, $browser);
		$queryInsertLogData = mysqli_query($config, $insertLogData);
		if (!$queryInsertLogData) {
			echo mysqli_error($config);
		} else {
			echo "<script>
					closeForm();
					loadData();
					toastr['success']('Berhasil Hapus Data " . $sub_menu_description . "');
				</script>";
			mysqli_close($config);
		}
	}
} elseif (empty($_SESSION['login'])) {
?>
	<script type="text/javascript">
		alert("sesi anda habis, silahkan login kembali");
		window.location = "<?php echo $base_url . "" ?>";
	</script>
<?php
}
?>
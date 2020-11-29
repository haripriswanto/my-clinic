<?php 

include('../../../config/config.php');

if (!empty($_SESSION['login'])) {


	$idDelete 			= mysqli_escape_string($config, $_POST['idDelete']);
	$d_roleDescription	= mysqli_escape_string($config, $_POST['d_roleDescription']);

	$query = "UPDATE tb_system_user_role SET is_active = 'D' WHERE id = '".$idDelete."' ";	
	$result = mysqli_query($config, $query);

	if(!$result){
	echo mysqli_last_error($config);
	} else {

		// log Activity
		$insertLogData = log_insert('DELETE', 'Menghapus Data Role id : '.$idDelete.', Deskripsi : '.$d_roleDescription, $ip_address, $os, $browser);
		$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					// closeForm();
					loadData();
					$.notify('Berhasil Hapus Data ".$d_roleDescription."', 'success');
				</script>";
		mysqli_close($config);
		}
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
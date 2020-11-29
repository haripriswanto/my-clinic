<?php 

include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

	$id_user 	= mysqli_escape_string($config, $_GET['idDelete']);
	$full_name	= mysqli_escape_string($config, $_GET['full_name']);

	$query = "UPDATE tb_system_user SET is_active = 'D' WHERE id_user = '".$id_user."' ";
		
	$result = mysqli_query($config, $query);
	if(!$result){
	echo mysqli_last_error($config);
	} else {

		// log Activity
		$insertLogData = log_insert('DELETE', 'Menghapus Data User id : '.$id_user.', Nama : '.$full_name, $ip_address, $os, $browser);
		$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					closeForm();
					loadDataUser();
					$.notify('Berhasil Hapus Data ".$full_name."', 'success');
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
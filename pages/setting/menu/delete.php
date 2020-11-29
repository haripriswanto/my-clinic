<?php 

include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

	$id 	= mysqli_escape_string($config, $_GET['idDelete']);
	$menu_description	= mysqli_escape_string($config, $_GET['menu_description']);

	$query = "DELETE FROM tb_system_menu WHERE id = '".$id."' ";
		
	$result = mysqli_query($config, $query);
	if(!$result){
	echo mysqli_last_error($config);
	} else {

		// log Activity
		$insertLogData = log_insert('DELETE', 'Menghapus Data Menu id : '.$id.', Nama : '.$menu_description, $ip_address, $os, $browser);
		$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					closeForm();
					loadData();
					toastr['success']('Berhasil Hapus Data ".$menu_description."');
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
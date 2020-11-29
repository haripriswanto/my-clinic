
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

	$e_roleId      		= mysqli_escape_string($config, $_GET['e_roleId']);
	$e_roleCode      	= mysqli_escape_string($config, $_GET['e_roleCode']);
	$e_roleDescription  = mysqli_escape_string($config, $_GET['e_roleDescription']);

	// var_dump($e_roleId, $e_roleCode, $e_roleDescription);exit;
	$updateData = "
		UPDATE tb_system_user_role SET role_code = '$e_roleCode', role_description = '$e_roleDescription', ts_update = '".date('Y-m-d H:i:s')."' WHERE id = '$e_roleId'";

	$queryUpdateData = mysqli_query($config, $updateData);

	if ($queryUpdateData) {

	// log Activity
	$insertLogData = log_insert('UPDATE', 'Merubah Data Role id : '.$e_roleId.', Deskripsi : '.$e_roleDescription, $ip_address, $os, $browser);
	$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					loadData();
					toastr['success']('Berhasil perbarui Data ".$e_roleDescription." ');
					closeForm();
				</script>";
		}
	}
	else{
		echo "<div class='alert alert-danger'>
				<strong>Error Query UPDATE Role!</strong>
			</div>";
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

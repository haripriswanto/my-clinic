
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

  	$generateId	 = mysqli_escape_string($config, sha1(generate(10)));
	$menuId      = mysqli_escape_string($config, $_POST['menuId']);
	$roleId      = mysqli_escape_string($config, $_POST['roleId']);
	
	$selectAccess = "SELECT * FROM tb_system_access_menu WHERE role_id = '$roleId' AND menu_id = '$menuId' ";

	
	$querySelectAccess = mysqli_query($config, $selectAccess);
	$rowSelectAccess = mysqli_num_rows($querySelectAccess);

	if ($rowSelectAccess == 0) {
		$queryInsert = "INSERT INTO tb_system_access_menu(id, role_id, menu_id) 
			VALUES ('$generateId', '$roleId', '$menuId')";
		$actionQuery = mysqli_query($config, $queryInsert);
		$notify = "<script>toastr['success']('Berhasil Merubah Akses');</script>";
	} elseif ($rowSelectAccess != 0){
		$queryDelete = "DELETE FROM tb_system_access_menu WHERE role_id ='$roleId' AND menu_id = '$menuId' ";
		$actionQuery = mysqli_query($config, $queryDelete);
		$notify = "<script>toastr['warning']('Berhasil Hapus Data');</script>";
	}
	echo($notify);
	exit;


	$updateUser = "
		UPDATE tb_system_user SET user_name = '$edit_username', user_full_name = '$edit_nama', user_address = '$edit_address', user_email = '$edit_email', user_phone = '$edit_phone', user_gender = '$edit_gender', user_birthday = '$edit_birthday', access_level = '$edit_akses', ts_update = '".date('Y-m-d H:i:s')."' WHERE id_user = '$id_user'";

		// var_dump($updateUser);exit;
	$queryUpdateUser = mysqli_query($config, $updateUser);

	if ($queryUpdateUser) {

	// log Activity
	$insertLogData = log_insert('UPDATE', 'Merubah Data User id : '.$id_user.', Nama : '.$edit_username, $ip_address, $os, $browser);
	$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					closeForm();
					loadDataUser();
					$.notify('Berhasil perbarui Data User ".$edit_username." ', 'success');
				</script>";
		}
	}
	else{
		echo "<div class='alert alert-danger'>
				<strong>Error Query UPDATE USER!</strong>
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
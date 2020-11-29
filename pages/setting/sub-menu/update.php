
<?php 
  include('../../../config/config.php'); 

if (!empty($_SESSION['login'])) {

    $e_menuId 		 	= mysqli_escape_string($config, $_GET['e_menuId']);
    $e_menuDescription 	= mysqli_escape_string($config, $_GET['e_menuDescription']);
    $e_menuCode        	= mysqli_escape_string($config, $_GET['e_menuCode']);
    $e_menuUrl         	= mysqli_escape_string($config, $_GET['e_menuUrl']);
    $e_menuIcon        	= mysqli_escape_string($config, $_GET['e_menuIcon']);
    $e_menuSort        	= mysqli_escape_string($config, $_GET['e_menuSort']);
    $e_mainMenu        	= mysqli_escape_string($config, $_GET['e_mainMenu']);
    $e_menuIsActive    	= mysqli_escape_string($config, $_GET['e_menuIsActive']);

	if ($e_menuIsActive == ''){
		$e_menuIsActive = 'D';
	}

	$update = "
	UPDATE tb_system_sub_menu 
	SET sub_menu_code = '$e_menuCode', menu_id = '$e_mainMenu', sub_menu_description = '$e_menuDescription', sub_menu_url = '$e_menuUrl', sub_menu_icon = '$e_menuIcon', sub_menu_sort = '$e_menuSort', ts_update = '".date('Y-m-d H:i:s')."', is_active = '$e_menuIsActive'
	WHERE id = '$e_menuId' ";

		// var_dump($update);exit;
	$queryUpdate = mysqli_query($config, $update);

	if ($queryUpdate) {

	// log Activity
	$insertLogData = log_insert('UPDATE', 'Merubah Data Menu id : '.$e_menuId.', Nama : '.$e_menuDescription, $ip_address, $os, $browser);
	$queryInsertLogData = mysqli_query($config, $insertLogData);
		if(!$queryInsertLogData){
			echo mysqli_error($config);
		} 
		else {
			echo "<script>
					closeForm();
					loadData();
					toastr['success']('Berhasil perbarui Data ".$e_menuDescription."');
				</script>";
		}
	}
	else{
		echo "<div class='alert alert-danger'>
				<strong>Error Query UPDATE Menu!</strong>
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

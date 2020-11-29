<?php 
	include('../../../config/config.php'); 

 	$d_id_supplier 		= mysqli_escape_string($config, $_GET['d_id_supplier']);
 	$d_supplier_name 	= mysqli_escape_string($config, $_GET['d_supplier_name']);
 	echo "<script>
	    document.getElementById('buttonDelete').disabled = false;
	    document.getElementById('buttonCancelDelete').disabled = false;
 	</script>";
 	// var_dump($d_id_supplier);exit;

	$queryDeleteData = mysqli_query($config, "UPDATE tb_master_supplier SET bl_state='D' WHERE id_supplier = '$d_id_supplier'");

	if ($queryDeleteData) {

	    $insertLogData = "INSERT INTO log_activity(

        id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
            VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'DELETE', 'Menghapus Data Supplier ".$d_supplier_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadData();$.notify('Berhasil Hapus Data ".$d_supplier_name."', 'success')</script>";
	    }else{
	    	echo "Error Query Insert Log";
	    }
	}else{
		echo "Error Query Delete Data";
	}
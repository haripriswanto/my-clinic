<?php 
	include('../../../config/config.php'); 

	if (!empty($_SESSION['login']['user_name'])) {

 	$id_customer = mysqli_escape_string($config, $_GET['id_customer']);
 	$full_name 	 = mysqli_escape_string($config, $_GET['full_name']);
 	// var_dump($id_customer);exit;

	$queryDeleteData = mysqli_query($config, "UPDATE tb_customer SET bl_state='D' WHERE id_customer = '$id_customer'");

	if ($queryDeleteData) {

	    $insertLogData = "INSERT INTO log_activity(

        id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
            VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'DELETE', 'Menghapus Data Customer ".$full_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadDataCustomer();toastr['success']('Berhasil Hapus Data ".$full_name."', 'success')</script>";
	    }else{
	    	echo "Error Query Insert Log";
	    }
	}else{
		echo "Error Query Delete Data";
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
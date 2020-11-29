<?php 
	include('../../../config/config.php'); 

	if (!empty($_SESSION['login']['user_name'])) {

 	$d_id_dokter 	= mysqli_escape_string($config, $_GET['d_id_dokter']);
 	$d_dokter_name 	= mysqli_escape_string($config, $_GET['d_dokter_name']);

	$queryDeleteData = mysqli_query($config, "UPDATE tb_master_dokter SET bl_state='D' WHERE id_dokter = '$d_id_dokter' AND  outlet_code_relation = '$system_outlet_code'");

	if ($queryDeleteData) {
	    $insertLogData = "INSERT INTO log_activity(
        id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
            VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'DELETE', 'Menghapus Data Dokter ".$d_dokter_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadData();toastr['success']('Berhasil Hapus Data ".$d_dokter_name."')</script>";
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
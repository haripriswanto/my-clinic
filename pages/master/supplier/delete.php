<?php 
	include('../../../config/config.php'); 

	if (!empty($_SESSION['login']['user_name'])) {

 	$d_id_supplier 		= mysqli_escape_string($config, $_GET['d_id_supplier']);
 	$d_supplier_name 	= mysqli_escape_string($config, $_GET['d_supplier_name']);
 	echo "<script>
	    document.getElementById('buttonDelete').disabled = false;
	    document.getElementById('buttonCancelDelete').disabled = false;
 	</script>";

	$queryDeleteData = mysqli_query($config, "UPDATE tb_master_supplier SET bl_state='D' WHERE id_supplier = '$d_id_supplier'");

	if ($queryDeleteData) {
	    // log Activity
	    $insertLogData = log_insert('DELETE', 'Menghapus Data Supplier id: '.$d_id_supplier." Nama: ".$d_supplier_name.'', $ip_address, $os, $browser);
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadData();toastr['success']('Berhasil Hapus Data ".$d_supplier_name."', 'success')</script>";
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
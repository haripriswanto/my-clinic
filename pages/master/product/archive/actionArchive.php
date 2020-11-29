<?php 
include('../../../../config/config.php'); 

if (!empty($_SESSION['login']['user_name'])) {

 	$d_id_product 	= mysqli_escape_string($config, $_GET['archive_id_product']);
 	$d_product_name = mysqli_escape_string($config, $_GET['archive_product_name']);

	$queryDeleteData = mysqli_query($config, "UPDATE tb_master_product SET bl_state = 'D', ts_update = '$currentDate $currentTime' WHERE id_product = '$d_id_product' AND  outlet_code_relation = '$system_outlet_code'");

	if ($queryDeleteData) {
		
		// insert Log Activity
		$insertLogData = log_insert('ARCHIVE', 'Mengarsipkan Data Produk id: '.$d_id_product." Nama: ".$d_product_name.'', $ip_address, $os, $browser);
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadData();$.notify('Berhasil Mengarsipkan Data ".$d_product_name."', 'success')</script>";
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
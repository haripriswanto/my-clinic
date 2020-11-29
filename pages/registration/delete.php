<?php 
include('../../config/config.php'); 

if (!empty($_SESSION['login']['user_name'])) {

 	$d_id_product 	= mysqli_escape_string($config, $_GET['d_id_product']);
 	$d_product_code = mysqli_escape_string($config, $_GET['d_product_code']);
 	$d_product_name = mysqli_escape_string($config, $_GET['d_product_name']);

	$queryDeleteData = mysqli_query($config, "DELETE FROM tb_master_product WHERE id_product = '$d_id_product' AND  outlet_code_relation = '$system_outlet_code'");

	$queryDeleteData = mysqli_query($config, "DELETE FROM tb_master_stock WHERE product_code_relation = '$d_product_code' AND bl_state = 'A' AND  outlet_code_relation = '$system_outlet_code'");

	if ($queryDeleteData) {
		// log Activity
		$insertLogData = log_insert('DELETE', 'Menghapus Data Produk id: '.$d_id_product." Nama: ".$d_product_name.'', $ip_address, $os, $browser);
	    $queryInsertLogData = mysqli_query($config, $insertLogData);
	    if ($queryInsertLogData) {
	    	echo "<script>closeForm();loadData();$.notify('Berhasil Hapus Data ".$d_product_name."', 'success')</script>";
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
<?php 
include('../../../../config/config.php');

if (!empty($_SESSION['login'])) {


$invoice_number = mysqli_escape_string($config, $_POST['invoice_number']);
echo "<script>enabledDelete();</script>";
// echo $invoice_number;exit();

	//CHECK PENGURANGAN STOK
	$querySelectStock =  mysqli_query($config, " 
	    SELECT tb_selling_transaction_detail.product_code_relation AS kode, tb_selling_transaction_detail.product_name AS nama, tb_selling_transaction_detail.*, tb_master_stock.*
	    FROM tb_selling_transaction_detail
	    INNER JOIN tb_master_stock
	    ON tb_selling_transaction_detail.product_code_relation = tb_master_stock.product_code_relation 
    	WHERE tb_selling_transaction_detail.invoice_number_relation = '$invoice_number'
    ");
	 $numRowStock = mysqli_num_rows($querySelectStock);
	
	// PERHITUNGAN TABEL MASTER STOK
	while ($newRowStock = mysqli_fetch_array($querySelectStock)){
		$product_code_minus 		= $newRowStock['kode'];
		$product_name_minus 		= $newRowStock['nama'];
		$amount_qty 				= $newRowStock['product_stock'];
		$qty_detail  				= $newRowStock['product_qty']; 
		$result_stock 				= $amount_qty + $qty_detail;

		//UPDATE PENGEMBALIAN STOK
		if ($numRowStock) {
			$queryDropStock = mysqli_query($config, "UPDATE tb_master_stock 
				SET product_stock = '$result_stock', ts_update = '$currentDate $currentTime'
				WHERE product_code_relation = '$product_code_minus' AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ");
			if (!$queryDropStock) {	
				echo "<script>$.notify('Error Hapus Stok', 'error');enabledDelete();</script>";
			}else{				
				$queryUpdateStockHistory = mysqli_query($config, "
					INSERT INTO tb_stock_history(id_stock, product_code_relation, product_name, stock_entry, stock_out, remaining_stock, transaction_code, transaction_description, user_name, outlet_code_relation, ip_address, note, date_insert, time_insert, ts_insert, bl_state)
				    VALUES ('".generate(20)."', '$product_code_minus', '$product_name_minus', '$qty_detail', '0', '$result_stock', '11', 'CANCEL SELLING', '$sessionUser', '$system_outlet_code', '$ip_address', 'Stok Masuk Melalui Retur/Batal Penjualan', '$currentDate', '$currentTime', '$currentDate $currentTime', 'A')");
				$queryDeleteDetail = mysqli_query($config, "UPDATE tb_selling_transaction_detail SET user_code_relation = '$sessionUser', ts_update = '". date('Y-m-d H:i:s') ."', bl_state = 'D'
					WHERE invoice_number_relation = '$invoice_number' AND product_code_relation = '$product_code_minus' AND bl_state = 'A' ");
			}
		}
	}	
	if ($queryUpdateStockHistory && $queryDeleteDetail) {
		// UPDATE TABEL TRANSAKSI
		$queryDeleteTransaction = mysqli_query($config, "UPDATE tb_selling_transaction SET user_code_relation = '$sessionUser', bl_state = 'D', ts_update='$currentDate $currentTime'
									WHERE invoice_number = '$invoice_number' AND outlet_code_relation = '$system_outlet_code' AND bl_state = 'A' ");
		if ($queryDeleteTransaction) {
			// UPDATE TABEL PAYMENT
			$queryDeletePayment = mysqli_query($config, "UPDATE tb_selling_payment SET user_code_relation = '$sessionUser', ip_address = '$ip_address', ts_update = '$currentDate $currentTime', bl_state = 'D' 
				WHERE invoice_number_relation = '$invoice_number' AND bl_state = 'A' ");
			if ($queryDeletePayment) {
				// Insert Log Activity
				$queryInsertLog =  mysqli_query($config, "INSERT INTO log_activity(id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
					VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'CANCEL SELLING', 'Menghapus Trasnsaksi Penjualan Dengan No. Transaksi ".$invoice_number." ' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')");

				if ($queryInsertLog) {
					// Notification
					echo "<script>swal('Berhasil Hapus', 'Berhasil hapus Dengan No. ".$invoice_number."', 'success');LoadReviewTransaction();closeFormReviewSelling();</script>";
				}else{
					echo "<br><div class='alert alert-danger'>Error Query Update Log</div>";
				}
			}else{echo "<br><div class='alert alert-danger'>Error Query Update Payment</div>";}
		}else{echo "<br><div class='alert alert-danger'>Error Query Update Transaction</div>";}
	}else{echo "<br><div class='alert alert-danger'>Error Query Update Drop Stok</div>";}

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
<?php 

include('../../../config/config.php');


$id_stock 		=  mysqli_escape_string($config, $_GET['id_stock']);
$product_code 	=  mysqli_escape_string($config, $_GET['product_code']);
$product_name 	=  mysqli_escape_string($config, $_GET['product_name']);
$product_stock 	=  mysqli_escape_string($config, $_GET['product_stock']);


$updateStock = "UPDATE tb_master_stock SET product_stock = '$product_stock', ts_update = '$currentDate $currentTime' 
				WHERE id_stock = '$id_stock' AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' ";
$queryUpdateStock = mysqli_query($config, $updateStock);
if ($queryUpdateStock) {
	$queryHistoryStock = mysqli_query($config, "
		INSERT INTO tb_stock_history(id_stock, product_code_relation, product_name, stock_entry, stock_out, remaining_stock, transaction_code, transaction_description, user_name, outlet_code_relation, ip_address, note, date_insert, time_insert, ts_insert, bl_state)
	    VALUES ('".sha1(generate(20))."', '$product_code', '$product_name', '0', '0', '$product_stock', '10', 'STOCK OPNAME', '$sessionUser', '$system_outlet_code', '$ip_address', 'STOCK OPNAME RUTIN', '$currentDate', '$currentTime', '$currentDate $currentTime', 'A')");
	if ($queryHistoryStock) {
		$insertLogActivity = "INSERT INTO log_activity(
          id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
              VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'STOCK OPNAME', 'Stock OPNAME ".$product_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
	    $queryInsertLogActivity = mysqli_query($config, $insertLogActivity);
	    if ($queryInsertLogActivity) {
			echo "<script>toastr['success']('Berhasil Update Stok ".$product_name."');loadDataProduct();clearForm();</script>";
		}
	}else{
		echo "<script>toastr['error']('Failed QUERY INSERT History Stock!');</script>";		
	}
}else{
	echo "<script>toastr['error']('Failed QUERY UPDATE Stock!');</script>";		
}

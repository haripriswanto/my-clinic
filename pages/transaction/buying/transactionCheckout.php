<?php 
include("../../../config/config.php");

$money_paid			= mysqli_escape_string($config, $_GET['money_paid']);
$cart_note 			= mysqli_escape_string($config, $_GET['cart_note']);
$total_item_		= mysqli_escape_string($config, $_GET['total_item_']);
$total_harga_ 		= mysqli_escape_string($config, $_GET['total_harga_']);
$supplier_code		= mysqli_escape_string($config, $_GET['supplier_code']);
$supplier_name		= mysqli_escape_string($config, $_GET['supplier_name']);
$quantity 			= mysqli_escape_string($config, $_GET['total_item_']);
$transactionDate 	= mysqli_escape_string($config, $_GET['transaction_date']);
$transactionTime 	= mysqli_escape_string($config, $_GET['transaction_time']);
$updatePrice 		= mysqli_escape_string($config, $_GET['updatePrice']);

if ($updatePrice == '') {
	$updatePrice = '0';
}else{
	$updatePrice = '1';
}

if ($transactionDate == '') {
	$transaction_date = date('Y-m-d');
}else{
	$transaction_date  = $transactionDate;
}

if ($transactionTime == '') {
	$transaction_time  = date('H:i:s');
}else{
	$transaction_time  = $transactionTime;
}

echo "<script>enableButton();</script>";


// QUERY INVOICE NUMBER 
$selectInvoiceNumber 		= "SELECT max(invoice_number) AS invoice_number FROM tb_buying_transaction WHERE bl_state ='A' ";
$querySelectInvoiceNumber  	= mysqli_query($config, $selectInvoiceNumber);
$rowSelectInvoiceNumber		= mysqli_fetch_array($querySelectInvoiceNumber);
$invoice_number     		= $rowSelectInvoiceNumber['invoice_number'];
$resultInvoice_number   	= (int) substr($invoice_number, -4, 5);
$resultInvoice_number++;
$charInvoiceNumber = "buy-".date("ymd.");
$invoiceNumber = $charInvoiceNumber.sprintf("%05s", $resultInvoice_number);

// QUERY QUEUE NUMBER 
$selectQueueNumber 	= "SELECT max(queue_number) AS queue_number FROM tb_buying_transaction WHERE date_insert = '$currentDate' AND bl_state ='A' ";
$queryQueueNumber 	= mysqli_query($config, $selectQueueNumber);
$rowQueueNumber		= mysqli_fetch_array($queryQueueNumber);
$queue_number 		= $rowQueueNumber['queue_number'];
$resultQueue_number = (int) substr($queue_number, -4, 5);
$resultQueue_number++;
$queueNumber = sprintf("%05s", $resultQueue_number);

$insertTransaction = "INSERT INTO tb_buying_transaction(
            id_buying_transaction, invoice_number, queue_number, supplier_code_relation, supplier_description, total_item, date_insert, time_insert, ts_insert, outlet_code_relation, user_code_relation, ip_address, note, bl_state)
    VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$queueNumber', '$supplier_code', '$supplier_name', '$total_item_', '$transaction_date', '$transaction_time', '".date('Y-m-d H:i:s')."', '$system_outlet_code', '$sessionUser', '$ip_address', '$cart_note', 'A')";

$insertPayment = "INSERT INTO tb_buying_payment(id_buying_payment, invoice_number_relation, nominal_cash, type_of_payment, total_paid, money_paid, note, user_code_relation, ip_address, date_insert, time_insert, ts_insert, bl_state)
    VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$total_harga_', 'Tunai', '$total_harga_', '$money_paid', '$cart_note', '$sessionUser', '$ip_address', '$transaction_date', '$transaction_time', '".date('Y-m-d H:i:s')."', 'A')";

$queryInsertTransaction = mysqli_query($config, $insertTransaction);
$queryInertPayment = mysqli_query($config, $insertPayment);

if ($queryInsertTransaction AND $queryInertPayment) {
	
	//CHECK PENAMBAHAN STOK
	 $queryAdditionsStock =  mysqli_query($config, " 
		SELECT tb_buying_cart.*, tb_master_stock.* 
		FROM tb_buying_cart
	    INNER JOIN tb_master_stock 
	    ON tb_buying_cart.product_code_relation = tb_master_stock.product_code_relation
	        WHERE tb_buying_cart.user_name = '$sessionUser' ");

		// UPDATE Stok Di Tabel Stock
	   	while ($rowAdditionsStock = mysqli_fetch_array($queryAdditionsStock)){
	   		$product_code_buying 		= $rowAdditionsStock['product_code_relation'];
	   		$product_name_buying 		= $rowAdditionsStock['product_name'];
	   		$product_description_buying = $rowAdditionsStock['product_description'];
	   		$exp_date_buying 			= $rowAdditionsStock['exp_date'];
			$amount_qty1 		 		= $rowAdditionsStock['product_stock'];
			$qty_detail  		 		= $rowAdditionsStock['buying_qty']; 
			$stockable 	 		 		= $rowAdditionsStock['stockable'];
			$buying_price 	 	 		= $rowAdditionsStock['buying_price'];

			if ($stockable == 1) {
				$result_stock = $amount_qty1 + $qty_detail;
				$updateStock1 = "UPDATE tb_master_stock
									SET product_stock = '$result_stock', expire_date = '$exp_date_buying', ts_update = '".date('Y-m-d H:i:s')."'
									WHERE product_code_relation = '$product_code_buying'";

				$queryUpdateStock1 = mysqli_query($config, $updateStock1);
				$querySelectStock 	= mysqli_query($config, "SELECT * FROM tb_master_stock WHERE product_code_relation = '$product_code_buying' ");
				$rowSelectStock 	= mysqli_fetch_array($querySelectStock);
				$productCodeStock 	= $rowSelectStock['product_code_relation'];
				$remainingStock 	= $rowSelectStock['product_stock'];

				$updateStock2 = "
					INSERT INTO tb_stock_history(id_stock, product_code_relation, product_name, stock_entry, stock_out, remaining_stock, transaction_code, transaction_description, user_name, outlet_code_relation, ip_address, note, date_insert, time_insert, ts_insert, bl_state)
					VALUES ('".sha1(generate(20))."', '$product_code_buying', '$product_name_buying', '$qty_detail', '0', '$result_stock', '13', 'BUYING', '$sessionUser', '$system_outlet_code', '$ip_address', 'Stok Masuk Melalui Pembelian', '$transaction_date', '$transaction_time', '".date('Y-m-d H:i:s')."', 'A')";
				$queryUpdateStock2 = mysqli_query($config, $updateStock2);
					
				if (!$queryUpdateStock1) {
					echo"<script>toastr['error']('Error Query Update Stock');</script>";
				} else if (!$queryUpdateStock2) {
					echo"<script>toastr['error']('Error Query Update History Stock');</script>";
				} else {
					// echo"<script>toastr['success']('Berhasil update Stok');</script>";
				}
			}
			
			if ($updatePrice == '1') {

				$queryUpdatePrice = mysqli_query($config, "UPDATE tb_master_product 
	                SET buying_price = '$buying_price'
	                WHERE product_code = '$product_code_buying' AND outlet_code_relation = '$system_outlet_code' ");
			}
		}

	$insertTransactionDetail = "
			INSERT INTO tb_buying_transaction_detail(id_buying_transaction_detail, invoice_number_relation, product_code_relation, product_name, product_description, product_qty, unit_code_relation, unit_description, category_code_relation, category_description, id_transaction, transaction_description, buying_price, expire_date, user_name, outlet_code_relation, ts_insert, bl_state)

			SELECT '".sha1(generate(25))."', '$invoiceNumber', tb_buying_cart.product_code_relation, tb_buying_cart.product_name, tb_buying_cart.product_description, tb_buying_cart.buying_qty, tb_buying_cart.unit_code_relation, tb_buying_cart.unit_description, tb_buying_cart.category_code_relation, tb_buying_cart.category_description, '13', 'BUYING', tb_buying_cart.buying_price, tb_buying_cart.exp_date, '$sessionUser', '$system_outlet_code', '".date('Y-m-d H:i:s')."', 'A'
			
			FROM tb_buying_cart, tb_buying_transaction
			WHERE tb_buying_cart.user_name = '$sessionUser'
			AND tb_buying_cart.outlet_code_relation = '$system_outlet_code'
			AND tb_buying_transaction.invoice_number = '$invoiceNumber'";

	$queryInsertTransactionDetail = mysqli_query($config, $insertTransactionDetail);

	if ($queryInsertTransactionDetail) {
		$queryDelete = mysqli_query($config, "DELETE FROM tb_buying_cart 
								WHERE user_name = '$sessionUser'
								AND outlet_code_relation = '$system_outlet_code' ");			    
	    if ($queryDelete) {
	    	$queryLogInsert = mysqli_query($config, "INSERT INTO log_activity(id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
        		VALUES ( '".sha1(generate(10))."', '$currentDate $currentTime', 'CHECKOUT BUYING', 'Checkout Dengan Invoice ".$invoice_number."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')");
		 	?>	
				<script type="text/javascript">
					$(document).ready(function() {
           				LoadCartTransaction();
           				clearSupplier();
           				clearFormCart();
						swal("Transaksi Berhasil", "Transaksi Berhasil Dengan No. <?php echo $invoice_number; ?>", "success");
					});
				</script>
			<?php
	    }else{echo"<script>toastr['error']('Error Query Inert LOG');</script>";}
	}else{
		echo "<div class='alert alert-danger'>Error queryInsertTransactionDetail ! </div>";
	}
}
?>
<?php 
include("../../../config/config.php");

if (!empty($_SESSION['login'])) {

$total_harga_    	= mysqli_escape_string($config, $_POST['total_harga_']);
$total_item_     	= mysqli_escape_string($config, $_POST['total_item_']);
$customer_code   	= mysqli_escape_string($config, $_POST['customer_code']);
$customer_name   	= mysqli_escape_string($config, $_POST['customer_name']);
$dokter_code     	= mysqli_escape_string($config, $_POST['dokter_code']);
$dokter_name     	= mysqli_escape_string($config, $_POST['dokter_name']);
$transactionDate 	= mysqli_escape_string($config, $_POST['transactionDate']);
$transactionTime 	= mysqli_escape_string($config, $_POST['transactionTime']);
$cart_note       	= mysqli_escape_string($config, $_POST['cart_note']);

$payment_type 		= mysqli_escape_string($config, $_POST['payment_type']);
$nominal_cash 		= mysqli_escape_string($config, $_POST['nominal_cash']);
$nominal_debit 		= mysqli_escape_string($config, $_POST['nominal_debit']);
$name_card 			= mysqli_escape_string($config, $_POST['name_card']);
$card_number 		= mysqli_escape_string($config, $_POST['card_number']);
// $name_card_credit 	= mysqli_escape_string($config, $_POST['name_card_credit']);
// $card_number_credit = mysqli_escape_string($config, $_POST['card_number_credit']);
$nominal_credit 	= mysqli_escape_string($config, $_POST['nominal_credit']);
$refund 			= '';

if ($transactionDate == '') {
	$transaction_date = $currentDate;
}else{
	$transaction_date  = $transactionDate;
}

if ($transactionTime == '') {
	$transaction_time  = $currentTime;
}else{
	$transaction_time  = $transactionTime;
}

// QUERY INVOICE NUMBER 
$selectInvoiceNumber 		= "SELECT max(invoice_number) AS invoice_number FROM tb_selling_transaction";
$querySelectInvoiceNumber  	= mysqli_query($config, $selectInvoiceNumber);
$rowSelectInvoiceNumber		= mysqli_fetch_array($querySelectInvoiceNumber);
$invoice_number     		= $rowSelectInvoiceNumber['invoice_number'];
$resultInvoice_number   	= (int) substr($invoice_number, -4, 5);
$resultInvoice_number++;
$charInvoiceNumber = "sell-".date("ymd.");
$invoiceNumber = $charInvoiceNumber.sprintf("%05s", $resultInvoice_number);

// QUERY QUEUE NUMBER 
$selectQueueNumber 	= "SELECT max(queue_number) AS queue_number FROM tb_selling_transaction";
$queryQueueNumber 	= mysqli_query($config, $selectQueueNumber);
$rowQueueNumber		= mysqli_fetch_array($queryQueueNumber);
$queue_number 		= $rowQueueNumber['queue_number'];
$resultQueue_number = (int) substr($queue_number, -4, 5);
$resultQueue_number++;
$queueNumber = sprintf("%05s", $resultQueue_number);

$valuesTransaction 	= '';
$valuesPayment 		= '';
$valuesDetail		= '';

// Transaction With Cash Payment
if($payment_type == 'Tunai'){
	if ($total_harga_ > $nominal_cash) {
		echo "<script>
				toastr['error']('Uang Bayar Kurang!');
				$('#nominal_cash').focus();
				enableButtonCheckout();
			</script>";
	}else
	if (($total_harga_ < $nominal_cash) OR ($total_harga_ = $nominal_cash)){
		$refund = ($nominal_cash - $total_harga_);

    	// INSERT TRANSACTION
    	$valuesTransaction	= "(id_selling_transaction, invoice_number, queue_number, customer_code_relation, customer_description, dokter_code_relation, dokter_description, total_item, date_insert, time_insert, ts_insert, outlet_code_relation, user_code_relation, ip_address, note, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$queueNumber', '$customer_code', '$customer_name', '$dokter_code', '$dokter_name', '$total_item_', '$transaction_date', '$transaction_time', '$currentDate $currentTime', '$system_outlet_code', '$sessionUser', '$ip_address', '$cart_note', 'A')";

	// INSERT DETAIL
	$valuesDetail	= "(id_selling_transaction_detail, invoice_number_relation, product_code_relation, product_name, product_description, product_qty, unit_code_relation, unit_description, category_code_relation, category_description, 
		id_transaction, transaction_description, selling_price, user_code_relation, outlet_code_relation, ts_insert, bl_state)

		SELECT '".sha1(generate(20))."', '$invoiceNumber', tb_selling_cart.product_code_relation, tb_selling_cart.product_name, tb_selling_cart.product_description, tb_selling_cart.selling_qty, tb_selling_cart.unit_code_relation, tb_selling_cart.unit_description, tb_selling_cart.category_code_relation, tb_selling_cart.category_description, '12', 'SELLING', tb_selling_cart.selling_price, '$sessionUser', '$system_outlet_code', '$currentDate $currentTime', 'A'  

		FROM tb_selling_cart, tb_selling_transaction
		WHERE tb_selling_cart.user_name = '$sessionUser'
		AND tb_selling_cart.outlet_code_relation = '$system_outlet_code'
		AND tb_selling_transaction.invoice_number = '$invoiceNumber' ";

    	// INSERT PAYMENT
		$valuesPayment	= " (id_selling_payment, invoice_number_relation, type_of_payment, total_cash, total_paid, money_paid, refund, transaction_code, transaction_description, user_code_relation, ip_address, date_insert, time_insert, ts_insert, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$payment_type', '$nominal_cash', '$total_harga_', '$nominal_cash', '$refund', '12', 'SELLING', '$sessionUser', '$ip_address', '$transaction_date', '$transaction_time', '$currentDate $currentTime', 'A')";

    	$labelPayment = "Dengan Cara Bayar Tunai";
	}
}

// Transaction With DEBIT Payment
else if($payment_type == 'Debit'){
	if ($total_harga_ > $nominal_debit) {
		echo "<script>
				toastr['error']('Uang Bayar Kurang!');
				$('#nominal_debit').focus();
				enableButtonCheckout();
			</script>";
	}else
	if (($total_harga_ < $nominal_debit) OR ($total_harga_ = $nominal_debit)){
		$refund = ($nominal_debit - $total_harga_);

    	// INSERT TRANSACTION
    	$valuesTransaction	= "(id_selling_transaction, invoice_number, queue_number, customer_code_relation, customer_description, dokter_code_relation, dokter_description, total_item, date_insert, time_insert, ts_insert, outlet_code_relation, user_code_relation, ip_address, note, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$queueNumber', '$customer_code', '$customer_name', '$dokter_code', '$dokter_name', '$total_item_', '$transaction_date', '$transaction_time', '$currentDate $currentTime', '$system_outlet_code', '$sessionUser', '$ip_address', '$cart_note', 'A')";

    	// INSERT DETAIL
    	$valuesDetail	= "(id_selling_transaction_detail, invoice_number_relation, product_code_relation, product_name, product_description, product_qty, unit_code_relation, unit_description, category_code_relation, category_description, 
            id_transaction, transaction_description, selling_price, user_code_relation, outlet_code_relation, ts_insert, bl_state)

			SELECT '".sha1(generate(20))."', '$invoiceNumber', tb_selling_cart.product_code_relation, tb_selling_cart.product_name, tb_selling_cart.product_description, tb_selling_cart.selling_qty, tb_selling_cart.unit_code_relation, tb_selling_cart.unit_description, tb_selling_cart.category_code_relation, tb_selling_cart.category_description, '12', 'SELLING', tb_selling_cart.selling_price, '$sessionUser', '$system_outlet_code', '$currentDate $currentTime', 'A'  
			FROM tb_selling_cart, tb_selling_transaction
			WHERE tb_selling_cart.user_name = '$sessionUser'
			AND tb_selling_cart.outlet_code_relation = '$system_outlet_code'
			AND tb_selling_transaction.invoice_number = '$invoiceNumber' ";

    	// INSERT PAYMENT
		$valuesPayment	= " (id_selling_payment, invoice_number_relation, type_of_payment, total_debit, total_paid, money_paid, refund, card_number, card_holder_name, transaction_code, transaction_description, user_code_relation, ip_address, date_insert, time_insert, ts_insert, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$payment_type', '$nominal_debit', '$total_harga_', '$nominal_debit', '$refund', '$card_number', '$name_card', '12', 'SELLING', '$sessionUser', '$ip_address', '$transaction_date', '$transaction_time', '$currentDate $currentTime', 'A')";

    	$labelPayment = "Dengan Cara Bayar Debit";
	}
}

// Transaction With DEBIT Payment
else if($payment_type == 'Kredit'){
	if ($total_harga_ > $nominal_credit) {
		echo "<script>
				toastr['error']('Uang Bayar Kurang!');
				$('#nominal_credit').focus();
				enableButtonCheckout();
			</script>";
	}else
	if (($total_harga_ < $nominal_credit) OR ($total_harga_ = $nominal_credit)){
		$refund = ($nominal_credit - $total_harga_);

    	// INSERT TRANSACTION
    	$valuesTransaction	= "(id_selling_transaction, invoice_number, queue_number, customer_code_relation, customer_description, dokter_code_relation, dokter_description, total_item, date_insert, time_insert, ts_insert, outlet_code_relation, user_code_relation, ip_address, note, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$queueNumber', '$customer_code', '$customer_name', '$dokter_code', '$dokter_name', '$total_item_', '$transaction_date', '$transaction_time', '$currentDate $currentTime', '$system_outlet_code', '$sessionUser', '$ip_address', '$cart_note', 'A')";

    	// INSERT DETAIL
    	$valuesDetail	= "(id_selling_transaction_detail, invoice_number_relation, product_code_relation, product_name, product_description, product_qty, unit_code_relation, unit_description, category_code_relation, category_description, 
            id_transaction, transaction_description, selling_price, user_code_relation, outlet_code_relation, ts_insert, bl_state)

			SELECT '".sha1(generate(20))."', '$invoiceNumber', tb_selling_cart.product_code_relation, tb_selling_cart.product_name, tb_selling_cart.product_description, tb_selling_cart.selling_qty, tb_selling_cart.unit_code_relation, tb_selling_cart.unit_description, tb_selling_cart.category_code_relation, tb_selling_cart.category_description, '12', 'SELLING', tb_selling_cart.selling_price, '$sessionUser', '$system_outlet_code', '$currentDate $currentTime', 'A'  

			FROM tb_selling_cart, tb_selling_transaction
			WHERE tb_selling_cart.user_name = '$sessionUser'
			AND tb_selling_cart.outlet_code_relation = '$system_outlet_code'
			AND tb_selling_transaction.invoice_number = '$invoiceNumber' ";

    	// INSERT PAYMENT
		$valuesPayment	= " (id_selling_payment, invoice_number_relation, type_of_payment, total_credit, total_paid, money_paid, refund, card_number, card_holder_name, transaction_code, transaction_description, user_code_relation, ip_address, date_insert, time_insert, ts_insert, bl_state)
    		VALUES ('".sha1(generate(20))."', '$invoiceNumber', '$payment_type', '$nominal_credit', '$total_harga_', '$nominal_credit', '$refund', '$card_number', '$name_card', '12', 'SELLING', '$sessionUser', '$ip_address', '$transaction_date', '$transaction_time', '$currentDate $currentTime', 'A')";

    	$labelPayment = "Dengan Cara Bayar Kredit";
	}
}


if ($valuesTransaction != '' OR $valuesDetail != '' OR $valuesPayment != '') {

	$queryInsertTransaction = mysqli_query($config, "INSERT INTO tb_selling_transaction".$valuesTransaction);
	$queryinsertPayment = mysqli_query($config, "INSERT INTO tb_selling_payment".$valuesPayment);
	$queryinsertDetail = mysqli_query($config, "INSERT INTO tb_selling_transaction_detail".$valuesDetail);

	if ($queryInsertTransaction AND $queryinsertPayment AND $queryinsertDetail) {

	//CHECK PENGURANGAN STOK
	 $queryAdditionsStock =  mysqli_query($config, " 
	    SELECT tb_selling_cart.*, tb_master_stock.* 
	    FROM tb_selling_cart
	    INNER JOIN tb_master_stock 
	    ON tb_selling_cart.product_code_relation = tb_master_stock.product_code_relation
        WHERE tb_selling_cart.user_name = '$sessionUser' 
        AND tb_selling_cart.outlet_code_relation = '$system_outlet_code' ");

		// UPDATE Stok Di Tabel Stock
	   	while ($rowAdditionsStock = mysqli_fetch_array($queryAdditionsStock)){
	   		$product_code_selling 		= $rowAdditionsStock['product_code_relation'];
	   		$product_name_selling 		= $rowAdditionsStock['product_name'];
	   		$product_description_selling = $rowAdditionsStock['product_description'];
			$amount_qty1 		 		= $rowAdditionsStock['product_stock'];
			$qty_detail  		 		= $rowAdditionsStock['selling_qty']; 
			$stockable 	 		 		= $rowAdditionsStock['stockable'];
			$selling_price 	 	 		= $rowAdditionsStock['selling_price'];

			if ($stockable == 1) {
				$result_stock = $amount_qty1 - $qty_detail;
				$queryUpdateStock = mysqli_query($config, "UPDATE tb_master_stock
									SET product_stock = '$result_stock', ts_update = '$currentDate $currentTime'
									WHERE product_code_relation = '$product_code_selling'
									AND stockable = '1' ");

				$querySelectStock 	= mysqli_query($config, "SELECT * FROM tb_master_stock WHERE product_code_relation = '$product_code_selling' ");
				$rowSelectStock 	= mysqli_fetch_array($querySelectStock);
				$productCodeStock 	= $rowSelectStock['product_code_relation'];
				$remainingStock 	= $rowSelectStock['product_stock'];

			$queryUpdateStock2 = mysqli_query($config, "
				INSERT INTO tb_stock_history(id_stock, product_code_relation, product_name, stock_entry, stock_out, remaining_stock, transaction_code, transaction_description, user_name, outlet_code_relation, ip_address, note, date_insert, time_insert, ts_insert, bl_state)
			    VALUES ('".sha1(generate(20))."', '$product_code_selling', '$product_name_selling', '0', '$qty_detail', '$result_stock', '12', 'SELLING', '$sessionUser', '$system_outlet_code', '$ip_address', 'Stok Keluar Melalui Penjualan', '$transaction_date', '$transaction_time', '$currentDate $currentTime', 'A')");
			}
		}
		if ($queryUpdateStock) {
			$queryDelete = mysqli_query($config, "DELETE FROM tb_selling_cart 
							WHERE user_name = '$sessionUser'
							AND outlet_code_relation = '$system_outlet_code' ");

		    $queryLogInsert = mysqli_query($config, "INSERT INTO log_activity(
				            id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
				        VALUES ( '".sha1(generate(10))."', '$currentDate $currentTime', 'CHECKOUT SELLING', 'Checkout Dengan Invoice ".$invoiceNumber."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')");
								    
		    if ($queryDelete && $queryLogInsert) {
				echo "<script>
						toastr['success']('Transaksi Berhasil $labelPayment');
						enableButtonCheckout();
						closeFormCheckout();
						LoadCartTransaction();
						clearHeadForm();
					</script>";
			// 
			}
		}
	}
}else{

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
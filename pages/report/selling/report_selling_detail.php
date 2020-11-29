
<link rel="icon" href="<?php echo $base_url ?>assets/images/print.png">
<?php 
//   if (isset($_POST['excel'])) {
//     header("Content-type: application/vnd-ms-excel");
//     header("Content-Disposition: attachment; filename=Laporan_Penjualan_Detail-".$headerName.".xls");
//   }
  if (!empty($in_date_report) && !empty($out_date_report)) {
     
		 $queryReporView = "SELECT payment.*, detail.*, detail.invoice_number_relation as invoice		 					
							FROM tb_selling_transaction_detail as detail, tb_selling_payment as payment
							WHERE payment.invoice_number_relation = detail.invoice_number_relation
							AND payment.bl_state <> 'D'
							AND  (payment.ts_insert BETWEEN '$in_date_report $in_time_report' AND '$out_date_report $out_time_report')";

	    if (empty($casier_name)){
	      	$queryReporView2 = mysqli_query($config, $queryReporView." ORDER BY payment.invoice_number_relation ASC ");
	    }
	    elseif (empty($payment_type) AND !empty($casier_name)) {
	      $queryReporView2 = mysqli_query($config, $queryReporView."AND payment.user_code_relation = '$casier_name' ORDER BY payment.invoice_number_relation ASC");      
	    }
	    elseif (!empty($casier_name)) {
	      $queryReporView2 = mysqli_query($config, $queryReporView." AND payment.user_code_relation = '$casier_name' ORDER BY payment.invoice_number_relation ASC");      
	    }
	    elseif (empty($payment_type) OR empty($casier_name)) {
				 $queryReporView2 = mysqli_query($config, $queryReporView." ORDER BY payment.invoice_number_relation ASC");
		}	
    // var_dump($queryReporView);exit();
	}
?>

  <table class="table table-hover table-bordered report" border="1">
	<tr>
		<th width="8px">#</th>
		<th>No Transaksi</th>
		<th>Tgl Transaksi</th>
		<th>Nama Produk</th>
		<th>Qty</th>
    <th>Harga Satuan</th>
		<th>Subtotal</th>
		<th>Cara Bayar</th>
		<th>Kasir</th>
	</tr>
<?php
	$number = 0;
	$item_total = 0;
	$price_total = 0;
	while ($rowBuyingDetail = mysqli_fetch_array($queryReporView2)) {
	 $number = $number + 1 ;
   $invoice           = $rowBuyingDetail['invoice'];
   $date_transaction  = $rowBuyingDetail['date_insert']." ".$rowBuyingDetail['time_insert'];
   $poduct_name       = $rowBuyingDetail['product_name'];
   $product_qty       = $rowBuyingDetail['product_qty'];
   $selling_price     = $rowBuyingDetail['selling_price'];
   $type_of_payment   = $rowBuyingDetail['type_of_payment'];
   $user_code_relation         = $rowBuyingDetail['user_code_relation'];
   $subtotal          = $product_qty * $selling_price;
?>
  <tr>
  	<td><?php echo $number; ?></td>
    <td><?php echo $invoice ?></td>
    <td><?php echo $date_transaction ?></td>
  	<td><?php echo $poduct_name ?></td>
  	<td><?php echo $product_qty ?></td>
    <td><?php echo number_format($selling_price) ?></td>
  	<td><?php echo number_format($subtotal) ?></td>
  	<td><?php echo $type_of_payment ?></td>
  	<td><?php echo $user_code_relation ?></td>
  </tr>
  <?php 
  $item_total     = $item_total + $product_qty;
  $price_total    = $price_total + $subtotal;
}
?>
  <tr>
  	<td colspan="4" class="text-right">Total: </td>
    <td><?php echo number_format($item_total) ?></td>
  	<td></td>
  	<td><?php echo number_format($price_total) ?></td>
  	<td colspan="2"></td>
  </tr>
</table>


<script type="text/javascript">
  $('title').html('Laporan Penjualan Detail');
  $('.headerReport').html('Laporan Penjualan Detail');
  $('.headerPeriode').html('<?php echo $in_date_report ." s/d ". $out_date_report ?>');
</script>
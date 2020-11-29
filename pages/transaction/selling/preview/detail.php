<?php 
include('../../../../config/config.php'); 
$invoice_number = $_GET['invoice_number'];

  	$selectDetailHeader = " SELECT * FROM tb_selling_transaction 
  		WHERE outlet_code_relation = '$system_outlet_code' AND  invoice_number = '$invoice_number' ";

    $querySelectDetailHeader =  mysqli_query($config, $selectDetailHeader);
    while ($rowSelectHeader = mysqli_fetch_array($querySelectDetailHeader)){

		$invoice_number_hdr		 	= $rowSelectHeader['invoice_number'];
		$customer_code_hdr   		= $rowSelectHeader['customer_code_relation'];
		$customer_description_hdr   = $rowSelectHeader['customer_description'];
		$total_item_hdr     		= $rowSelectHeader['total_item'];
		$date_insert_hdr           	= $rowSelectHeader['date_insert'];
		$time_insert_hdr           	= $rowSelectHeader['time_insert'];
		$ts_insert_hdr             	= $rowSelectHeader['ts_insert'];
		$ts_update_hdr            	= $rowSelectHeader['ts_update'];
		$user_name            		= $rowSelectHeader['user_code_relation'];
   }
?>

<div class="panel panel-primary" id="detailTransaction">
	<div class="panel-heading">
		<h3 class="panel-title">
			Detail Transaksi <b>'<?php echo $invoice_number; ?>'</b>
			<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<table class="table table-hover">
		            <thead>
		              <tr>
		                <td width="150">No Transaksi</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $invoice_number_hdr ?></td>
		              </tr>
		              <tr>
		                <td width="150">Nama customer</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $customer_description_hdr." (".$customer_code_hdr.")" ?></td>
		              </tr>
		              <tr>
		                <td width="150">Petugas</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $user_name ?></td>
		              </tr>
		              <tr>
		                <td width="150">Tgl Transaksi</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php if($ts_update_hdr == ''){echo $date_insert_hdr." ".$time_insert_hdr;}else{echo $ts_update_hdr." [Batal]";} ?></td>
		              </tr>
		              <tr>
		                <td width="150">Tgl Input</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $ts_insert_hdr ?></td>
		              </tr>
		            </thead>
		        </table>
		    </div>
		    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    	<!-- <button class="btn btn-info" onclick="printContent('detailTransaction')"><span class="fa fa-print fa-3x"></span></button> -->
		    	<!-- <a href="<?php echo $base_url."" ?>" class="btn btn-info"><span class="fa fa-print fa-3x"></span></a> -->
		    	<!-- <a href="<?php echo $base_url."" ?>" class="btn btn-success"><span class="fa fa-file-excel-o fa-3x"></span></a> -->
		    </div>
			<table class="table table-hover table-striped table-bordered">
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>Kode Produk</th>
	                <th>Nama Produk</th>
	                <th>Qty</th>
	                <th>Harga</th>
	                <th>Subtotal</th>
	              </tr>
	            </thead>
              <?php 
              $selectDetailTransaction = " SELECT tb_selling_transaction.*, tb_selling_transaction_detail.*, tb_selling_payment.*, tb_selling_transaction.total_item AS total_item_, tb_selling_transaction.note AS catatan
					FROM tb_selling_transaction
					INNER JOIN tb_selling_transaction_detail ON tb_selling_transaction.invoice_number =  tb_selling_transaction_detail.invoice_number_relation AND tb_selling_transaction_detail.invoice_number_relation = '$invoice_number'
					INNER JOIN tb_selling_payment ON tb_selling_transaction.invoice_number = tb_selling_payment.invoice_number_relation 
					WHERE tb_selling_transaction.outlet_code_relation = '$system_outlet_code' 
					";

				// var_dump($selectDetailTransaction);exit();

                  $total_item_= 0;
                  $number = 0;
                  $total_cash = 0;
                  $type_of_payment = 0;
    			$querySelectDetailTransaction =  mysqli_query($config, $selectDetailTransaction);
              	while ($rowSelectDetailTransaction = mysqli_fetch_array($querySelectDetailTransaction)){
                   $number             		= $number + 1;
                   $invoice_number        	= $rowSelectDetailTransaction['invoice_number'];
                   $customer_code_relation  = $rowSelectDetailTransaction['customer_code_relation'];
                   $customer_description    = $rowSelectDetailTransaction['customer_description'];
                   $dokter_code_relation    = $rowSelectDetailTransaction['dokter_code_relation'];
                   $dokter_description    	= $rowSelectDetailTransaction['dokter_description'];
                   $total_item_        		= $rowSelectDetailTransaction['total_item_'];
                   $catatan        			= $rowSelectDetailTransaction['catatan'];
                   $product_code_relation   = $rowSelectDetailTransaction['product_code_relation'];
                   $product_name        	= $rowSelectDetailTransaction['product_name'];
                   $product_description     = $rowSelectDetailTransaction['product_description'];
                   $product_qty        		= $rowSelectDetailTransaction['product_qty'];
                   $selling_price        	= $rowSelectDetailTransaction['selling_price'];
                   $type_of_payment         = $rowSelectDetailTransaction['type_of_payment'];
                   $total_paid              = $rowSelectDetailTransaction['total_paid'];
                   $money_paid          	= $rowSelectDetailTransaction['money_paid'];
                   $total_cash        		= $rowSelectDetailTransaction['total_cash'];
                   $total_debit        		= $rowSelectDetailTransaction['total_debit'];
                   $total_credit			= $rowSelectDetailTransaction['total_credit'];
                   $refund					= $rowSelectDetailTransaction['refund'];
                   $subtotal            	= $selling_price * $product_qty;

                   if ($type_of_payment == 'Tunai') {
                   		$totalBayar = $total_cash;
                   }elseif ($type_of_payment == 'Debit') {
                   		$totalBayar = $total_debit;
                   }elseif ($type_of_payment == 'Kredit') {
                   		$totalBayar = $total_credit;
                   }

                ?>
                <tr>
                  <td><?php echo $number ?></td>
                  <td><?php echo $product_code_relation ?></td>
                  <td><?php echo $product_name ?></td>
                  <td><?php echo number_format($product_qty) ?></td>
                  <td>Rp. <?php echo number_format($selling_price) ?></td>
                  <td>Rp. <?php echo number_format($subtotal) ?></td>
                </tr> 
                <?php } ?>
                <tr>
                  <td class="text-right" colspan="5">Total Item:</td>
                  <td><?php echo number_format($total_item_) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="5">Total Tagihan:</td>
                  <td>Rp. <?php echo number_format($total_paid) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="5">Total Bayar:</td>
                  <td>Rp. <?php echo number_format($totalBayar) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="5">Uang Kembali :</td>
                  <td>Rp. <?php echo number_format($refund) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="5">Cara Bayar :</td>
                  <td><?php echo $type_of_payment; ?></td>
                </tr>
                <tr>
                  <td colspan="6">Catatan : <?php echo $catatan ?></td> 
                </tr>
			</table>
		</div>
	</div>
</div>

<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>
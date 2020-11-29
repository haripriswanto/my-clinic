<?php 
include('../../../../config/config.php'); 
$invoice_number = $_GET['invoice_number'];

  	$selectDetailHeader = " SELECT * 
  	FROM tb_buying_transaction 
  		WHERE outlet_code_relation = '$system_outlet_code' AND  invoice_number = '$invoice_number' ";

    $querySelectDetailHeader =  mysqli_query($config, $selectDetailHeader);
    while ($rowSelectHeader = mysqli_fetch_array($querySelectDetailHeader)){

		$invoice_number_hdr		 	= $rowSelectHeader['invoice_number'];
		$supplier_code_hdr   		= $rowSelectHeader['supplier_code_relation'];
		$supplier_description_hdr   = $rowSelectHeader['supplier_description'];
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
			Detail Transaksi</b>
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
		                <td width="150">Nama Supplier</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $supplier_description_hdr; if ($supplier_code_hdr != '') {" (".$supplier_code_hdr.")";} else{echo " -";} ?></td>
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
		              <!-- <tr>
		                <td width="150">Tgl Input</td>
		                <td width="20">:</td>
		                <td colspan="4"><?php echo $ts_insert_hdr ?></td>
		              </tr> -->
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
	                <th>Expire Date</th>
	                <th>Qty</th>
	                <th>Harga</th>
	                <th>Subtotal</th>
	              </tr>
	            </thead>
              <?php 
              $selectDetailTransaction = " SELECT tb_buying_transaction.invoice_number, tb_buying_transaction.supplier_description,tb_buying_transaction.total_item AS total_item_, tb_buying_transaction.note AS catatan, tb_buying_transaction_detail.product_code_relation, tb_buying_transaction_detail.product_name, tb_buying_transaction_detail.product_description, tb_buying_transaction_detail.product_qty, tb_buying_transaction_detail.buying_price, tb_buying_payment.type_of_payment, tb_buying_payment.total_paid, tb_buying_payment.money_paid, tb_buying_payment.nominal_cash, tb_buying_transaction_detail.expire_date AS expire
					FROM tb_buying_transaction
					INNER JOIN tb_buying_transaction_detail 
					ON tb_buying_transaction.invoice_number =  tb_buying_transaction_detail.invoice_number_relation AND tb_buying_transaction_detail.invoice_number_relation = '$invoice_number'
					INNER JOIN tb_buying_payment 
					ON tb_buying_transaction.invoice_number = tb_buying_payment.invoice_number_relation
					WHERE tb_buying_transaction.outlet_code_relation = '$system_outlet_code' 
					";

				// var_dump($selectDetailTransaction);exit();

                  $total_item_= 0;
                  $number = 0;
                  $nominal_cash = 0;
                  $type_of_payment = 0;
    			$querySelectDetailTransaction =  mysqli_query($config, $selectDetailTransaction);
              	while ($rowSelectDetailTransaction = mysqli_fetch_array($querySelectDetailTransaction)){
                   $number             		= $number + 1;
                   $invoice_number        	= $rowSelectDetailTransaction['invoice_number'];
                   $supplier_description    = $rowSelectDetailTransaction['supplier_description'];
                   $total_item_        		= $rowSelectDetailTransaction['total_item_'];
                   $catatan        			= $rowSelectDetailTransaction['catatan'];
                   $product_code_relation   = $rowSelectDetailTransaction['product_code_relation'];
                   $product_name        	= $rowSelectDetailTransaction['product_name'];
                   $product_description     = $rowSelectDetailTransaction['product_description'];
                   $product_qty        		= $rowSelectDetailTransaction['product_qty'];
                   $buying_price        	= $rowSelectDetailTransaction['buying_price'];
                   $type_of_payment         = $rowSelectDetailTransaction['type_of_payment'];
                   $total_paid              = $rowSelectDetailTransaction['total_paid'];
                   $money_paid          	= $rowSelectDetailTransaction['money_paid'];
                   $nominal_cash        	= $rowSelectDetailTransaction['nominal_cash'];
                   $expire_date        		= $rowSelectDetailTransaction['expire'];
                   $subtotal            	= $buying_price * $product_qty;

                ?>
                <tr>
                  <td><?php echo $number ?></td>
                  <td><?php echo $product_code_relation ?></td>
                  <td><?php echo $product_name ?></td>
                  <td><?php echo $expire_date ?></td>
                  <td><?php echo number_format($product_qty) ?></td>
                  <td>Rp. <?php echo number_format($buying_price) ?></td>
                  <td>Rp. <?php echo number_format($subtotal) ?></td>
                </tr> 
                <?php } ?>
                <tr>
                  <td class="text-right" colspan="6">Total Item:</td>
                  <td><?php echo number_format($total_item_) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="6">Total Bayar:</td>
                  <td>Rp. <?php echo number_format($nominal_cash) ?></td>
                </tr>
                <tr>
                  <td class="text-right" colspan="6">Cara Bayar :</td>
                  <td><?php echo $type_of_payment; ?></td>
                </tr>
                <tr>
                  <td colspan="7">Catatan : <?php echo $catatan ?></td> 
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
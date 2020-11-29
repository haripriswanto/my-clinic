<?php 
	include('../../../config/config.php');

if (!empty($_SESSION['login'])) {  

    $total_harga_    = mysqli_escape_string($config, $_GET['total_harga_']);
    $total_item_     = mysqli_escape_string($config, $_GET['total_item_']);
    $customer_code   = mysqli_escape_string($config, $_GET['customer_code']);
    $customer_name   = mysqli_escape_string($config, $_GET['customer_name']);
    $dokter_code     = mysqli_escape_string($config, $_GET['dokter_code']);
    $dokter_name     = mysqli_escape_string($config, $_GET['dokter_name']);
    $transactionDate = mysqli_escape_string($config, $_GET['transaction_date']);
    $transactionTime = mysqli_escape_string($config, $_GET['transaction_time']);
	$cart_note       = mysqli_escape_string($config, $_GET['cart_note']);

?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Konfirmasi Checkout</h3>
	</div>
	<div class="panel-body">
		<div class="panel panel-primary">
			<!-- <div class="panel-heading">
				<h3 class="panel-title">Konfirmasi Pembayaran!</h3>
			</div> -->
			<div class="panel-body text-center">	
			    <div class="row">
			        <div class="col-md-12">
					    <div class="row">
			    			<div class="col-md-12">
			    				<table class="table table-hover">
			    					<thead>
			    						<tr>
			    							<th width="130">Nama Pelanggan</th>
			    							<th width="20">:</th>
			    							<th><?php echo $customer_name ?></th>
			    						</tr>
			    						<tr>
			    							<th>Penanggung Jawab</th>
			    							<th>:</th>
			    							<th><?php echo $dokter_name ?></th>
			    						</tr>
			    						<tr>
			    							<th>Catatan</th>
			    							<th>:</th>
			    							<th><?php echo $cart_note ?></th>
			    						</tr>
			    					</thead>
			    				</table>
			    			</div>
			    		</div>
					    <div class="row">
			    			<div class="col-md-12">
			    				<legend></legend>
			    			</div>
			    		</div>
					    <div class="row">
			    			<div class="col-md-6 text-left">
								<font size="6">
				    				<h6><b>Uang Kembali:</b></h6>
			    					<b>Rp. <i id="resultTotalRefund"></i></b>
			    				</font>
							</div>
			    			<div class="col-md-6 text-right">
								<font size="6">
				    				<h6><b>Total Tagihan:</b></h6>
			    					<b>Rp. <i><?php echo number_format($total_harga_); ?></i></b>
			    					<input type="hidden" name="totalTagihan" id="totalTagihan" value="<?php echo $total_harga_ ?>">
			    				</font>
								<h6><b>Total Item	: </b> <?php echo $total_item_." (Item)" ?></h6>
							</div>
						</div>
		    		</div>
		    	</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6 pull-left">
				<label for="label">Cara Bayar</label>
				<select name="payment_type" id="payment_type" class="form-control">
					<option value="">Pilih Cara Bayar</option>
					<option value="Tunai">Tunai</option>
					<option value="Debit">Debit</option>
					<!-- <option value="Kredit">Kredit</option> -->
					<!-- <option value="combination">Kombinasi</option> -->
				</select>
			</div>
			<div class="form-group col-md-6"></div>
			<div class="form-group" id="showPayment">
			</div>
			<div class="form-group col-md-12">
				<legend></legend>
				<div class="col-md-7">
					<div class="form-group">					
						<span id="resultCartCheckout"></span>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-lg btn-primary" id="buttonCheckout"><span class="fa fa-save"> Simpan</span></button>
						<button type="submit" data-dismiss="modal" class="btn btn-lg btn-default" id="buttonCancelCheckout">Batal</button>
					</div>
				</div>
				<script type="text/javascript">
					var totalBayar = $('#totalTagihan').val();
					$('#uangPass').html(totalBayar);
				</script>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="total_harga_" id="total_harga_" value="<?php echo $total_harga_ ?>">
<input type="hidden" name="total_item_" id="total_item_" value="<?php echo $total_item_ ?>">
<input type="hidden" name="customer_code" id="customer_code" value="<?php echo $customer_code ?>">
<input type="hidden" name="customer_name" id="customer_name" value="<?php echo $customer_name ?>">
<input type="hidden" name="dokter_code" id="dokter_code" value="<?php echo $dokter_code ?>">
<input type="hidden" name="dokter_name" id="dokter_name" value="<?php echo $dokter_name ?>">
<input type="hidden" name="transactionDate" id="transactionDate" value="<?php echo $transactionDate ?>">
<input type="hidden" name="transactionTime" id="transactionTime" value="<?php echo $transactionTime ?>">
<input type="hidden" name="cart_note" id="cart_note" value="<?php echo $cart_note ?>">

<script type="text/javascript">

    var blank = "";
    var cash = `
    <div class='form-group pull-right col-md-5'>
    	<input type='text' onkeyup='numberOnly(this); sumTotalRefund(this); checkoutCash(this);' name='nominal_cash' id='nominal_cash' class='form-control' placeholder='Nominal Tunai'>
    </div`;

    var debit = `
    <div class='form-group pull-right col-md-6'>
    	<input type='text' class='form-control' name='name_card' id='name_card' placeholder='Nama Pemilik Kartu' title='Nama Pemilik Kartu Debit' onkeyup='checkoutDebit(this);'>
    </div> 
    <div class='clearfix'></div> 
	<div class='form-group pull-right col-md-6'>
		<input type='text' class='form-control' name='card_number' id='card_number' placeholder='No. Kartu Debit' title='Nomor Kartu Debit' onkeyup='checkoutDebit(this);'>
	</div>
	<div class='clearfix'></div> 
	<div class='form-group pull-right col-md-4'>
		<input type='text' onkeyup='numberOnly(this); sumTotalRefund(this); checkoutDebit(this);' class='form-control' name='nominal_debit' id='nominal_debit' placeholder='Nominal Debit (Rp.) ' title='Nominal Debit (Rp.)'>
	</div>`;

    // var credit = `
    // <div class='form-group pull-right col-md-6'>
    // 	<input type='text' class='form-control' name='name_card' id='name_card' placeholder='Nama Pemilik Kartu Kredit' title='Nama Pemilik Kartu Kredit'>
    // </div>
    // <div class='clearfix'></div> 
    // <div class='form-group pull-right col-md-6'>
    // 	<input type='text' class='form-control' name='card_number' id='card_number' placeholder='No. Kartu Kredit'  title='Nomor Kartu'>
    // </div> 
    // <div class='clearfix'></div> 
    // <div class='form-group pull-right col-md-4'>
    // 	<input type='text' onkeyup='numberOnly(this)' class='form-control' name='nominal_credit' id='nominal_credit' placeholder='Nominal Kredit (Rp.) ' title='Nominal Kredit'>
    // </div>`;

    // var combination = "<div class='form-group pull-right col-md-6'><input type='number' class='form-control' name='nominal_cash_combination' id='nominal_cash_combination' placeholder='Nominal Tunai (Rp.)' title='Nominal Tunai (Rp.)'></div><div class='clearfix'></div> <div class='form-group pull-right col-md-6'><input type='text' class='form-control' name='name_card_combination' id='name_card_combination' placeholder='Nama Pemilik Kartu' title='Nama Pemilik Kartu'></div><div class='clearfix'></div> <div class='form-group pull-right col-md-6'><input type='text' class='form-control' name='card_number_combination' id='card_number_combination' placeholder='No. Kartu' title='Nomor Kartu'></div> <div class='clearfix'></div> <div class='form-group pull-right col-md-4'><input type='text' onkeyup='numberOnly(this)' class='form-control' name='nominal_credit_combination' id='nominal_credit_combination' placeholder='Nominal Debit (Rp.)' title='Nominal Debit (Rp.)'></div>";

    $('#payment_type').change(function(event) {
    	var payment = $('#payment_type').val();

        if (payment == 'Tunai') {
			$('#resultTotalRefund').html('');
            document.getElementById("showPayment").innerHTML = cash;
			document.getElementById("nominal_cash").focus();
        }else if (payment=='Debit') {
			$('#resultTotalRefund').html('');
            document.getElementById("showPayment").innerHTML = debit;
            document.getElementById("name_card").focus();
        }
        // else if (payment=='Kredit') {
        //     document.getElementById("showPayment").innerHTML = credit;
        //     document.getElementById("name_card").focus();
        // }
        // else if (payment=='combination') {
        //     document.getElementById("showPayment").innerHTML = combination;
        //     document.getElementById("nominal_cash_combination").focus();
        // }
        else if (payment=='') {
            document.getElementById("showPayment").innerHTML = blank;
            document.getElementById("payment_type").focus();
        }
    });

	disableButtonCheckout();
	document.getElementById('buttonCheckout').disabled = true;

	function currency(nominal){
		var reverse = nominal.toString().split('').reverse().join(''),
		ribuan = reverse.match(/\d{1,3}/g);
		ribuan = ribuan.join(',').split('').reverse().join('');
		return ribuan;
	}
	
    function sumTotalRefund(){
		var total_harga_ 	= $('#total_harga_').val();
		var nominal_cash 	= $('#nominal_cash').val();
		var nominal_debit 	= $('#nominal_debit').val();
		var totalRefund 	= $('#resultTotalRefund').val();
		var resultRefund 	= parseInt(nominal_cash) - parseInt(total_harga_);

		if (parseInt(nominal_debit) < parseInt(total_harga_) || parseInt(nominal_cash) < parseInt(total_harga_)) {
			document.getElementById('buttonCheckout').disabled = true;
			console.log('kurang dari total '+nominal_cash, total_harga_, nominal_debit, );
		} else if (parseInt(nominal_debit) >= parseInt(total_harga_) || parseInt(nominal_cash) >= parseInt(total_harga_)) {
			if (!isNaN(resultRefund)) {
				if (resultRefund < 0) {
					document.getElementById('buttonCheckout').disabled = true;
					$('#resultTotalRefund').html('');
					// console.log('Gagal '+nominal_cash, total_harga_);
				} else {
					enableButtonCheckout();
					$('#resultTotalRefund').html('');
					$('#resultTotalRefund').html(currency(resultRefund));
				}
			}			
		} else if (parseInt(nominal_debit) === '' || parseInt(nominal_cash) === '') {
			$('#resultTotalRefund').html('');
		}
	}
	
	function checkoutCash() {
		$('#nominal_cash').on('keyup', function(e) {
			if (e.keyCode === 13) {
				$('#buttonCheckout').focus();
			}
		});
	}
	function checkoutDebit() {		
		$('#name_card').on('kekyup', function() {
			if (e.keyCode === 13) {
				$('#card_number').focus();
			}
		});
		$('#card_number').on('keyup', function(e) {
			if (e.keyCode === 13) {
				$('#nominal_debit').focus();
			}
		});
		$('#nominal_debit').on('keyup', function(e) {
			if (e.keyCode === 13) {
				$('#buttonCheckout').focus();
			}
		});
	}

	function checkoutTransaction(){
		disableButtonCheckout();
    	var total_harga_    = $('#total_harga_').val();
    	var total_item_     = $('#total_item_').val();
    	var customer_code   = $('#customer_code').val();
    	var customer_name   = $('#customer_name').val();
    	var dokter_code     = $('#dokter_code').val();
    	var dokter_name     = $('#dokter_name').val();
    	var transactionDate = $('#transactionDate').val();
    	var transactionTime = $('#transactionTime').val();
    	var cart_note       = $('#cart_note').val();

		var payment_type 		= $('#payment_type').val();
		var nominal_cash 		= $('#nominal_cash').val();
		var nominal_debit 		= $('#nominal_debit').val();
		var name_card 			= $('#name_card').val();
		var card_number 		= $('#card_number').val();
		// var name_card 	= $('#name_card').val();
		// var card_number 	= $('#card_number').val();
		var nominal_credit 		= $('#nominal_credit').val();

      if(total_harga_ != ""){
            // Progress Load
            disableButtonCheckout();
          $("#resultCartCheckout").html("<img src='<?php echo $base_url ?>assets/images/load.gif' width='25' height='25'/><font size='1' color='orange'>Sedang Proses...</font>");
            // Progress
            $.ajax({
                type:"post",
                url:"<?php echo $base_url."pages/transaction/selling/transactionCheckout.php"; ?>",
                data:'nominal_cash='+nominal_cash+'&name_card='+name_card+'&card_number='+card_number+'&nominal_debit='+nominal_debit+'&nominal_credit='+nominal_credit+'&total_harga_='+total_harga_+'&total_item_='+total_item_+'&customer_code='+customer_code+'&customer_name='+customer_name+'&dokter_code='+dokter_code+'&dokter_name='+dokter_name+'&transactionDate='+transactionDate+'&transactionTime='+transactionTime+'&cart_note='+cart_note+'&payment_type='+payment_type,
                success:function(data){
                  $("#resultCartCheckout").html(data);
                }
            });
          }
	}
	
    function goToPayment(){
    	var nominal_cash = $('#nominal_cash').val();

		if ($('#payment_type').val() == '') {
			toastr['error']('Pilih Jenis Pembayaran!');
			$('#payment_type').focus();
		}else{
			if ($('#payment_type').val() == 'Tunai') {
				if ($('#nominal_cash').val() == '') {
					toastr['error']('Jumlah Bayar Tidak Boleh Kosong!');
					$('#nominal_cash').focus();
				}else{
					checkoutTransaction();
				}
			}
			if ($('#payment_type').val() == 'Debit') {
				if ($('#name_card').val() == '') {
					toastr['error']('Nama Pemilik Kartu Tidak Boleh Kosong!');
					$('#name_card').focus();
				}else if ($('#card_number').val() == '') {
					toastr['error']('Nomor Kartu Tidak Boleh Kosong!');
					$('#card_number').focus();
				}else if ($('#nominal_debit').val() == '') {
					toastr['error']('Jumlah Bayar Tidak Boleh Kosong!');
					$('#nominal_debit').focus();
				}else{
					checkoutTransaction();
				}
			}
			if ($('#payment_type').val() == 'Kredit') {
				if ($('#name_card').val() == '') {
					toastr['error']('Nama Pemilik Kartu Tidak Boleh Kosong!');
					$('#name_card').focus();
				}else if ($('#card_number').val() == '') {
					toastr['error']('Nomor Kartu Tidak Boleh Kosong!');
					$('#card_number').focus();
				}else if ($('#nominal_credit').val() == '') {
					toastr['error']('Jumlah Bayar Tidak Boleh Kosong!');
					$('#nominal_credit').focus();
				}else{
					checkoutTransaction();
				}
			}
		}
    }

    function disableButtonCheckout () {
    	document.getElementById('buttonCheckout').disabled = true;
    	document.getElementById('payment_type').disabled = true;
    }

    function enableButtonCheckout () {
    	document.getElementById('buttonCheckout').disabled = false;
    	document.getElementById('payment_type').disabled = false;
    }

	$('#buttonCheckout').click(function(event) {
		goToPayment();
	});
	
</script>

<?php

	// Check Stok 
	$selectCheckStok = "SELECT tb_selling_cart.product_name as produk, tb_master_stock.*, tb_selling_cart.* 
		FROM tb_master_stock 
		INNER JOIN tb_selling_cart
		ON tb_master_stock.product_code_relation = tb_selling_cart.product_code_relation 
		WHERE 
		tb_master_stock.product_stock < tb_selling_cart.selling_qty AND
		tb_master_stock.stockable = '1' AND 
		tb_master_stock.bl_state = 'A' AND 
		tb_master_stock.bl_state = 'A' AND 
		tb_master_stock.outlet_code_relation = '$system_outlet_code' AND 
		tb_selling_cart.user_name = '$sessionUser' ";

	$querySelectCheckStok 		= mysqli_query($config, $selectCheckStok);
	$countRowSelectCheckStok 	= mysqli_num_rows($querySelectCheckStok);
	// var_dump($countRowSelectCheckStok);

	if ($countRowSelectCheckStok){
		while ($rowSelectCheckStok = mysqli_fetch_array($querySelectCheckStok)){
			$product_stock	= $rowSelectCheckStok['product_stock'];
			$produk			= $rowSelectCheckStok['produk'];
			$selling_qty    = $rowSelectCheckStok['selling_qty'];

			echo"<script>$('#resultCartCheckout').html('Jumlah item: <br> <b>- $produk ($selling_qty)</b> melebihi dari stok <b>($product_stock)</b><br> Silahkan kembali lalu ubah quantity.!');</script>";
		}
		echo"<script>disableButtonCheckout();$('#buttonCancelCheckout').focus();</script>";
	}
	else{
		echo"<script>enableButtonCheckout();$('#buttonCancelCheckout').focus();</script>";
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

<style>
	#resultCartCheckout{
		color : red;
	}
</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">STOK OPNAME</h1>
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title" id="headerForm">Stock Opname</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="">Kode</label>
				<input type="hidden" class="form-control" id="id_stock" name="id_stock">
				<input type="text" class="form-control" id="product_code" name="product_code">
			</div>	
			<div class="form-group">
				<label for="">Nama</label>
				<input type="text" class="form-control" id="product_name" name="product_name">
			</div>	
			<div class="form-group">
				<label for="">Jumlah stok</label>
				<input type="text" class="form-control" id="product_stock" name="product_stock">
			</div>	
			<button type="submit" class="btn btn-primary" id="buttonSave"><span class="fa fa-save"></span> Simpan</button>
			<button class="btn btn-default" id="buttonCancel">Batal</button>
			<span id="loadProgress"></span>
		</div>
	</div>
</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
	<div class="table-responsive">
		<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Data Produk
						<button class="refresh" id="buttonRefresh"><i class="fa fa-refresh"></i></button>
					</h3>
				</div>
				<div class="panel-body" id="loadStockOpname">
					<!-- Body -->
				</div>
	            <div class="panel-footer">
	            	<span class=" bg bg-danger">
		              	* Double Klik Pada Salah 1 Item Untuk Edit
		            </span>
	            </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  	var loadingImage = "<center><img src='assets/images/load.gif' width='50' height='50'/></center>";
  	var loadImage = "<img src='assets/images/load.gif' width='25' height='25'/>";

	function loadDataProduct(){
		clearForm();
		disableButton();
		buttonSimpan();
		$('#loadStockOpname').html(loadingImage);
		$('#loadStockOpname').load('<?php echo $base_url."pages/transaction/stock-opname/read.php"; ?>');
	}

	loadDataProduct();
	disableForm();

	$('#buttonRefresh').on('click', function(e) {
		loadDataProduct();
	});

	$('#product_stock').keyup(function(event) {
		if (event.keyCode == '13') {
	        if ($('#product_stock').val() == '') {
	          $.notify("Stock Tidak Boleh Kosong!", "error");
	          $('#product_stock').focus();
	        }else {$('#buttonSave').focus();}			
		}
	});

	function updateStock() {
		var id_stock 		=  $('#id_stock').val();
		var product_code 	=  $('#product_code').val();
		var product_name 	=  $('#product_name').val();
		var product_stock 	=  $('#product_stock').val();

		if (product_stock == '') {
      		$.notify("Stock Tidak Boleh Kosong!", "error");
      		$('#product_stock').focus();
		}else{
			disableForm(); 	
		 	$("#loadProgress").html(loadImage);
		      $.ajax({
		          type:"get",
		          url:"<?php echo $base_url."pages/transaction/stock-opname/update.php" ?>",
		          data:"id_stock="+id_stock+"&product_code="+product_code+"&product_name="+product_name+"&product_stock="+product_stock,
		          success:function(data){
		            $("#loadProgress").html(data);
		          }
		      }); 
		}
	}

	$('#buttonSave').click(function(event) {
		updateStock();
		// buttonSimpan();
	});

	$('#buttonCancel').click(function(event) {
		loadDataProduct();
	});
	
	function buttonSimpan() {
		$('#headerForm').html('Stock Opname');
		$('#buttonSave').html('<span class="fa fa-save"></span> Simpan');
	}

	function clearForm(){
		$('#id_stock').val('');
		$('#product_code').val('');
		$('#product_name').val('');
		$('#product_stock').val('');
	}

	function disableButton(){
		document.getElementById('buttonRefresh').disabled = true;		
	}
	function enableButton(){
		document.getElementById('buttonRefresh').disabled = false;		
	}

	// disabled
	function disableForm(){
		document.getElementById('id_stock').disabled = true;
		document.getElementById('product_code').disabled = true;
		document.getElementById('product_name').disabled = true;
		document.getElementById('product_stock').disabled = true;
		document.getElementById('buttonSave').disabled = true;
		document.getElementById('buttonCancel').disabled = true;
	}

	// disabled
	function enableForm(){
		document.getElementById('product_stock').disabled = false;
		document.getElementById('buttonSave').disabled = false;
		document.getElementById('buttonCancel').disabled = false;
	}
</script>

<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Stock Opname', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>
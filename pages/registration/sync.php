<?php 
  include('../../config/config.php'); 

if (!empty($_SESSION['login'])) {

$selectProduct = "SELECT * FROM tb_master_product WHERE bl_state ='A' AND outlet_code_relation = '$system_outlet_code' ";
$querySelectProduct = mysqli_query($config, $selectProduct);
$countRowProduct = mysqli_num_rows($querySelectProduct);

for ($i=0; $i < $countRowProduct ; $i++) {

	$rowProduct = mysqli_fetch_array($querySelectProduct);
	$id_product             = $rowProduct['id_product'];
	$product_code           = $rowProduct['product_code'];
	$product_name           = $rowProduct['product_name'];
	$product_description    = $rowProduct['product_description'];
	$buying_price           = $rowProduct['buying_price'];
	$selling_price          = $rowProduct['selling_price'];
	$price_min              = $rowProduct['price_min'];
	$price_max              = $rowProduct['price_max'];
	$price_margin           = $rowProduct['price_margin'];
	$category_code_relation = $rowProduct['category_code_relation'];
	$unit_code_relation     = $rowProduct['unit_code_relation'];
	$stockable              = $rowProduct['stockable'];
	$outlet_code_relation   = $rowProduct['outlet_code_relation'];
	$ts_insert              = $rowProduct['ts_insert'];
	$ts_update              = $rowProduct['ts_update'];
	$bl_state               = $rowProduct['bl_state'];

	$selectStok = "SELECT * FROM tb_master_stock WHERE product_code_relation = '$product_code'";
	$querySelectStock = mysqli_query($config, $selectStok);

	if (mysqli_num_rows($querySelectStock)) {
	  $insertData = "UPDATE tb_master_stock SET 
		  stockable = '$stockable', 
		  ts_update='".date('Y-m-d H:i:s')."' 
	  WHERE product_code_relation = '$product_code' ";
	} else {
	  $insertData = "INSERT INTO tb_master_stock(id_stock, product_code_relation, product_name_relation, product_stock, stockable, ts_insert, bl_state, outlet_code_relation)
	  VALUES ('".generate(15)."', '$product_code', '$product_name', 0, '$stockable', '".date('Y-m-d H:i:s')."', 'A', '$system_outlet_code'
		)";
	}

	$queryInsertData = mysqli_query($config, $insertData);
}
	// var_dump($UpdateData2);exit;
	if ($queryInsertData) {
	?>
		<script>
			$('#syncProgress').html('<i class="fa fa-toggle-on"></i> Sinkron');
			enabledHeaderButton();
			loadData();
			$.notify('Berhasil Sinkronisasi data Produk', 'success');
		</script>";
	<?php } 
	
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
<?php 

function productSelect() {
	$selectProduct = "SELECT * FROM tb_master_product";
	$querySelectProduct = mysqli_query($config, $selectProduct);

	return $querySelectProduct;
}
<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login'])) {

  $e_id_product            = mysqli_escape_string($config, $_GET['e_id_product']);
  $e_product_code          = mysqli_escape_string($config, $_GET['e_product_code']);
  $e_product_name          = mysqli_escape_string($config, $_GET['e_product_name']);
  $e_product_description   = mysqli_escape_string($config, $_GET['e_product_description']);
  $e_product_price_min     = mysqli_escape_string($config, $_GET['e_product_price_min']);
  $e_product_price_max     = mysqli_escape_string($config, $_GET['e_product_price_max']);
  $e_product_price_margin  = mysqli_escape_string($config, $_GET['e_product_price_margin']);
  $e_product_price_buy     = mysqli_escape_string($config, $_GET['e_product_price_buy']);
  $e_product_price_sell    = mysqli_escape_string($config, $_GET['e_product_price_sell']);
  $e_product_category      = mysqli_escape_string($config, $_GET['e_product_category']);
  $e_product_unit          = mysqli_escape_string($config, $_GET['e_product_unit']);
  $e_product_stockable     = mysqli_escape_string($config, $_GET['stockable']);

  echo "<script>enabledUpdateForm();</script>";

  if ($e_product_stockable == '') {
   $stockable = '0';
  }elseif ($e_product_stockable != '') {
    $stockable = '1';
  }

$UpdateData1 = "UPDATE tb_master_product
              SET product_code='$e_product_code', product_name='$e_product_name', product_description='$e_product_description', buying_price='$e_product_price_buy', selling_price='$e_product_price_sell', price_min='$e_product_price_min', price_max='$e_product_price_max', price_margin='$e_product_price_margin', category_code_relation='$e_product_category',stockable = '$stockable', unit_code_relation='$e_product_unit', outlet_code_relation='$system_outlet_code', ts_update='".date('Y-m-d H:i:s')."'
              WHERE id_product='$e_id_product' ";

$selectStok = "SELECT * FROM tb_master_stock WHERE product_code_relation = '$e_product_code'";
$querySelectStock = mysqli_query($config, $selectStok);
if (mysqli_num_rows($querySelectStock)) {
  $UpdateData2 = "UPDATE tb_master_stock SET stockable = '$stockable', ts_update='".date('Y-m-d H:i:s')."' WHERE product_code_relation = '$e_product_code' ";
} else {
  $UpdateData2 = "INSERT INTO tb_master_stock(
                    id_stock, product_code_relation, product_name_relation, stockable, ts_insert,  bl_state, outlet_code_relation)
                  VALUES ('".generate(15)."', '$e_product_code', '$e_product_name', '$stockable', '".date('Y-m-d H:i:s')."', 'A', '$system_outlet_code')
          ";
}
$queryUpdateData = mysqli_query($config, $UpdateData1);
$queryUpdateData = mysqli_query($config, $UpdateData2);
if ($queryUpdateData) {

    // log Activity
    $insertLogData = log_insert('UPDATE', 'Merubah Data Produk id: '.$e_id_product." Nama: ".$e_product_name.'', $ip_address, $os, $browser);
    $queryInsertLogData = mysqli_query($config, $insertLogData);
    
    if ($queryInsertLogData) {
      echo "<script>closeForm();loadData();toastr['success']('Berhasil Update Data ".$e_product_name."');</script>";
    }else{
      echo "Error Query Insert LOG";
    }
}else{
  echo "Error Query Update Data";
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
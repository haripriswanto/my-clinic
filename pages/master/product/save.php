<?php 
  include("../../../config/config.php");

  if (!empty($_SESSION['login'])) {

  $generateId              = mysqli_escape_string($config, generate(25));
  $auto_code               = mysqli_escape_string($config, $_POST['auto_code']);
  $i_product_code          = mysqli_escape_string($config, $_POST['i_product_code']);
  $i_product_name          = mysqli_escape_string($config, $_POST['i_product_name']);
  $i_product_description   = mysqli_escape_string($config, $_POST['i_product_description']);
  $i_product_price_min     = mysqli_escape_string($config, $_POST['i_product_price_min']);
  $i_product_price_max     = mysqli_escape_string($config, $_POST['i_product_price_max']);
  $i_product_price_margin  = mysqli_escape_string($config, $_POST['i_product_price_margin']);
  $i_product_price_buy     = mysqli_escape_string($config, $_POST['i_product_price_buy']);
  $i_product_price_sell    = mysqli_escape_string($config, $_POST['i_product_price_sell']);
  $i_product_first_stock   = mysqli_escape_string($config, $_POST['i_product_first_stock']);
  $i_product_category      = mysqli_escape_string($config, $_POST['i_product_category']);
  $i_product_unit          = mysqli_escape_string($config, $_POST['i_product_unit']);
  $i_product_stockable     = mysqli_escape_string($config, $_POST['stockable']);

  if ($auto_code == '') {
    $i_product_code = mysqli_escape_string($config, $_POST['i_product_code']);
  }elseif ($auto_code == 1) {
    $i_product_code = "prd.".date('ymd-').generate(4);
  }


  if ($i_product_stockable == '') {
   $stockable = '0';
  }elseif ($i_product_stockable != '') {
    $stockable = '1';
  }

$querySelectData =  mysqli_query($config, "SELECT * FROM tb_master_product WHERE bl_state = 'A' AND outlet_code_relation = '$system_outlet_code' AND product_code ='$i_product_code' ");
if (mysqli_num_rows($querySelectData)) {
  echo "<script>enabledInsertForm();toastr['error']('Kode Produk ".$i_product_code." Sudah Ada'); $('#i_product_code').focus();enabledInsertForm();</script>";
}
else{
  $insertData = "INSERT INTO tb_master_product(id_product, product_code, product_name, product_description, price_min, price_max, price_margin, buying_price, selling_price, category_code_relation, unit_code_relation, stockable, outlet_code_relation, ts_insert, bl_state)
    VALUES ('$generateId', '$i_product_code', '$i_product_name', '$i_product_description', '$i_product_price_min', '$i_product_price_max', '$i_product_price_margin', '$i_product_price_buy', '$i_product_price_sell', '$i_product_category', '$i_product_unit', '$stockable', '$system_outlet_code', '$currentDate $currentTime', 'A')";
  $queryInsertData = mysqli_query($config, $insertData);
	if ($queryInsertData) {

    if ($stockable == '1') {
      $insertDataStock = "INSERT INTO tb_master_stock(
                    id_stock, product_code_relation, product_name_relation, product_stock, stockable, ts_insert,  bl_state, outlet_code_relation)
          VALUES ('$generateId', '$i_product_code', '$i_product_name', '$i_product_first_stock', '$stockable', '$currentDate $currentTime', 'A', '$system_outlet_code')
          ";
      $queryinsertDataStock = mysqli_query($config, $insertDataStock);
    }

      // insert Log Activity
      $insertLogData = log_insert('INSERT', 'Menambahkan Data Produk id: '.$generateId." Nama: ".$i_product_name.'', $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);

      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Insert Data Produk ".$i_product_name."';clearInsertForm();loadData();closeForm();</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
	}else{
    echo "Gagal Insert Data";
  }
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
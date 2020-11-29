<?php 
  include("../../../config/config.php");

  if (!empty($_SESSION['login']['user_name'])) {

  $generateId        = mysqli_escape_string($config, generate(15));
  $auto_number       = mysqli_escape_string($config, $_GET['auto_number']);
  $supplier_name     = mysqli_escape_string($config, $_GET['supplier_name']);
  $supplier_type     = mysqli_escape_string($config, $_GET['supplier_type']);
  $supplier_website  = mysqli_escape_string($config, $_GET['supplier_website']);
  $supplier_email    = mysqli_escape_string($config, $_GET['supplier_email']);
  $supplier_phone    = mysqli_escape_string($config, $_GET['supplier_phone']);
  $supplier_address  = mysqli_escape_string($config, $_GET['supplier_address']);

  if ($auto_number == 1) {
    $supplier_code = "sup.".date('ymd-').generate(4);
  }elseif ($auto_number == 0) {
    $supplier_code     = mysqli_escape_string($config, $_GET['supplier_code']);
  }

  // echo $auto_number." <br> ". $supplier_code;exit;

$insertSUpplier = "INSERT INTO tb_master_supplier(
            id_supplier, supplier_code, supplier_type, supplier_name, supplier_address, 
            supplier_email, supplier_phone, website, ts_insert, 
            bl_state, outlet_code_relation)
    VALUES ('$generateId', '$supplier_code', '$supplier_type', '$supplier_name', '$supplier_address', '$supplier_email', '$supplier_phone', '$supplier_website', '$currentDate $currentTime', 'A', '$system_outlet_code');

    ";
    
$queryInsertSUpplier = mysqli_query($config, $insertSUpplier);

	if ($queryInsertSUpplier) {

    // log Activity
    $insertLogData = log_insert('INSERT', 'Menambahkan Data Supplier id: '.$generateId." Nama: ".$supplier_name.'', $ip_address, $os, $browser);
    $queryInsertLogData = mysqli_query($config, $insertLogData);
  
    if ($queryInsertLogData) {
      echo "<script>toastr['success']('Berhasil Insert Data Supplier ".$supplier_name."', 'success');clearInsertForm();loadData();closeForm();</script>";
    }else{
      echo "Gagal Insert Log Activity";
    }
	}else{
    echo "Gagal Insert Supplier";
  }
?>


<?php
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
<?php 
  include("../../../config/config.php");

  $generateId        = sha1($generateID);
  $supplier_name     = $_GET['supplier_name'];
  $supplier_type     = $_GET['supplier_type'];
  $supplier_website  = $_GET['supplier_website'];
  $supplier_email    = $_GET['supplier_email'];
  $supplier_phone    = $_GET['supplier_phone'];
  $supplier_address  = $_GET['supplier_address'];

  if (isset($_GET['auto_number'])) {
    $auto_number       = $_GET['auto_number'];
  }elseif (!isset($_GET['auto_number'])) {
    $auto_number       = 0;
  }

  if ($auto_number == 1) {
    $supplier_code = "sup.".date('ymd-').$generateCode;
  }elseif ($auto_number == 0) {
    $supplier_code     = $_GET['supplier_code'];
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
	 // ************** QUERY log_activity
	    $insertLogActivity = "INSERT INTO log_activity(
          id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
              VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'INSERT', 'Menambahkan Data Supplier ".$supplier_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";

	    $queryInsertLogActivity = mysqli_query($config, $insertLogActivity);
      if ($queryInsertLogActivity) {
        echo "<script>$.notify('Berhasil Insert Data Supplier ".$supplier_name."', 'success');clearInsertForm();loadData();closeForm();</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
	}else{
    echo "Gagal Insert Supplier";
  }
?>
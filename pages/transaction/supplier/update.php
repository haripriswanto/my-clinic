<?php 
  include('../../../config/config.php'); 

  $e_id_supplier       = $_GET['e_id_supplier'];
  $e_supplier_name     = $_GET['e_supplier_name'];
  $e_supplier_code     = $_GET['e_supplier_code'];
  $e_supplier_type     = $_GET['e_supplier_type'];
  $e_supplier_website  = $_GET['e_supplier_website'];
  $e_supplier_email    = $_GET['e_supplier_email'];
  $e_supplier_phone    = $_GET['e_supplier_phone'];
  $e_supplier_address  = $_GET['e_supplier_address'];


$queryUpdateData = mysqli_query($config, "UPDATE tb_master_supplier
                 SET supplier_code = '$e_supplier_code', supplier_type = '$e_supplier_type', supplier_name = '$e_supplier_name', supplier_address = '$e_supplier_address', supplier_email = '$e_supplier_email', supplier_phone = '$e_supplier_phone', website = '$e_supplier_website', ts_update = '$currentDate $currentTime'
               WHERE id_supplier = '$e_id_supplier';
");
  
if ($queryUpdateData) {

    $insertLogData = "INSERT INTO log_activity(
                id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
                VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'UPDATE', 'Merubah Data Supplier ".$e_supplier_name."' , 'A', '$ip_address', '$sessionUser', '$os', 'browser')";
    $queryInsertLogData = mysqli_query($config, $insertLogData);
    if ($queryInsertLogData) {
      echo "<script>loadData();closeForm();$.notify('Berhasil Update Data ".$e_supplier_name."', 'success');</script>";
    }else{
      echo "Error Query Insert LOG";
    }
}else{
  echo "Error Query Update Data";
}

?>
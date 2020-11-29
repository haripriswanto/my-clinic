<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {

  $e_id_supplier       = mysqli_escape_string($config, $_GET['e_id_supplier']);
  $e_supplier_name     = mysqli_escape_string($config, $_GET['e_supplier_name']);
  $e_supplier_code     = mysqli_escape_string($config, $_GET['e_supplier_code']);
  $e_supplier_type     = mysqli_escape_string($config, $_GET['e_supplier_type']);
  $e_supplier_website  = mysqli_escape_string($config, $_GET['e_supplier_website']);
  $e_supplier_email    = mysqli_escape_string($config, $_GET['e_supplier_email']);
  $e_supplier_phone    = mysqli_escape_string($config, $_GET['e_supplier_phone']);
  $e_supplier_address  = mysqli_escape_string($config, $_GET['e_supplier_address']);


$queryUpdateData = mysqli_query($config, "UPDATE tb_master_supplier
                 SET supplier_code = '$e_supplier_code', supplier_type = '$e_supplier_type', supplier_name = '$e_supplier_name', supplier_address = '$e_supplier_address', supplier_email = '$e_supplier_email', supplier_phone = '$e_supplier_phone', website = '$e_supplier_website', ts_update = '$currentDate $currentTime'
               WHERE id_supplier = '$e_id_supplier';
");
  
if ($queryUpdateData) {
  
    // log Activity
    $insertLogData = log_insert('UPDATE', 'Merubah Data Supplier id: '.$e_id_supplier." Nama: ".$e_supplier_name.'', $ip_address, $os, $browser);
    $queryInsertLogData = mysqli_query($config, $insertLogData);
    if ($queryInsertLogData) {
      echo "<script>closeForm();loadData();toastr['success']('Berhasil Update Data ".$e_supplier_name."', 'success');</script>";
    }else{
      echo "Error Query Insert LOG";
    }
}else{
  echo "Error Query Update Data";
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
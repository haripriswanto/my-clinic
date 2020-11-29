<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {

  $idCustomer           = mysqli_escape_string($config, $_GET['idCustomer']);
  $editAutoNumber       = mysqli_escape_string($config, $_GET['editAutoNumber']);
  $editCustomerCode     = mysqli_escape_string($config, $_GET['editCustomerCode']);
  $editCustomerName     = mysqli_escape_string($config, $_GET['editCustomerName']);
  $editCustomerGender   = mysqli_escape_string($config, $_GET['editCustomerGender']);
  $editCustomerBirthday = mysqli_escape_string($config, date('Y-m-d', strtotime($_GET['editCustomerBirthday'])));
  $editCustomerEmail    = mysqli_escape_string($config, $_GET['editCustomerEmail']);
  $editCustomerPhone    = mysqli_escape_string($config, $_GET['editCustomerPhone']);
  $editCustomerAddress  = mysqli_escape_string($config, $_GET['editCustomerAddress']);

  $queryUpdateData = mysqli_query($config, "UPDATE tb_customer
    SET customer_code = '$editCustomerCode', full_name = '$editCustomerName', phone = '$editCustomerPhone', address = '$editCustomerAddress', email = '$editCustomerEmail', gender = '$editCustomerGender', birthday = '$editCustomerBirthday', outlet_code_relation = '$system_outlet_code', ts_update = '$currentDate $currentTime'
  WHERE id_customer = '$idCustomer' ");
    
  if ($queryUpdateData) {
      
      // insert Log Activity
      $insertLogData = log_insert('UPDATE', 'Merubah Data Customer id: '.$idCustomer." Nama: ".$editCustomerName.'', $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);

      if ($queryInsertLogData) {
        echo "<script>loadDataCustomer();closeForm();toastr['success']('Berhasil Update Data ".$editCustomerName."', 'success');</script>";
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
<?php 
  include("../../../config/config.php");

  if (!empty($_SESSION['login']['user_name'])) {

  $generateId        = generate(15);
  $customer_name     = mysqli_escape_string($config, $_GET['customer_name']);
  $customer_gender   = mysqli_escape_string($config, $_GET['customer_gender']);
  $customer_birthday = mysqli_escape_string($config, date('Y-m-d', strtotime($_GET['customer_birthday'])));
  $customer_email    = mysqli_escape_string($config, $_GET['customer_email']);
  $customer_phone    = mysqli_escape_string($config, $_GET['customer_phone']);
  $customer_address  = mysqli_escape_string($config, $_GET['customer_address']);

  if (isset($_GET['auto_number'])) {
    $auto_number       = $_GET['auto_number'];
  }elseif (!isset($_GET['auto_number'])) {
    $auto_number       = 0;
  }

  if ($auto_number == 1) {
    $customer_code = "Cst.".date('ymd-').generate(4);
  }elseif ($auto_number == 0) {
    $customer_code     = $_GET['customer_code'];
  }
echo "<script>enableFormInsert();</script>";
  // echo $customer_birthday; exit;

$insertCustomer = "INSERT INTO tb_customer(id_customer, customer_code, full_name, phone, address, email, gender, birthday, outlet_code_relation, ts_insert, bl_state)
    VALUES ('$generateId', '$customer_code', '$customer_name', '$customer_phone', '$customer_address', '$customer_email', '$customer_gender', '$customer_birthday', '$system_outlet_code', '$currentDate $currentTime', 'A')
    ";
// var_dump($insertCustomer);exit();

$queryInsertCustomer = mysqli_query($config, $insertCustomer);

	if ($queryInsertCustomer) {
    
    // insert Log Activity
    $insertLogData = log_insert('INSERT', 'Menambahkan Data Customer id: '.$generateId." Nama: ".$customer_name.'', $ip_address, $os, $browser);
    $queryInsertLogData = mysqli_query($config, $insertLogData);

    if ($queryInsertLogData) {
      echo "<script>toastr['success']('Berhasil Insert Data Customer ".$customer_name."', 'success');clearInsertForm();loadDataCustomer();closeForm();</script>";
    }else{
      echo "Gagal Insert Log Activity";
    }
	}else{
    echo "Gagal Insert Customer";
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
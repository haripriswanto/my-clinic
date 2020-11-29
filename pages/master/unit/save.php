<?php 
  include("../../../config/config.php");

  if (!empty($_SESSION['login']['user_name'])) {

  $unit_code = "unit.".date('ymd-').generate(4); 
  $generateId   = mysqli_escape_string($config, generate(15));
  $unit_description   = mysqli_escape_string($config, $_GET['insertUnitDescription']);

$querySelectData = mysqli_query($config, "SELECT * FROM tb_master_unit WHERE unit_description ='$unit_description' ");
$checkSelectData = mysqli_num_rows($querySelectData);

if ($checkSelectData) {
  echo "<script>toastr['error']('Satuan ".$unit_description." Sudah Ada!');enableForm();clearForm();</script>";
}else{

  $insertData = "INSERT INTO tb_master_unit(
              id_unit, unit_code, unit_description, bl_state, outlet_code_relation)
        VALUES ('$generateId', '$unit_code', '$unit_description', 'A', '$system_outlet_code')
      ";
  $queryInsertData = mysqli_query($config, $insertData);
  	if ($queryInsertData) {
      // log Activity
      $insertLogData = log_insert('INSERT', 'Menambahkan Data Satuan id: '.$generateId.' Deskripsi: '.$unit_description, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Insert Data Satuan ".$unit_description."', 'success');closeForm();loadData();</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
  	}else{
      echo "Gagal Insert Data";
    }
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
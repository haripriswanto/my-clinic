<?php 
  include("../../../config/config.php");

  if (!empty($_SESSION['login']['user_name'])) {

  $generateId        = mysqli_escape_string($config, generate(15));
  $i_dokter_code     = mysqli_escape_string($config, "dok.".date('ymd-').$generateCode);
  $i_dokter_name     = mysqli_escape_string($config, $_GET['i_dokter_name']);
  $i_dokter_type     = mysqli_escape_string($config, $_GET['i_dokter_type']);
  $i_dokter_email    = mysqli_escape_string($config, $_GET['i_dokter_email']);
  $i_dokter_phone    = mysqli_escape_string($config, $_GET['i_dokter_phone']);
  $i_dokter_address  = mysqli_escape_string($config, $_GET['i_dokter_address']);

$insertData = "INSERT INTO tb_master_dokter(
            id_dokter, dokter_code, dokter_type, dokter_name, dokter_address, dokter_email, dokter_phone, ts_insert, bl_state, outlet_code_relation)
    VALUES ('$generateId', '$i_dokter_code', '$i_dokter_type', '$i_dokter_name', '$i_dokter_address', '$i_dokter_email', '$i_dokter_phone', '$currentDate $currentTime', 'A', '$system_outlet_code')

    ";
    
$queryInsertData = mysqli_query($config, $insertData);

	if ($queryInsertData) {

      // insert Log Activity
      $insertLogData = log_insert('INSERT', 'Menambahkan Data Dokter Id: '.$generateId.' Nama: '.$i_dokter_name, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      
      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Insert Data Dokter ".$i_dokter_name."');clearInsertForm();loadData();closeForm();</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
	}else{
    echo "Gagal Insert Data";
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
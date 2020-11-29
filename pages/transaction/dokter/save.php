<?php 
  include("../../../config/config.php");

  $generateId        = mysqli_escape_string($config, sha1($generateID));
  $i_dokter_code     = mysqli_escape_string($config, "dok.".date('ymd-').$generateCode);
  $i_dokter_name     = mysqli_escape_string($config, $_GET['i_dokter_name']);
  $i_dokter_type     = mysqli_escape_string($config, $_GET['i_dokter_type']);
  $i_dokter_email    = mysqli_escape_string($config, $_GET['i_dokter_email']);
  $i_dokter_phone    = mysqli_escape_string($config, $_GET['i_dokter_phone']);
  $i_dokter_address  = mysqli_escape_string($config, $_GET['i_dokter_address']);

echo "<script>
  document.getElementById('buttonInsertDokter').disabled = false;
  document.getElementById('buttonCancelDokter').disabled = false;
  document.getElementById('buttonCloseDokter').disabled = false;
</script>";

$insertData = "INSERT INTO tb_master_dokter(
            id_dokter, dokter_code, dokter_type, dokter_name, dokter_address, dokter_email, dokter_phone, ts_insert, bl_state, outlet_code_relation)
    VALUES ('$generateId', '$i_dokter_code', '$i_dokter_type', '$i_dokter_name', '$i_dokter_address', '$i_dokter_email', '$i_dokter_phone', '$currentDate $currentTime', 'A', '$system_outlet_code')";

// var_dump($insertData);exit();
$queryInsertData = mysqli_query($config, $insertData);

	if ($queryInsertData) {
	 // ************** QUERY log_activity
	    $insertLogActivity = "INSERT INTO log_activity(
          id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
              VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'INSERT', 'Menambahkan Data Dokter ".$i_dokter_name."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";

	    $queryInsertLogActivity = mysqli_query($config, $insertLogActivity);
      if ($queryInsertLogActivity) {
        echo "<script>$.notify('Berhasil Insert Data Dokter ".$i_dokter_name."', 'success');closeDokterForm();$('#listDokter').modal('show');</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
	}else{
    echo "Gagal Insert Data";
  }
?>
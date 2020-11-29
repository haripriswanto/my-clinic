<?php 
  include("../../../config/config.php");
  
  $generateId              = mysqli_escape_string($config, sha1($generateID));
  $htu_code                = mysqli_escape_string($config, "htu-".date('YmdHis.').$generateCod);
  $i_htu_description       = mysqli_escape_string($config, $_GET['i_htu_description']);
  $i_htu_type              = mysqli_escape_string($config, $_GET['i_htu_type']);

  var_dump($generateId, $htu_code, $i_htu_description, $i_htu_type);exit();

$querySelectData =  mysqli_query($config, "SELECT * FROM tb_master_htu
                              WHERE htu_description = '$i_htu_description' AND bl_state = 'A' ");

if (mysqli_num_rows($querySelectData)) {
  echo "<script>enabledInsertForm();$.notify('Cara Pakai ".$i_htu_description." Sudah Ada', 'error'); $('#i_htu_description').focus();</script>";
}
else{
  $insertData = "INSERT INTO tb_master_htu(
            id_htu, htu_code, htu_description, htu_type, ts_insert, bl_state)
    VALUES ('$generateId', '$htu_code', '$i_htu_description', '$i_htu_type', '$currentDate $currentTime', 'A', 
            '$')
      ";
  $queryInsertData = mysqli_query($config, $insertData);
	if ($queryInsertData) {
    // ************** QUERY log_activity
    $insertLogActivity = "INSERT INTO log_activity(
        id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
            VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'INSERT', 'Menambahkan Data Cara Pakai ".$i_htu_type."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
    $queryInsertLogActivity = mysqli_query($config, $insertLogActivity);
    if ($queryInsertLogActivity) {
      echo "<script>$.notify('Berhasil Insert Data Cara Pakai ".$i_htu_type."', 'success');enabledInsertForm();clearInsertForm();closeForm();</script>";
    }else{
      echo "Gagal Insert Log Activity";
    }
	}else{
    echo "Gagal Insert Data";
  }
}
?>
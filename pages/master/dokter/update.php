<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {

  $e_id_dokter       = mysqli_escape_string($config, $_GET['e_id_dokter']);
  $e_dokter_name     = mysqli_escape_string($config, $_GET['e_dokter_name']);
  $e_dokter_type     = mysqli_escape_string($config, $_GET['e_dokter_type']);
  $e_dokter_email    = mysqli_escape_string($config, $_GET['e_dokter_email']);
  $e_dokter_phone    = mysqli_escape_string($config, $_GET['e_dokter_phone']);
  $e_dokter_address  = mysqli_escape_string($config, $_GET['e_dokter_address']);

  $UpdateData = "UPDATE tb_master_dokter
                  SET dokter_type = '$e_dokter_type', dokter_name = '$e_dokter_name', dokter_address = '$e_dokter_address', dokter_email = '$e_dokter_email', dokter_phone = '$e_dokter_phone', ts_update = '$currentDate $currentTime'
                WHERE id_dokter = '$e_id_dokter' AND outlet_code_relation = '$system_outlet_code'
                ";
  // var_dump($UpdateData);exit();
  $queryUpdateData = mysqli_query($config, $UpdateData);
    
  if ($queryUpdateData) {

      // insert Log UPDATE
      $insertLogData = log_insert('UPDATE', 'Merubah Data Dokter Id: '.$generateId.' Nama: '.$i_dokter_name, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>loadData();closeForm();toastr['success']('Berhasil Update Data ".$e_dokter_name."');</script>";
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
<?php 
	include('../../../config/config.php'); 
  
  if (!empty($_SESSION['login']['user_name'])) {

  $idDelete          = $_GET['idDelete'];
  $unit_description  = $_GET['unit_description'];

  $queryDeleteData = mysqli_query($config, "DELETE FROM tb_master_unit WHERE id_unit = '$idDelete' ");
  if ($queryDeleteData) {
      // log Activity
      $insertLogData = log_insert('DELETE', 'Menghapus Data Satuan id: '.$idDelete.' Deskripsi: '.$unit_description, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>closeForm();loadData();toastr['success']('Berhasil Hapus Data ".$unit_description."', 'success')</script>";
      }else{
        echo "Error Query Insert Log";
      }
  }else{
    echo "Error Query Delete Data";
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
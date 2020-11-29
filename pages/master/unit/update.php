<?php 
  include('../../../config/config.php'); 

  if (!empty($_SESSION['login']['user_name'])) {

  $idEdit               = mysqli_escape_string($config, $_GET['idEdit']);
  $editUnitDescription  = mysqli_escape_string($config, $_GET['editUnitDescription']);

  $queryUpdateData = mysqli_query($config, "UPDATE tb_master_unit 
                                SET unit_description = '$editUnitDescription'
                                WHERE id_unit = '$idEdit' 
                                ");
  if ($queryUpdateData) {
      // log Activity
      $insertLogData = log_insert('UPDATE', 'Merubah Data Satuan id: '.$idEdit.' Deskripsi: '.$editUnitDescription, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Update Data ".$editUnitDescription."', 'success');closeForm();loadData();</script>";
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
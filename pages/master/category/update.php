<?php 
  include('../../../config/config.php');
  
  if (!empty($_SESSION['login'])) { 

  $idCategory               = mysqli_escape_string($config, $_GET['idCategory']);
  $editCategoryDescription  = mysqli_escape_string($config, $_GET['editCategoryDescription']);

  $queryUpdateData = mysqli_query($config, "UPDATE tb_master_category 
                              SET category_description = '$editCategoryDescription'
                              WHERE id_category = '$idCategory' 
                              ");
  if ($queryUpdateData) {
      // log Activity
      $insertLogData = log_insert('UPDATE', 'Merubah Data Kategori id: '.$idCategory.' Deskripsi: '.$editCategoryDescription, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Update Data ".$editCategoryDescription."');closeForm();loadData();</script>";
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
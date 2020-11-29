<?php 
  include('../../../config/config.php'); 
  
if (!empty($_SESSION['login']['user_name'])) {

  $id_delete                  = $_GET['id_delete'];
  $deleteCategoryDescription  = $_GET['deleteCategoryDescription'];

  $queryDeleteData = mysqli_query($config, "DELETE FROM tb_master_category WHERE id_category = '$id_delete' ");

  if ($queryDeleteData) {
      // log Activity
      $insertLogData = log_insert('DELETE', 'Menghapus Data Kategori id: '.$id_delete.' Deskripsi: '.$deleteCategoryDescription, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>closeForm();loadData();toastr['success']('Berhasil Hapus Data ".$deleteCategoryDescription."')</script>";
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
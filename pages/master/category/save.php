<?php 
  include("../../../config/config.php");
  
if (!empty($_SESSION['login'])) {

  $category_code = "ctg.".date('ymd-').generate(4);
  $generateId   = mysqli_escape_string($config, generate(15));
  $category_description   = mysqli_escape_string($config, $_GET['insertCategoryDescription']);

$querySelectData = mysqli_query($config, "SELECT * FROM tb_master_category WHERE category_description ='$category_description' ");
$checkSelectData = mysqli_num_rows($querySelectData);

if ($checkSelectData) {
  echo "<script>toastr['error']('Kategori ".$category_description." Sudah Ada!');enableForm();clearForm();</script>";
}else{

  $insertData = "INSERT INTO tb_master_category(
              id_category, category_code, category_description, bl_state, outlet_code_relation)
        VALUES ('$generateId', '$category_code', '$category_description', 'A', '$system_outlet_code')
      ";
  $queryInsertData = mysqli_query($config, $insertData);
  	if ($queryInsertData) {
      // log Activity
      $insertLogData = log_insert('INSERT', 'Menambahkan Data Kategori id: '.$generateId.' Deskripsi: '.$category_description, $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);
      if ($queryInsertLogData) {
        echo "<script>toastr['success']('Berhasil Insert Data Kategori ".$category_description."');clearForm();closeForm();loadData();</script>";
      }else{
        echo "Gagal Insert Log Activity";
      }
  	}else{
      echo "Gagal Insert Data";
    }
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
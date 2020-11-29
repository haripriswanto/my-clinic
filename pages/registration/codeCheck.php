<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

  if (!empty($_POST['i_product_code'])) {

    $i_product_code   = mysqli_escape_string($config, $_POST['i_product_code']);
    $selectProduct = "SELECT * FROM tb_master_product WHERE product_code = '$i_product_code' AND bl_state = 'A'";
    $queryInsertProduct = mysqli_query($config, $selectProduct);
    $CheckProductInsert = mysqli_num_rows($queryInsertProduct);

      if ($CheckProductInsert) {
        $response = "<font class='fa fa-times-circle' color='red'> Kode sudah ada!</font><script>disabledInsertForm();</script>";
      } else {	
        $response = "<font class='fa fa-check-circle' color='green'> Kode Tersedia!</font><script>enabledInsertForm();</script>";
      }

  } elseif (!empty($_POST['e_id_product'])) {
    $e_product_code   = mysqli_escape_string($config, $_POST['e_product_code']);
    $e_id_product     = mysqli_escape_string($config, $_POST['e_id_product']);
    $selectProduct = "SELECT * FROM tb_master_product WHERE product_code = '$e_product_code' AND id_product != '$e_id_product'  AND bl_state = 'A'";
    $queryUpdateProduct = mysqli_query($config, $selectProduct);
    $CheckProductUpdate = mysqli_num_rows($queryUpdateProduct);

      if ($CheckProductUpdate) {
        $response = "<font class='fa fa-times-circle' color='red'> Kode sudah ada!</font><script>disabledUpdateForm();</script>";
      } else {	
        $response = "<font class='fa fa-check-circle' color='green'> Kode Tersedia!</font><script>enabledUpdateForm();</script>";
      }

  }
  echo $response;
  die;

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
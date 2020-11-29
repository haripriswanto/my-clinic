<?php 
  include('../../config/config.php');

  $timeLimitDelete = 1;

  $deleteCartSelling = "DELETE FROM tb_selling_cart WHERE outlet_code_relation = '$system_outlet_code' AND bl_state = 'A' DATEDIFF(CURDATE(), ts_insert) > $timeLimitDelete";

  $queryDeleteCartSelling = mysqli_query($config, $deleteCartSelling);

  if ($queryDeleteCartSelling) {
    echo "<script>$.notify('Berhasil Menghapus data Keranjang.', 'success');</script>";
  } else {
    echo "<script>$.notify('Gagal Menghapus data Keranjang!', 'error');</script>";
  }

?>
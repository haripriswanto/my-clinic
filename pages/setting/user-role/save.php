
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $generateId         = mysqli_escape_string($config, sha1(generate(20)));
  $i_roleCode         = mysqli_escape_string($config, $_GET['i_roleCode']);
  $i_roleDescription	= mysqli_escape_string($config, $_GET['i_roleDescription']);


  $uqerySelect    = mysqli_query($config, "SELECT * FROM tb_system_user_role WHERE role_code = '$i_roleCode' OR role_description = '$i_roleDescription' AND is_active = 'A' ");
  $checkSelectData    = mysqli_num_rows($uqerySelect);

  if ($checkSelectData) {
    ?>
    <script type="text/javascript">
      toastr["error"]("Kode/deskripsi udah ada!");
      enableButtonInsert();
    </script>
  <?php
  exit();
  }
  elseif (!$checkSelectData) {
      $insertData = "
        INSERT INTO tb_system_user_role(id, role_code, role_description, ts_insert, is_active) 
        VALUES ('$generateId','$i_roleCode','$i_roleDescription', '".date('Y-m-d H:i:s')."', 'A')";

      if ($insertData) {
        // log Activity
        $insertLogData = log_insert('INSERT', 'Menambahkan Data Role id : '.$generateId.', Deskripsi : '.$i_roleDescription, $ip_address, $os, $browser);
        $queryInsertLogData = mysqli_query($config, $insertLogData);

        $result = mysqli_query($config, $queryInsertLogData);
        $result = mysqli_query($config, $insertData);

        if(!$result){
          echo mysqli_error($config);
        } else {
          echo "<script type='text/javascript'>
                  toastr['success']('Berhasil Menambahkan Data Role ".$i_roleDescription." ');
                  loadData();
                  closeForm();
                </script>";
        mysqli_close($config);
      }
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
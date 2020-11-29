
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $generateId            = mysqli_escape_string($config, sha1(generate(20)));
  $insertCode            = mysqli_escape_string($config, generate(6));
  $insertDescription     = mysqli_escape_string($config, $_GET['insertDescription']);
  $insertSortField       = mysqli_escape_string($config, $_GET['insertSortField']);

  $selectData = "SELECT * FROM tb_system_department WHERE department_code = '$insertCode' OR  department_description = '$insertDescription' AND is_active = 'A' ";
  $querySelect    = mysqli_query($config, $selectData);
  $checkSelectData    = mysqli_num_rows($querySelect);

  if ($checkSelectData) {
    ?>
    <script type="text/javascript">
      $.notify("Kode/Department Sudah Ada!", "error");
      $('#insertDescription').focus();
      disableButtonInsert();
    </script>
  <?php
  }else{
      $insertData = "
        INSERT INTO tb_system_department(id, department_code, department_description, sort_field, ts_insert, is_active) 
        VALUES ('$generateId', '$insertCode', '$insertDescription', '$insertSortField', '".date('Y-m-d H:i:s')."', 'A')
      ";
      
      if ($insertData) {
        // log Activity
        $insertLogData = log_insert('INSERT', 'Menambahkan Data Department id : '.$generateId.', Nama : '.$insertDescription, $ip_address, $os, $browser);
        $queryInsertLogData = mysqli_query($config, $insertLogData);

        $result = mysqli_query($config, $queryInsertLogData);
        $result = mysqli_query($config, $insertData);

        if(!$result){
          echo mysqli_error($config);
        } else {
          echo "<script type='text/javascript'>
                  closeForm();
                  loadData();
                  $.notify('Berhasil Menambahkan Data Department ".$insertDescription." ', 'success');
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
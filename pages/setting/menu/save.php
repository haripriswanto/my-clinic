
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $generateId        = mysqli_escape_string($config, sha1(generate(20)));
  $i_menuDescription = mysqli_escape_string($config, $_GET['i_menuDescription']);
  $i_menuCode        = mysqli_escape_string($config, $_GET['i_menuCode']);
  $i_menuUrl         = mysqli_escape_string($config, $_GET['i_menuUrl']);
  $i_menuIcon        = mysqli_escape_string($config, $_GET['i_menuIcon']);
  $i_menuSort        = mysqli_escape_string($config, $_GET['i_menuSort']);
  $i_menuType        = mysqli_escape_string($config, $_GET['i_menuType']);
  $i_menuIsActive    = mysqli_escape_string($config, $_GET['i_menuIsActive']);

  // var_dump($i_menuIsActive);exit;
  if ($i_menuIsActive == ''){
    $i_menuIsActive = 'D';
  }

    $insertData = "
      INSERT INTO tb_system_menu(id, menu_code, menu_description, menu_url, menu_icon, sort_menu, type_menu, ts_insert, is_active) 
      VALUES ('$generateId','$i_menuCode','$i_menuDescription','$i_menuUrl','$i_menuIcon','$i_menuSort','$i_menuType','".date('Y-m-d H:i:s')."','$i_menuIsActive')";

      if ($insertData) {
          // log Activity
          $insertLogData = log_insert('INSERT', 'Menambahkan Data Menu id : '.$generateId.', Deskripsi : '.$i_menuDescription, $ip_address, $os, $browser);
          $queryInsertLogData = mysqli_query($config, $insertLogData);

          $result = mysqli_query($config, $queryInsertLogData);
          $result = mysqli_query($config, $insertData);

          if(!$result){
            echo mysqli_error($config);
          } else {
            echo "<script type='text/javascript'>
                    closeForm();
                    loadData();
                    toastr['success']('Berhasil Menambahkan Data Menu ".$i_menuDescription." ');
                  </script>";
          mysqli_close($config);
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
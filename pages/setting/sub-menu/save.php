
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

$generateId           = mysqli_escape_string($config, sha1(generate(20)));
$i_mainMenu           = mysqli_escape_string($config, $_POST['i_mainMenu']);
$i_submenuDescription = mysqli_escape_string($config, $_POST['i_submenuDescription']);
$i_submenuCode        = mysqli_escape_string($config, $_POST['i_submenuCode']);
$i_submenuUrl         = mysqli_escape_string($config, $_POST['i_submenuUrl']);
$i_submenuIcon        = mysqli_escape_string($config, $_POST['i_submenuIcon']);
$i_submenuSort        = mysqli_escape_string($config, $_POST['i_submenuSort']);
$i_submenuIsActive    = mysqli_escape_string($config, $_POST['i_submenuIsActive']);

  // var_dump($i_submenuIsActive);exit;
  if ($i_submenuIsActive == ''){
    $i_submenuIsActive = 'D';
  }

    $insertData = "
    INSERT INTO tb_system_sub_menu(id, menu_id, sub_menu_code, sub_menu_description, sub_menu_url, sub_menu_icon, sub_menu_sort, ts_insert, is_active) VALUES ('$generateId', '$i_mainMenu', '$i_submenuCode', '$i_submenuDescription', '$i_submenuUrl', '$i_submenuIcon', '$i_submenuSort', '".date('Y-m-d H:i:s')."', '$i_submenuIsActive')";

      if ($insertData) {
          // log Activity
          $insertLogData = log_insert('INSERT', 'Menambahkan Data Sub Menu id : '.$generateId.', Deskripsi : '.$i_submenuDescription, $ip_address, $os, $browser);
          $queryInsertLogData = mysqli_query($config, $insertLogData);

          $result = mysqli_query($config, $queryInsertLogData);
          $result = mysqli_query($config, $insertData);

          if(!$result){
            echo mysqli_error($config);
          } else {
            echo "<script type='text/javascript'>
                    toastr['success']('Berhasil Menambahkan Data Sub Menu ".$i_submenuDescription." ');
                    loadData();
                    closeForm();
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
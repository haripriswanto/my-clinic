
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $generateId       = mysqli_escape_string($config, sha1(generate(20)));
  $insert_nama      = mysqli_escape_string($config, $_GET['insert_nama']);
  $insert_birthday	= mysqli_escape_string($config, $_GET['insert_birthday']);
  $insert_gender		= mysqli_escape_string($config, $_GET['insert_gender']);
  $insert_address		= mysqli_escape_string($config, $_GET['insert_address']);
  $insert_email		  = mysqli_escape_string($config, $_GET['insert_email']);
  $insert_phone		  = mysqli_escape_string($config, $_GET['insert_phone']);
  $insert_username	= mysqli_escape_string($config, $_GET['insert_username']);
  $insert_akses		  = mysqli_escape_string($config, $_GET['insert_akses']);
  $insert_password	= generate(4);


  $uqerySelect    = mysqli_query($config, "SELECT * FROM tb_system_user WHERE user_name='$insert_username' AND is_active = 'A' ");
  $checkSelectData    = mysqli_num_rows($uqerySelect);

  if ($checkSelectData) {
    ?>
    <script type="text/javascript">
      $.notify("Username Tidak Tersedia", "error");
      $('#insert_username').focus();
      disableButtonInsert();
    </script>
  <?php
  }
  elseif (!$checkSelectData) {
      $insertDataUser = "
        INSERT INTO tb_system_user(id_user, user_name, user_password, user_full_name, user_address, user_email, user_phone, user_gender, user_birthday, access_level, ts_insert, is_active) 
        VALUES ('$generateId','$insert_username','$insert_password','$insert_nama','$insert_address','$insert_email','$insert_phone','$insert_gender','$insert_birthday','$insert_akses', '".date('Y-m-d H:i:s')."', 'A')";

      if ($insertDataUser) {
        // log Activity
        $insertLogData = log_insert('INSERT', 'Menambahkan Data User id : '.$generateId.', Nama : '.$insert_nama, $ip_address, $os, $browser);
        $queryInsertLogData = mysqli_query($config, $insertLogData);

        $result = mysqli_query($config, $queryInsertLogData);
        $result = mysqli_query($config, $insertDataUser);

        if(!$result){
          echo mysqli_error($config);
        } else {
          echo "<script type='text/javascript'>
                  closeForm();
                  loadDataUser();
                  $.notify('Berhasil Menambahkan Data User ".$insert_nama." ', 'success');
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
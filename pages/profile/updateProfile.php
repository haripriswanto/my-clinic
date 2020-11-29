<?php 
include("../../config/config.php");

if (!empty($_SESSION['login'])) {

$p_idUser		= $_GET['p_idUser'];
$p_firstName	= $_GET['p_firstName'];
$p_address		= $_GET['p_address'];
$p_email		= $_GET['p_email'];
$p_birthday		= $_GET['p_birthday'];
$p_telp			= $_GET['p_telp'];
$p_gender		= $_GET['p_gender'];

$queryUpdateProfile = mysqli_query($config, "UPDATE tb_system_user 
	SET user_full_name = '$p_firstName', user_address = '$p_address', user_email = '$p_email', user_phone = '$p_telp', user_gender = '$p_gender', user_birthday = '$p_birthday' WHERE id_user = '$p_idUser' ");

if (!$queryUpdateProfile) {
	?>
	<script type="text/javascript">
		enableUpdateProfile();
		toastr['error']('Gagal Query Update');
	</script>
	<?php	
}
elseif ($queryUpdateProfile) {

  // insert Log Activity
  $insertLogData = log_insert('UPDATE', 'Merubah Profile User : '.$_SESSION['login']['user_name'] , $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);

  if ($queryInsertLogData) {
	echo "<script>
			toastr['success']('Update Profile Berhasil');
			$('#clickProfile').modal('hide');
		</script>";
  } else {
    echo mysqli_error($config);
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
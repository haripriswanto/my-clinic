<?php 
include("../../config/config.php");

if (!empty($_SESSION['login'])) {
	
$id 			= $_GET['idUser'];
$oldPassword 	= $_GET['oldPassword'];
$newPassword 	= $_GET['newPassword'];
$password 		= $_GET['password'];

$querySelectUser = mysqli_query($config, "SELECT * FROM tb_system_user WHERE user_password = '$oldPassword' AND id_user = '$id' ");
$checkQuery = mysqli_num_rows($querySelectUser);
if (!$checkQuery) {
	?>
	<script type="text/javascript">
		toastr['error']("Password Lama Tidak Sesuai!");
		enabledPassword();
		$("#oldPassword").val('');
		$("#oldPassword").focus();
	</script>
	<?php
}
elseif ($newPassword != $password) {
	?>
	<script type="text/javascript">
		toastr['error']("Konfirmasi Password Tidak Sama!");
		$("#password").focus();
		enabledPassword();
	</script>
	<?php 
}
else{
	$queryUpdatePassword = mysqli_query($config, "UPDATE tb_system_user SET user_password = '$password' WHERE id_user = '$id' ");
	if ($queryUpdatePassword) {

		// log Activity
		$insertLogData = log_insert('UPDATE', 'Merubah Password User : '.$sessionUser, $ip_address, $os, $browser);
		$queryInsertLogData = mysqli_query($config, $insertLogData);
	    if (!$queryInsertLogData) {
			?>
			<script type="text/javascript">
				enabledPassword();
				toastr['error']("Error Query Log");
				$("#oldPassword").val('');
				$("newPassword").val('');
				$("#password").val('');
				$("#oldPassword").focus();
			</script>
			<?php	    	
	    }
	    elseif ($queryInsertLogData) {
			?>
			<script type="text/javascript">
				toastr['success']("Berhasil Update Password");
				$("#clickProfile").modal('hide');
			</script>
			<?php
		}
	}
	else{
		?>
		<script type="text/javascript">
			toastr['error']("Gagal Query Password");
			$("#password").focus();
		</script>
		<?php

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
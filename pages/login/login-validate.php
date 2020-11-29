<?php 

include('../../config/config.php'); 

$username	= mysqli_escape_string($config, $_POST['username']); 
$password	= mysqli_escape_string($config, $_POST['password']);



$selectUser = "SELECT * FROM tb_system_user WHERE BINARY user_name = '$username' AND BINARY user_password = '$password' AND is_active = 'A' ";
// var_dump($selectUser);exit();
$querySelectUser	= mysqli_query($config, $selectUser);
$checkSelectUser	= mysqli_num_rows($querySelectUser);
$fetchData			= mysqli_fetch_array($querySelectUser);

if(!$checkSelectUser){
	// Cek validation
	?>
    <script language="javascript">
    	toastr['error']('Username / Password Tidak Sesuai!');
	    document.getElementById('username').disabled = false;
	    document.getElementById('password').disabled = false;
		document.getElementById('loginButton').disabled = false;
		$('#username').focus();
		$('#username').val('');
		$('#password').val('');
	</script>
    <?php
}
else if ($checkSelectUser){
	// Set Session
	$_SESSION['login']['id_user']		= $fetchData['id_user'];
	$_SESSION['login']['user_name']		= $fetchData['user_name'];
	$_SESSION['login']['full_name']		= $fetchData['user_full_name'];
	$_SESSION['login']['access_level']	= $fetchData['access_level'];
	
	$roleId = $_SESSION['login']['access_level'];
	$selectRoleName = "SELECT * FROM tb_system_user_role WHERE id = '$roleId' ";
	// var_dump($selectRoleName);
	$queryRoleName = mysqli_query($config, $selectRoleName);
	$rowRoleName = mysqli_fetch_array($queryRoleName);
	
	// insert Log Activity
      $insertLogData = log_insert('LOGIN', 'Login Dengan User : '.$_SESSION['login']['user_name'] , $ip_address, $os, $browser);
      $queryInsertLogData = mysqli_query($config, $insertLogData);

    if ($queryInsertLogData) {

		echo "<center>
			<img src='".$base_url."assets/images/load.gif' width='30' height='30'/>
			<font size='2'>Berhasil Login Sebagai ".$rowRoleName['role_description'].", Redirecting ...</font>
		</center>";
		?>
			<script>
    			toastr['success']("Anda Berhasil Login Sebagai <?= $rowRoleName['role_description']; ?>");
				window.location="<?php echo $base_url."home" ?>";
			</script>
		<?php
	}
}
?>

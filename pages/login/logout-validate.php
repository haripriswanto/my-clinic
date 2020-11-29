<?php
include('../../config/config.php');

if (isset($_SESSION['login'])) {
	
      // insert Log Activity
      $insertLogData = log_insert('LOGOUT', 'Logout Dengan User : '.$_SESSION['login']['user_name'] , $ip_address, $os, $browser);
	  $queryInsertLogData = mysqli_query($config, $insertLogData);
	  
    if ($queryInsertLogData) {
		unset($_SESSION['login']);
		echo "
		<center><img src='".$base_url."assets/images/load.gif' width='50' height='50'/><font size='2'>Berhasil Logout, Mohon Menunggu ...</font></center>;
		<script>toastr['success']('Berhasil Logout!');window.location=".$base_url.";</script>";
	}
}elseif (!isset($_SESSION['login'])){
	echo "
		<center><img src='".$base_url."assets/images/load.gif' width='50' height='50'/><font size='2'>Anda Sudah Logout, Mohon Menunggu ...</font></center>;
		<script>toastr['error']('Sesi Anda Sudah Habis!');window.location=".$base_url.";</script>";
}
?>
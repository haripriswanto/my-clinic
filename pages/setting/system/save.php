
<?php 
include('../../../config/config.php');

if (!empty($_SESSION['login'])) {

	$id_system 			  = mysqli_escape_string($config, $_GET['id_system']);
	// var_dump($id_system);exit();
	$insert_title		  = mysqli_escape_string($config, $_GET['insert_title']);
	$insert_header        = mysqli_escape_string($config, $_GET['insert_header']);
	$insert_dashboard     = mysqli_escape_string($config, $_GET['insert_dashboard']);
	$insert_instansi_name = mysqli_escape_string($config, $_GET['insert_instansi_name']);
	$insert_owner         = mysqli_escape_string($config, $_GET['insert_owner']);
	$insert_phone         = mysqli_escape_string($config, $_GET['insert_phone']);
	$insert_address	      = mysqli_escape_string($config, $_GET['insert_address']);
	$insert_email         = mysqli_escape_string($config, $_GET['insert_email']);
	$insert_url           = mysqli_escape_string($config, $_GET['insert_url']);
	$insert_outlet_code	  = mysqli_escape_string($config, $_GET['insert_outlet_code']);
	$insert_footer_struct = mysqli_escape_string($config, $_GET['insert_footer_struct']);

	if ($id_system == 'undefined') {
		$insertDataSetting = "INSERT INTO tb_system_setting(
					id_system, system_title, system_header, system_dashboard_text, system_owner, system_instansi_name, system_phone, system_address, system_email, system_url, system_outlet_code, system_footer_struct, id_transaction)
			VALUES ('".sha1(generate(20))."', '$insert_title', '$insert_header', '$insert_dashboard', '$insert_owner', '$insert_instansi_name', '$insert_phone', '$insert_address', '$insert_email', '$insert_url', '$insert_outlet_code', '$insert_footer_struct', '1')";

		$queryInsertDataSetting = mysqli_query($config, $insertDataSetting);
		if ($queryInsertDataSetting){
			$insertLog = "INSERT INTO log_activity(
							id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
						VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'INSERT', 'Menambahkan Data Setting Dengan Kode ".$id_system."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
			$queryInsertLog = mysqli_query($config, $insertLog);
			if ($queryInsertLog) {
				echo "<script>toastr['success']('Berhasil Insert Data ".$insert_header."');loadDataSetting();closeForm();</script>"; 
			}else{
				echo "<div class='alert alert-danger'>Error Query LOG</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>Error Query Insert Data Setting</div>";
		}
	}elseif ($id_system != '') {
		$insertDataSetting = "UPDATE tb_system_setting 
			SET system_title = '$insert_title', system_header = '$insert_header', system_dashboard_text = '$insert_dashboard', system_owner = '$insert_owner', system_instansi_name = '$insert_instansi_name' , system_phone = '$insert_phone', system_address = '$insert_address', system_email = '$insert_email' , system_url = '$insert_url', system_footer_struct = '$insert_footer_struct'
			WHERE id_system = '".$id_system."' ";
		$queryInsertDataSetting = mysqli_query($config, $insertDataSetting);
		if ($queryInsertDataSetting){
			$insertLog = "INSERT INTO log_activity(
							id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
						VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'UPDATE', 'Perbarui Data Setting Dengan Kode ".$id_system."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
			$queryInsertLog = mysqli_query($config, $insertLog);
			if ($queryInsertLog) {
				echo "<script>toastr['success']('Berhasil UPDATE Data ".$insert_header."', 'success');loadDataSetting();closeForm();</script>"; 
			}else{
				echo "<div class='alert alert-danger'>Error Query LOG</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>Error Query UPDATE Data Setting</div>";
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
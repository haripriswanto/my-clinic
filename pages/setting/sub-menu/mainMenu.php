
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $i_menuType = $_POST['i_menuType'];
	if ($i_menuType == '') {
		echo "<option value=''>-- Pilih Tipe Menu --</option>";
	} else {
		$queryMenuOpt =  mysqli_query($config, " 
			SELECT * FROM tb_system_menu WHERE type_menu = '$i_menuType' AND is_active = 'A' ORDER BY sort_menu ASC"); 
			while ($rowMenuOpt = mysqli_fetch_array($queryMenuOpt)) {
				echo "<option value=".$rowMenuOpt['id'].">".$rowMenuOpt['menu_description']."</option>";
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